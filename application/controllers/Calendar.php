<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Event_model');
        $this->load->model('Calender_model');
        $this->load->helper('url');
        $this->load->model('HomeModal');
    }

    public function index()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Bricks Calendar';

        $user_id = sessionId('freelancer_id');
        
        $companies = $this->CommonModal->getRowsWhere('companies');

        $data['companies'] = $companies;
        
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('calendar_view');
        $this->load->view('includes/footer');
    }

    public function index_public()
    {   
        $permission_id = $this->input->get('id');
        $data['title'] = 'Bricks Calendar';

        $perm_details = $this->CommonModal->getRowWhere('calendar_permissions',[
            'id' => $permission_id
        ]);

        $data['perm_details'] = $perm_details;
        // dd($data);
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('calendar_view_public');
        $this->load->view('includes/footer');
    }

    // public function data_feeding_panel() {
        
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }
    //     $timeline_id = $this->input->get('id');
    //     $data['timeline_id'] = $timeline_id;
    //     $calendar = $this->getTimelineDataForPanel($timeline_id);
        
    //     $data['calendar'] = $calendar;

    //     $data['title'] = 'Data Feeding Panel';

    //     $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
    //         'user_id' => sessionId('freelancer_id'),
    //         'tree_type' => 4,
    //     ]);
        
    //     // echo "<pre>";
    //     // print_r($data); die;

    //     $this->load->view('includes/header-link.php');
    //     $this->load->view('includes/header.php');
    //     $this->load->view('includes/footer-link');
    //     $this->load->view('data_feeding_panel.php', $data);
    // }
    
    public function data_feeding_panel()
    {
        $timeline_id   = $this->input->get('id');
        $permission_id = $this->input->get('permission_id');
        $project_id = $this->input->get('project_id');
        $company_id = $this->input->get('company_id');
        
        // if (!$timeline_id) {
        //     show_error('Invalid request');
        // }

        $user_id = sessionId('freelancer_id');
        $is_public_view = false;

        /////////////////////////////////////////////////////////
        // 🔐 OWNER MODE
        /////////////////////////////////////////////////////////

        $calendar = $this->getTimelineDataForPanel($timeline_id);

        /////////////////////////////////////////////////////////
        // 🌍 PUBLIC MODE
        /////////////////////////////////////////////////////////
        if ($permission_id) {

            $permission = $this->CommonModal->getRowWhere(
                'tbl_calendar_permissions',
                ['id' => $permission_id]
            );

            $data['permission'] = $permission;

            if (!$permission || $permission['is_public'] != 1) {
                show_error('Private calendar');
            }

            $calendar = $this->getTimelineDataForPanel($timeline_id, $permission['user_id']);

            if (!$calendar) {
                show_error('Timeline not found');
            }
            
            // dd($calendar);
            // Timeline must belong to permission owner
            if ($calendar['timeline_details']['user_id'] != $permission['user_id']) {
                show_error('Unauthorized');
            }
            // dd($calendar);

            // Check date scope restriction
            if (!$this->isDateAllowedByPermission($permission, $calendar['timeline_details']['date'])) {
                show_error('Not allowed to view this date');
            }

            $is_public_view = true;
            $user_id = $permission['user_id'];
        }

        /////////////////////////////////////////////////////////
        // LOAD DATA
        /////////////////////////////////////////////////////////
        if($company_id){
            $data['company_id'] = $company_id;

            $data['company_details'] = $this->CommonModal->getRowWhere('companies',[
                'id' => $company_id
            ]);
        }

        if($project_id){
            $data['project_id'] = $project_id;

            $data['project_details'] = $this->CommonModal->getRowWhere('projects',[
                'id' => $project_id
            ]);

            $data['company_details'] = $this->CommonModal->getRowWhere('companies',[
                'id' => $data['project_details']['company_id']
            ]);
        }
        
        $data['timeline_id'] = $timeline_id;
        $data['calendar']    = $calendar;
        $data['title']       = 'Data Feeding Panel';
        $data['is_public_view'] = $is_public_view;
        // dd($data['calendar']['timeline_details']['timeline_type']);
        // Trees only for owner
        if (!$is_public_view) {
            $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
                'user_id' => $user_id,
                'tree_type' => 4,
            ]);
        } else {
            $data['trees'] = [];
        }

        $this->load->view('includes/header-link.php');
        $this->load->view('includes/header.php');
        $this->load->view('includes/footer-link');
        $this->load->view('data_feeding_panel.php', $data);
    }

    public function data_feeding_panel_future()
    {
        $timeline_id   = $this->input->get('id');
        $permission_id = $this->input->get('permission_id');
        $project_id = $this->input->get('project_id');
        $company_id = $this->input->get('company_id');
        
        // if (!$timeline_id) {
        //     show_error('Invalid request');
        // }

        $user_id = sessionId('freelancer_id');
        $is_public_view = false;

        /////////////////////////////////////////////////////////
        // 🔐 OWNER MODE
        /////////////////////////////////////////////////////////

        $calendar = $this->getTimelineDataForPanel($timeline_id, null, 1);

        /////////////////////////////////////////////////////////
        // 🌍 PUBLIC MODE
        /////////////////////////////////////////////////////////
        if ($permission_id) {

            $permission = $this->CommonModal->getRowWhere(
                'tbl_calendar_permissions',
                ['id' => $permission_id]
            );

            $data['permission'] = $permission;

            if (!$permission || $permission['is_public'] != 1) {
                show_error('Private calendar');
            }

            $calendar = $this->getTimelineDataForPanel($timeline_id, $permission['user_id'], 1);

            if (!$calendar) {
                show_error('Timeline not found');
            }
            
            // dd($calendar);
            // Timeline must belong to permission owner
            if ($calendar['timeline_details']['user_id'] != $permission['user_id']) {
                show_error('Unauthorized');
            }
            // dd($calendar);

            // Check date scope restriction
            if (!$this->isDateAllowedByPermission($permission, $calendar['timeline_details']['date'])) {
                show_error('Not allowed to view this date');
            }

            $is_public_view = true;
            $user_id = $permission['user_id'];
        }

        /////////////////////////////////////////////////////////
        // LOAD DATA
        /////////////////////////////////////////////////////////
        if($company_id){
            $data['company_id'] = $company_id;

            $data['company_details'] = $this->CommonModal->getRowWhere('companies',[
                'id' => $company_id
            ]);
        }

        if($project_id){
            $data['project_id'] = $project_id;

            $data['project_details'] = $this->CommonModal->getRowWhere('projects',[
                'id' => $project_id
            ]);

            $data['company_details'] = $this->CommonModal->getRowWhere('companies',[
                'id' => $data['project_details']['company_id']
            ]);
        }
        
        $data['timeline_id'] = $timeline_id;
        $data['calendar']    = $calendar;
        $data['title']       = 'Data Feeding Panel';
        $data['is_public_view'] = $is_public_view;
        // dd($data['calendar']['timeline_details']['timeline_type']);
        // Trees only for owner
        if (!$is_public_view) {
            $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
                'user_id' => $user_id,
                'tree_type' => 4,
            ]);
        } else {
            $data['trees'] = [];
        }

        $this->load->view('includes/header-link.php');
        $this->load->view('includes/header.php');
        $this->load->view('includes/footer-link');
        $this->load->view('data_feeding_panel_future.php', $data);
    }

    public function events()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $user_id = sessionId('freelancer_id');

        if (!$start || !$end || !$user_id) {
            echo json_encode([]);
            return;
        }

        $bricks = $this->Event_model->get_between($start, $end, $user_id);
        
        $mapped = array_map(function ($b) {
            return [
                'id' => (int)$b['id'],
                'title' => $b['brick_title'] ?? 'Brick Entry',
                'start' => $b['create_date'] ?? '',
                'color' => '#3788d8',
                'description' => $b['brick_description'] ?? '',
                'type' => 'brick'
            ];
        }, $bricks);

        header('Content-Type: application/json');
        echo json_encode($mapped);
    }

    public function events_company()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $user_id = sessionId('freelancer_id');
        $company_id = $this->input->get('company_id');

        if (!$start || !$end || !$user_id) {
            echo json_encode([]);
            return;
        }
        
        $bricks = $this->Event_model->get_between($start, $end, $user_id, $company_id);
        
        $mapped = array_map(function ($b) {
            return [
                'id' => (int)$b['id'],
                'title' => $b['brick_title'] ?? 'Brick Entry',
                'start' => $b['create_date'] ?? '',
                'color' => '#3788d8',
                'description' => $b['brick_description'] ?? '',
                'type' => 'brick'
            ];
        }, $bricks);

        header('Content-Type: application/json');
        echo json_encode($mapped);
    }

    public function events_project()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $user_id = sessionId('freelancer_id');
        $project_id = $this->input->get('project_id');

        if (!$start || !$end || !$user_id) {
            echo json_encode([]);
            return;
        }
        
        $bricks = $this->Event_model->get_between($start, $end, $user_id, null, $project_id);
        
        $mapped = array_map(function ($b) {
            return [
                'id' => (int)$b['id'],
                'title' => $b['brick_title'] ?? 'Brick Entry',
                'start' => $b['create_date'] ?? '',
                'color' => '#3788d8',
                'description' => $b['brick_description'] ?? '',
                'type' => 'brick'
            ];
        }, $bricks);

        header('Content-Type: application/json');
        echo json_encode($mapped);
    }

    public function timelines()
    {
        $start   = $this->input->get('start'); // FullCalendar range
        $end     = $this->input->get('end');
        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        if (!$start || !$end || !$user_id) {
            echo json_encode([]);
            return;
        }

        // Fetch ONLY timeline masters
        $timelines = $this->db
            ->where('user_id', $user_id)
            ->where('date >=', date('Y-m-d', strtotime($start)))
            ->where('date <=', date('Y-m-d', strtotime($end)))
            ->order_by('opening_time', 'ASC')
            ->get('tbl_calendar_timeline_master')
            ->result_array();

        // Map to FullCalendar-compatible format
        $mapped = array_map(function ($t) {

            // Decide start/end for calendar
            if ($t['schedule_type'] == 0) {
                $start = $t['finaldatetime'] ?? $t['date'];
                $end   = null;
            } else {
                $start = $t['date'];
                $end   = null;
            }

            return [
                'id'    => 'timeline_' . $t['id'], // 🔥 important
                'title' => 'Timeline',
                'start' => $start,
                'end'   => $end,
                'allDay'=> false,

                // 🔥 custom data (used on click)
                'extendedProps' => [
                    'timeline_id'  => (int) $t['id'],
                    'scheduleType' => (int) $t['schedule_type'],
                    'openingTime'  => $t['opening_time'],
                    'closingTime'  => $t['closing_time']
                ],

                // UI
                'color' => '#0d6efd',
                'type'  => 'timeline'
            ];
        }, $timelines);

        header('Content-Type: application/json');
        echo json_encode($mapped);
    }

    public function press_release_events()
    {
        $user_id = sessionId('freelancer_id');

        // Fetch all press release data for this user
        $data = $this->db
            ->where("user_id", $user_id)
            ->order_by("id", "DESC")
            ->get("tbl_project_press_release")
            ->result();

        $events = [];

        foreach ($data as $row) {
            $events[] = [
                'id'    => $row->id,
                'uniq_id'    => $row->uniq_id,
                'Press_Release' => $row->press_release,
                'storytime' => $row->storytime,  // Must be YYYY-MM-DD format
                'type' => 'press_release',
                'start' => $row->created_date,
            ];
        }

        echo json_encode($events);
    }

    // public function events_count()
    // {

    //     $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

    //     if(empty($user_id)){
    //         $permission_id = $this->input->get('permission_id');
    //     }

    //     if(!empty($permission_id)){
    //         $permission_details = $this->CommonModal->getRowWhere('calendar_permissions', [
    //             'id' => $permission_id
    //         ]);


    //     }else{
    //         echo 'no permission id found';
    //         return;
    //     }

    //     $start_raw = $this->input->get('start');
    //     $end_raw   = $this->input->get('end');

    //     $start = null;
    //     $end   = null;

    //     if (!empty($start_raw)) {
    //         $start = date('Y-m-d', strtotime($start_raw));
    //     }

    //     if (!empty($end_raw)) {
    //         $end = date('Y-m-d', strtotime($end_raw));
    //     }

    //     $this->db->select('date, COUNT(*) as total_events');
    //     $this->db->from('tbl_calendar_timeline_master');
    //     $this->db->where('user_id', $user_id);

    //     if (!empty($start)) {
    //         $this->db->where('date >=', $start);
    //     }

    //     if (!empty($end)) {
    //         $this->db->where('date <=', $end);
    //     }

    //     $this->db->group_by('date');

    //     $result = $this->db->get()->result_array();

    //     echo json_encode([
    //         'success' => true,
    //         'start' => $start,
    //         'end' => $end,
    //         'data' => $result
    //     ]);

    // }

    public function events_count()
    {
        $user_id = sessionId('freelancer_id') ?: sessionId('admin_id');
        $permission_id = $this->input->get('permission_id');

        //////////////////////////////////////////////////////////
        // 🔹 GET PERMISSION DETAILS IF PROVIDED
        //////////////////////////////////////////////////////////

        $permission_details = null;

        if ($permission_id) {

            $permission_details = $this->CommonModal->getRowWhere(
                'tbl_calendar_permissions',
                ['id' => $permission_id]
            );

            if (!$permission_details || $permission_details['is_public'] != 1) {
                echo json_encode(['success' => false, 'message' => 'Invalid permission']);
                return;
            }
        }

        //////////////////////////////////////////////////////////
        // 🔹 DATE RANGE FROM FULLCALENDAR
        //////////////////////////////////////////////////////////

        $start_raw = $this->input->get('start');
        $end_raw   = $this->input->get('end');

        $start = $start_raw ? date('Y-m-d', strtotime($start_raw)) : null;
        $end   = $end_raw   ? date('Y-m-d', strtotime($end_raw))   : null;

        //////////////////////////////////////////////////////////
        // 🔹 BUILD QUERY
        //////////////////////////////////////////////////////////

        $this->db->select('date, COUNT(*) as total_events');
        $this->db->from('tbl_calendar_timeline_master');

        //////////////////////////////////////////////////////////
        // 🔐 OWNER MODE
        //////////////////////////////////////////////////////////

        if ($user_id) {

            $this->db->where('user_id', $user_id);
            $this->db->where('project_id', null);
            $this->db->where('company_id', null);

        } 
        //////////////////////////////////////////////////////////
        // 🌍 PUBLIC MODE (NO SESSION)
        //////////////////////////////////////////////////////////
        elseif ($permission_details) {

            // Show events of permission owner
            $this->db->where('user_id', $permission_details['user_id']);

            // Apply permission scope restriction
            if ($permission_details['permission_scope'] == 'day') {

                $this->db->where('date', $permission_details['reference_date']);

            } elseif ($permission_details['permission_scope'] == 'month') {

                $this->db->like('date', $permission_details['reference_month'], 'after');

            } elseif ($permission_details['permission_scope'] == 'year') {

                $this->db->where('YEAR(date)', $permission_details['reference_year']);
            }

        } else {

            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        //////////////////////////////////////////////////////////
        // 🔹 APPLY RANGE FROM CALENDAR VIEW
        //////////////////////////////////////////////////////////

        if ($start) {
            $this->db->where('date >=', $start);
        }

        if ($end) {
            $this->db->where('date <=', $end);
        }

        $this->db->group_by('date');

        $result = $this->db->get()->result_array();

        //////////////////////////////////////////////////////////
        // 🔹 RESPONSE
        //////////////////////////////////////////////////////////

        echo json_encode([
            'success' => true,
            'start'   => $start,
            'end'     => $end,
            'data'    => $result
        ]);
    }

    public function events_count_company()
    {
        // $user_id = sessionId('freelancer_id') ?: sessionId('admin_id');
        $permission_id = $this->input->get('permission_id');
        $company_id = $this->input->get('company_id');
        //////////////////////////////////////////////////////////
        // 🔹 GET PERMISSION DETAILS IF PROVIDED
        //////////////////////////////////////////////////////////

        $permission_details = null;

        if ($permission_id) {

            $permission_details = $this->CommonModal->getRowWhere(
                'tbl_calendar_permissions',
                ['id' => $permission_id]
            );

            if (!$permission_details || $permission_details['is_public'] != 1) {
                echo json_encode(['success' => false, 'message' => 'Invalid permission']);
                return;
            }
        }

        //////////////////////////////////////////////////////////
        // 🔹 DATE RANGE FROM FULLCALENDAR
        //////////////////////////////////////////////////////////

        $start_raw = $this->input->get('start');
        $end_raw   = $this->input->get('end');

        $start = $start_raw ? date('Y-m-d', strtotime($start_raw)) : null;
        $end   = $end_raw   ? date('Y-m-d', strtotime($end_raw))   : null;

        //////////////////////////////////////////////////////////
        // 🔹 BUILD QUERY
        //////////////////////////////////////////////////////////

        $this->db->select('date, COUNT(*) as total_events');
        $this->db->from('tbl_calendar_timeline_master');
        $this->db->where('company_id', $company_id);

        //////////////////////////////////////////////////////////
        // 🔐 OWNER MODE
        //////////////////////////////////////////////////////////

        // if ($user_id) {

        //     $this->db->where('user_id', $user_id);

        // } 
        //////////////////////////////////////////////////////////
        // 🌍 PUBLIC MODE (NO SESSION)
        //////////////////////////////////////////////////////////
        if ($permission_details) {

            // Show events of permission owner
            $this->db->where('user_id', $permission_details['user_id']);

            // Apply permission scope restriction
            if ($permission_details['permission_scope'] == 'day') {

                $this->db->where('date', $permission_details['reference_date']);

            } elseif ($permission_details['permission_scope'] == 'month') {

                $this->db->like('date', $permission_details['reference_month'], 'after');

            } elseif ($permission_details['permission_scope'] == 'year') {

                $this->db->where('YEAR(date)', $permission_details['reference_year']);
            }

        }

        //////////////////////////////////////////////////////////
        // 🔹 APPLY RANGE FROM CALENDAR VIEW
        //////////////////////////////////////////////////////////

        if ($start) {
            $this->db->where('date >=', $start);
        }

        if ($end) {
            $this->db->where('date <=', $end);
        }

        $this->db->group_by('date');

        $result = $this->db->get()->result_array();

        //////////////////////////////////////////////////////////
        // 🔹 RESPONSE
        //////////////////////////////////////////////////////////

        echo json_encode([
            'success' => true,
            'start'   => $start,
            'end'     => $end,
            'data'    => $result
        ]);
    }

    public function events_count_project()
    {
        // $user_id = sessionId('freelancer_id') ?: sessionId('admin_id');
        $permission_id = $this->input->get('permission_id');
        $project_id = $this->input->get('project_id');
        //////////////////////////////////////////////////////////
        // 🔹 GET PERMISSION DETAILS IF PROVIDED
        //////////////////////////////////////////////////////////

        $permission_details = null;

        if ($permission_id) {

            $permission_details = $this->CommonModal->getRowWhere(
                'tbl_calendar_permissions',
                ['id' => $permission_id]
            );

            if (!$permission_details || $permission_details['is_public'] != 1) {
                echo json_encode(['success' => false, 'message' => 'Invalid permission']);
                return;
            }
        }

        //////////////////////////////////////////////////////////
        // 🔹 DATE RANGE FROM FULLCALENDAR
        //////////////////////////////////////////////////////////

        $start_raw = $this->input->get('start');
        $end_raw   = $this->input->get('end');
        $start_date = explode("T",$start_raw)[0];
        $end_date = explode("T",$end_raw)[0];

        $start = $start_date ? date('Y-m-d', strtotime($start_date)) : null;
        $end   = $end_date   ? date('Y-m-d', strtotime($end_date))   : null;

        // dd($start_raw);
        // dd($start);
        //////////////////////////////////////////////////////////
        // 🔹 BUILD QUERY
        //////////////////////////////////////////////////////////

        $this->db->select('date, COUNT(*) as total_events');
        $this->db->from('tbl_calendar_timeline_master');
        $this->db->where('project_id', $project_id);

        //////////////////////////////////////////////////////////
        // 🔐 OWNER MODE
        //////////////////////////////////////////////////////////

        // if ($user_id) {

        //     $this->db->where('user_id', $user_id);

        // } 
        //////////////////////////////////////////////////////////
        // 🌍 PUBLIC MODE (NO SESSION)
        //////////////////////////////////////////////////////////
        if ($permission_details) {

            // Show events of permission owner
            $this->db->where('user_id', $permission_details['user_id']);

            // Apply permission scope restriction
            if ($permission_details['permission_scope'] == 'day') {

                $this->db->where('date', $permission_details['reference_date']);

            } elseif ($permission_details['permission_scope'] == 'month') {

                $this->db->like('date', $permission_details['reference_month'], 'after');

            } elseif ($permission_details['permission_scope'] == 'year') {

                $this->db->where('YEAR(date)', $permission_details['reference_year']);
            }

        }

        //////////////////////////////////////////////////////////
        // 🔹 APPLY RANGE FROM CALENDAR VIEW
        //////////////////////////////////////////////////////////

        if ($start) {
            $this->db->where('date >=', $start);
        }

        if ($end) {
            $this->db->where('date <=', $end);
        }

        $this->db->group_by('date');

        $result = $this->db->get()->result_array();

        //////////////////////////////////////////////////////////
        // 🔹 RESPONSE
        //////////////////////////////////////////////////////////

        echo json_encode([
            'success' => true,
            'start'   => $start,
            'end'     => $end,
            'data'    => $result
        ]);
    }

    public function bricks_count()
    {
        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $start = (string) $this->input->get('start'); // '2026-01-01'
        $end   = (string) $this->input->get('end');   // '2026-12-31'

        $this->db->select('create_date as date, COUNT(*) as total_bricks', false);
        $this->db->from('tbl_bricks');  // 🔴 use your actual table name
        $this->db->where('user_id', $user_id);

        if (!empty($start)) {
            $this->db->where('create_date >=', $start);
        }

        if (!empty($end)) {
            $this->db->where('create_date <=', $end);
        }

        $this->db->group_by('create_date');

        $query = $this->db->get();

        // Debug (remove after testing)
        // echo $this->db->last_query(); die;

        $result = $query->result_array();

        echo json_encode([
            'success' => true,
            'start' => $start,
            'end' => $end,
            'data' => $result
        ]);
    }

    public function bricks_count_company()
    {
        // $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $start = (string) $this->input->get('start'); // '2026-01-01'
        $end   = (string) $this->input->get('end');   // '2026-12-31'
        $company_id = $this->input->get('company_id');
        $this->db->select('create_date as date, COUNT(*) as total_bricks', false);
        $this->db->from('tbl_bricks');  // 🔴 use your actual table name
        // $this->db->where('user_id', $user_id);
        $this->db->where('company_id', $company_id);

        if (!empty($start)) {
            $this->db->where('create_date >=', $start);
        }

        if (!empty($end)) {
            $this->db->where('create_date <=', $end);
        }

        $this->db->group_by('create_date');

        $query = $this->db->get();

        // Debug (remove after testing)
        // echo $this->db->last_query(); die;

        $result = $query->result_array();

        echo json_encode([
            'success' => true,
            'start' => $start,
            'end' => $end,
            'data' => $result
        ]);
    }

    public function bricks_count_project()
    {
        // $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $start = (string) $this->input->get('start'); // '2026-01-01'
        $end   = (string) $this->input->get('end');   // '2026-12-31'
        $project_id = $this->input->get('project_id');
        $this->db->select('create_date as date, COUNT(*) as total_bricks', false);
        $this->db->from('tbl_bricks');  // 🔴 use your actual table name
        // $this->db->where('user_id', $user_id);
        $this->db->where('project_id', $project_id);

        if (!empty($start)) {
            $this->db->where('create_date >=', $start);
        }

        if (!empty($end)) {
            $this->db->where('create_date <=', $end);
        }

        $this->db->group_by('create_date');

        $query = $this->db->get();

        // Debug (remove after testing)
        // echo $this->db->last_query(); die;

        $result = $query->result_array();

        echo json_encode([
            'success' => true,
            'start' => $start,
            'end' => $end,
            'data' => $result
        ]);
    }

    public function download_monthly_event_pdf()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id    = sessionId('freelancer_id');
        $start_date = $this->input->post('start_date'); // YYYY-MM-DD
        $end_date   = $this->input->post('end_date');   // YYYY-MM-DD
        // echo $start_date; die;
        if (empty($start_date) || empty($end_date)) {
            show_error('Start and End date are required');
            return;
        }

        // 🔁 Map content types to tables (same as movie_pdf)
        $content_type_map = [
            'text'  => 'calendar_textbox',
            'other' => 'calendar_otherlink',
            'docs'  => 'calendar_docs',
            'image' => 'calendar_image',
            'audio' => 'calendar_audio',
            'video' => 'calendar_video',
            'user'  => 'calendar_user',
            'contact' => 'calendar_contact',
            'brick' => 'calendar_brick',
            'dialogue' => 'calendar_dialogue',
            'press_release' => 'calendar_press_release'
        ];

        // 1️⃣ Get timeline masters between date range
        $this->db->from('calendar_timeline_master');
        $this->db->where('user_id', $user_id);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $timelines = $this->db->get()->result_array();

        $events = [];

        foreach ($timelines as $timeline_details) {

            $timeline_id = $timeline_details['id'];

            // 2️⃣ Get timeline items
            $timeline_items_raw = $this->CommonModal->getRowsWhere(
                'calendar_timeline_items',
                [
                    'user_id'     => $user_id,
                    'timeline_id' => $timeline_id
                ],
                'position ASC'
            );

            $timeline_items_final = [];

            if (!empty($timeline_items_raw)) {
                foreach ($timeline_items_raw as $item) {

                    if (empty($item['content_id'])) continue;

                    $table = $content_type_map[$item['content_type']] ?? null;
                    if (!$table) continue;

                    $content = $this->CommonModal->getRowWhere($table, [
                        'id' => $item['content_id']
                    ]);

                    if (!$content) continue;

                    // USER special case
                    if ($item['content_type'] === 'user' && !empty($content['timeline_user_id'])) {
                        $users = [];
                        foreach (explode(',', $content['timeline_user_id']) as $uid) {
                            $u = $this->CommonModal->getRowWhere('freelancer', ['id' => trim($uid)]);
                            if ($u) $users[] = $u;
                        }
                        $content['users'] = $users;
                    }

                    // BRICKS
                    if ($item['content_type'] === 'brick' && !empty($content['timeline_brick_id'])) {
                        $bricks = [];
                        foreach (explode(',', $content['timeline_brick_id']) as $bid) {
                            $bricks[] = $this->CommonModal->getRowWhere('bricks', ['id' => $bid]);
                        }
                        $content['bricks'] = array_filter($bricks);
                    }

                    // PRESS RELEASES (same logic)
                    if ($item['content_type'] === 'press_release') {
                        $press_releases = [];
                        $keys = $content['timeline_press_release_ids'] ?? '';
                        foreach (array_filter(array_map('trim', explode(',', $keys))) as $val) {
                            $parts = explode('_', $val, 2);
                            if (count($parts) !== 2) continue;

                            [$id, $type] = $parts;

                            $pr_table_map = [
                                'company' => 'company_press_release',
                                'user'    => 'user_press_release',
                                'project' => 'project_press_release'
                            ];

                            if (!isset($pr_table_map[$type])) continue;

                            $pr = $this->CommonModal->getRowWhere($pr_table_map[$type], ['id' => $id]);
                            if (!$pr) continue;

                            $pr['type'] = $type;
                            $pr['user'] = $this->CommonModal->getRowWhere('freelancer', ['id' => $pr['user_id']]);

                            if ($type === 'company') {
                                $pr['company'] = $this->CommonModal->getRowWhere('companies', ['id' => $pr['company_id']]);
                            } elseif ($type === 'project') {
                                $pr['company'] = $this->CommonModal->getRowWhere('companies', ['id' => $pr['company_id']]);
                                $pr['project'] = $this->CommonModal->getRowWhere('projects', ['id' => $pr['project_id']]);
                            }

                            $press_releases[] = $pr;
                        }
                        $content['press_releases'] = $press_releases;
                    }

                    $content['content_type'] = $item['content_type'];
                    $content['position']     = $item['position'];

                    $timeline_items_final[] = $content;
                }
            }

            $timeline_details['timeline_items'] = $timeline_items_final;
            $events[$timeline_id] = $timeline_details;
        }

        // dd($events);

        // Final payload for view
        $s_date = date('d-m-Y', strtotime($start_date));
        $e_date = date('d-m-Y', strtotime($end_date));
        $data['movie'] = [
            'makemymoviename' => "Events from $s_date to $e_date",
            'events' => $events
        ];

        $data['title'] = 'Monthly Calendar';

        // Render same PDF view
        $html = $this->load->view('movie_pdf', $data, true);
        echo $html; die;

        // Later: dompdf stream if needed
    }


    public function getMonthEventCounts()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // Expect: 2026-02 (YYYY-MM)
        $month = $this->input->get('month');

        if (empty($month)) {
            echo json_encode(['success' => false, 'message' => 'Month is required']);
            return;
        }

        // Build start & end of month
        $startDate = $month . '-01';
        $endDate   = date('Y-m-t', strtotime($startDate)); // last day of month

        $this->db->select('date, COUNT(id) as total_events');
        $this->db->from('tbl_calendar_timeline'); // 🔴 change to your actual table name
        $this->db->where('user_id', $user_id);
        $this->db->where('date >=', $startDate);
        $this->db->where('date <=', $endDate);
        $this->db->group_by('date');

        $result = $this->db->get()->result_array();

        /*
        Output shape:
        [
            { "date": "2026-02-01", "total_events": 3 },
            { "date": "2026-02-05", "total_events": 1 }
        ]
        */

        echo json_encode([
            'success' => true,
            'month' => $month,
            'data' => $result
        ]);
    }


    public function saveTextbox()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $textbox = trim($this->input->post('textbox'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($textbox)) {
            echo json_encode([
                'success' => false,
                'message' => 'Description cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'textbox_description' => $textbox,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_textbox', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Text updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_textbox', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Text saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveCharacter()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $character = trim($this->input->post('character'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($character)) {
            echo json_encode([
                'success' => false,
                'message' => 'Character cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'character'           => $character,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_character', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Character updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_character', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Character saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveAge()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $age = trim($this->input->post('age'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($age)) {
            echo json_encode([
                'success' => false,
                'message' => 'Age cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'age' => $age,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_age', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Age updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_age', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Age saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveEthnicity()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $ethnicity = trim($this->input->post('ethnicity'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($ethnicity)) {
            echo json_encode([
                'success' => false,
                'message' => 'Ethnicity cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'ethnicity'           => $ethnicity,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_ethnicity', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Ethnicity updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_ethnicity', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Ethnicity saved successfully!',
            'html'    => $html
        ]);
    }

    public function save_body_part()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $body_part = trim($this->input->post('body_part'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($body_part)) {
            echo json_encode([
                'success' => false,
                'message' => 'Body Part cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'body_part' => $body_part,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_body_part', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Body Part updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_body_part', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Body Part saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveProbability()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $probability = trim($this->input->post('probability'));
        $schedule_type = $this->input->post('scheduleType');

        if ($probability === null || $probability === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Probability cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'probability'         => $probability,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_probability', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Probability updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_probability', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Text saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveReligion()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $religion = trim($this->input->post('religion'));
        $schedule_type = $this->input->post('scheduleType');

        if ($religion === null || $religion === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Religion cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'religion'            => $religion,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_religion', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Religion updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_religion', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Religion saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveLanguage()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $language = trim($this->input->post('language'));
        $schedule_type = $this->input->post('scheduleType');

        if ($language === null || $language === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Language cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'language'            => $language,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_language', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Language updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_language', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Language saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveEmotion()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $emotion = trim($this->input->post('emotion'));
        $schedule_type = $this->input->post('scheduleType');

        if ($emotion === null || $emotion === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Emotion cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'emotion'             => $emotion,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_emotion', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Emotion updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_emotion', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Emotion saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveLevel()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $level = trim($this->input->post('level'));
        $schedule_type = $this->input->post('scheduleType');

        if ($level === null || $level === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Level cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'level'               => $level,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_level', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Level updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_level', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Level saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveCurrency()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $currency = trim($this->input->post('currency'));
        $schedule_type = $this->input->post('scheduleType');

        if ($currency === null || $currency === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Currency cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'currency'            => $currency,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_currency', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Currency updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_currency', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Currency saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveTravel()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $travel = trim($this->input->post('travel'));
        $schedule_type = $this->input->post('scheduleType');

        if ($travel === null || $travel === '') {
            echo json_encode([
                'success' => false,
                'message' => 'Travel cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'travel'              => $travel,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_travel', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Travel updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_travel', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Travel saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveCountry()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $country_code = trim($this->input->post('country'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($country_code)) {
            echo json_encode([
                'success' => false,
                'message' => 'Country Code cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'country_code' => $country_code,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_country', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Country updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_country', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Country saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveDeal()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $edit_id = $this->input->post('id');
        $deal_ask = trim($this->input->post('deal_ask'));
        $deal_give = trim($this->input->post('deal_give'));
        $schedule_type = $this->input->post('scheduleType');

        if (empty($deal_ask) || empty($deal_give)) {
            echo json_encode([
                'success' => false,
                'message' => 'ask or deal cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);

        if ($timelineData === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline error'
            ]);
            return;
        }
        
        $data = [
            'deal_ask'            => $deal_ask,
            'deal_give'           => $deal_give,
            'schedule_type'       => $timelineData['schedule_type'],
            'openingtime'         => $timelineData['openingtime_db'],
            'closingtime'         => $timelineData['closingtime_db'],
            'finaldatetime'       => $timelineData['finaldatetime_db'],
            'updated_date'        => $now
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_deal', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Deal updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        $data['user_id']      = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_deal', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);
        // echo $html; die;
        echo json_encode([
            'success' => true,
            'message' => 'Deal saved successfully!',
            'html'    => $html
        ]);
    }


    public function getCalendarData()
    {
        $user_id = sessionId('freelancer_id');
        $dateStr = $this->input->post('dateStr');
        // echo $dateStr; die;
        // Fetch textbox events
        $textbox = $this->db->get_where('tbl_calendar_textbox', [
            'user_id' => $user_id,
            'schedule_type' => 1,
            'created_date' => $dateStr,
        ])->result();

        // Fetch video events
        $videos = $this->db->get_where('tbl_calendar_video', [
            'schedule_type' => 1,
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result();

        // Fetch AUDIO events
        $audio = $this->db->get_where('tbl_calendar_audio', [
            'schedule_type' => 1,
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result();

        // Fetch AUDIO events
        $image = $this->db->get_where('tbl_calendar_image', [
            'schedule_type' => 1,
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result();

        // Fetch DOCS events
        $docs = $this->db->get_where('tbl_calendar_docs', [
            'schedule_type' => 1,
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result();

        // Fetch DOCS events
        $otherlink = $this->db->get_where('tbl_calendar_otherlink', [
            'schedule_type' => 1,
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result();


        echo json_encode([
            'textbox' => $textbox,
            'video'   => $videos,
            'audio' => $audio,
            'image' => $image,
            'docs' => $docs,
            'otherlink' => $otherlink,
        ]);
    }

    public function getCalendarDataNew()
    {
        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');
        $dateStr = $this->input->post('dateStr');

        $events = [];

        // TEXT
        foreach ($this->db->get_where('tbl_calendar_textbox', [
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result() as $row) {
            $events[] = [
                'type' => 'textbox',
                'schedule_type' => 0,
                'openingtime' => $row->openingtime,
                'closingtime' => $row->closingtime,
                'data' => $row
            ];
        }

        // VIDEO
        foreach ($this->db->get_where('tbl_calendar_video', [
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result() as $row) {
            $events[] = [
                'type' => 'video',
                'schedule_type' => 0,
                'openingtime' => $row->openingtime,
                'closingtime' => $row->closingtime,
                'data' => $row
            ];
        }

        // AUDIO
        foreach ($this->db->get_where('tbl_calendar_audio', [
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result() as $row) {
            $events[] = [
                'type' => 'audio',
                'schedule_type' => 0,
                'openingtime' => $row->openingtime,
                'closingtime' => $row->closingtime,
                'data' => $row
            ];
        }

        // IMAGE
        foreach ($this->db->get_where('tbl_calendar_image', [
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result() as $row) {
            $events[] = [
                'type' => 'image',
                'schedule_type' => 0,
                'openingtime' => $row->openingtime,
                'closingtime' => $row->closingtime,
                'data' => $row
            ];
        }

        // DOCS
        foreach ($this->db->get_where('tbl_calendar_docs', [
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result() as $row) {
            $events[] = [
                'type' => 'docs',
                'schedule_type' => 0,
                'openingtime' => $row->openingtime,
                'closingtime' => $row->closingtime,
                'data' => $row
            ];
        }

        // OTHER LINKS
        foreach ($this->db->get_where('tbl_calendar_otherlink', [
            'user_id' => $user_id,
            'created_date' => $dateStr,
        ])->result() as $row) {
            $events[] = [
                'type' => 'otherlink',
                'schedule_type' => 0,
                'openingtime' => $row->openingtime,
                'closingtime' => $row->closingtime,
                'data' => $row
            ];
        }

        // BRICKS
        // foreach ($this->db->get_where('tbl_bricks', [
        //     'user_id' => $user_id,
        //     'create_date' => $dateStr  
        // ])->result() as $row) {
        //     $events[] = [
        //         'type'  => 'bricks',
        //         'openingtime' => $row->create_date,
        //         'closingtime' => null,
        //         'data' => $row
        //     ];
        // }

        // OPTIONAL: sort by opening time (very useful)
        usort($events, function ($a, $b) {
            return strtotime($a['created_date']) <=> strtotime($b['created_date']);
        });

        echo json_encode([
            'events' => $events
        ]);
    }

    // public function getCalendarTimelineMaster() {

    //     $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');
    //     $dateStr = $this->input->post('dateStr');

    //     // echo $dateStr; die;

    //     $timelines = $this->CommonModal->getRowsWhere('calendar_timeline_master', [
    //         'user_id' => $user_id,
    //         'date' => $dateStr
    //     ]);

    //     $start = $dateStr . ' 00:00:00';
    //     $end   = date('Y-m-d 00:00:00', strtotime($dateStr . ' +1 day'));

    //     $bricks = $this->Event_model->get_between($start, $end, $user_id);

    //     echo json_encode([
    //         'timelines' => $timelines,
    //         'bricks' => $bricks
    //     ]);

    // }

    public function getCalendarTimelineMaster()
    {
        $user_id = sessionId('freelancer_id') ?: sessionId('admin_id');
        $permission_id = $this->input->post('permission_id');
        $dateStr = $this->input->post('dateStr');

        if (!$dateStr) {
            echo json_encode(['error' => 'No date provided']);
            return;
        }

        $project_id = $this->input->post('project_id');
        $company_id = $this->input->post('company_id');


        $permission_details = null;

        //////////////////////////////////////////////////////////
        // 🌍 PUBLIC MODE (No session but permission_id exists)
        //////////////////////////////////////////////////////////
        if (!$user_id && $permission_id) {

            $permission_details = $this->CommonModal->getRowWhere(
                'tbl_calendar_permissions',
                ['id' => $permission_id]
            );

            if (!$permission_details || $permission_details['is_public'] != 1) {
                echo json_encode(['error' => 'Invalid or private permission']);
                return;
            }

            // Validate that requested date is allowed
            if (!$this->isDateAllowedByPermission($permission_details, $dateStr)) {
                echo json_encode(['error' => 'Date not allowed by permission']);
                return;
            }

            $user_id = $permission_details['user_id'];
        }

        //////////////////////////////////////////////////////////
        // 🔐 OWNER MODE
        //////////////////////////////////////////////////////////
        if (!$user_id) {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        //////////////////////////////////////////////////////////
        // FETCH DATA
        //////////////////////////////////////////////////////////
        $timelines = [];
        
        if($company_id){
            $timelines = $this->CommonModal->getRowsWhere(
                'calendar_timeline_master',
                [
                    'date' => $dateStr,
                    'company_id' => $company_id
                ]
            );    
        }else if($project_id){
             $timelines = $this->CommonModal->getRowsWhere(
                'calendar_timeline_master',
                [
                    'date' => $dateStr,
                    'project_id' => $project_id
                ]
            );    
        }else{
            $timelines = $this->CommonModal->getRowsWhere(
                'calendar_timeline_master',
                [
                    'user_id' => $user_id,
                    'date' => $dateStr,
                    'project_id' => null,
                    'company_id' => null
                ]
            );
        }

        $start = $dateStr . ' 00:00:00';
        $end   = date('Y-m-d 00:00:00', strtotime($dateStr . ' +1 day'));

        $bricks = $this->Event_model->get_between($start, $end, $user_id);

        $appointments = $this->CommonModal->getRowsWhere('appointments', [
            'user_id' => $user_id,
            'start_datetime >=' => $start,
            'end_datetime <=' => $end
        ]);
        
        // dd($appointments);

        echo json_encode([
            'timelines' => $timelines,
            'bricks' => $bricks,
            'appointments' => $appointments
        ]);
    }

    private function isDateAllowedByPermission($permission, $dateStr)
    {
        $scope = $permission['permission_scope'];

        if ($scope == 'day') {
            return $dateStr == $permission['reference_date'];
        }

        if ($scope == 'month') {
            return substr($dateStr, 0, 7) == $permission['reference_month'];
        }

        if ($scope == 'year') {
            return substr($dateStr, 0, 4) == $permission['reference_year'];
        }

        return false;
    }

    public function saveVideo()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id   = $this->input->post('id');
        $videolink = trim($this->input->post('videolink'));
        $timeline_item_id = $this->input->post('timeline_item_id');

        // ==========================
        // CHECK FILE EXISTENCE (PHP 8 SAFE)
        // ==========================
        $hasFiles = false;

        if (isset($_FILES['videofile']['name'])) {
            if (is_array($_FILES['videofile']['name'])) {
                $hasFiles = !empty($_FILES['videofile']['name'][0]);
            } else {
                $hasFiles = !empty($_FILES['videofile']['name']);
            }
        }

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($videolink) && !$hasFiles) {
            echo json_encode([
                'success' => false,
                'message' => 'Video link or Video file Required!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // VIDEO UPLOAD (SINGLE + MULTIPLE)
        // ==========================
        $uploadedVideos = [];

        if ($hasFiles) {
            $path = FCPATH . 'uploads/calendar_video/';
            if (!is_dir($path)) mkdir($path, 0777, true);

            $config = [
                'upload_path'   => $path,
                'allowed_types' => 'mp4|mov|avi|mkv|webm',
                'max_size'      => 204800,
                'encrypt_name'  => true
            ];

            $this->load->library('upload');

            $names = $_FILES['videofile']['name'];
            $filesCount = is_array($names) ? count($names) : 1;

            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['video']['name']     = is_array($names)
                    ? preg_replace('/\s+/', '_', $_FILES['videofile']['name'][$i])
                    : preg_replace('/\s+/', $_FILES['videofile']['name']);

                $_FILES['video']['type']     = is_array($names) ? $_FILES['videofile']['type'][$i] : $_FILES['videofile']['type'];
                $_FILES['video']['tmp_name'] = is_array($names) ? $_FILES['videofile']['tmp_name'][$i] : $_FILES['videofile']['tmp_name'];
                $_FILES['video']['error']    = is_array($names) ? $_FILES['videofile']['error'][$i] : $_FILES['videofile']['error'];
                $_FILES['video']['size']     = is_array($names) ? $_FILES['videofile']['size'][$i] : $_FILES['videofile']['size'];

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'success' => false,
                        'message' => $this->upload->display_errors('', '')
                    ]);
                    return;
                }

                $uploadedVideos[] = $this->upload->data('file_name');
            }
        }

        // ==========================
        // SAVE DATA (MULTIPLE ROWS)
        // ==========================
        $insertedIds = [];

        if (!empty($uploadedVideos)) {
            foreach ($uploadedVideos as $videoName) {
                $data = [
                    'user_id'          => $user_id,
                    'videolink'        => $videolink,
                    'video'            => $videoName,
                    'timeline_item_id' => $timeline['new_timeline_item'] ?? $timeline_item_id,
                    'schedule_type'    => $timeline['schedule_type'],
                    'openingtime'      => $timeline['openingtime_db'],
                    'closingtime'      => $timeline['closingtime_db'],
                    'finaldatetime'    => $timeline['finaldatetime_db'],
                    'updated_date'     => $now
                ];

                $insertedIds[] = $this->Calender_model->saveOrUpdateVideo($data, null);
            }
        } else {
            $data = [
                'user_id'          => $user_id,
                'videolink'        => $videolink,
                'timeline_item_id' => $timeline['new_timeline_item'] ?? $timeline_item_id,
                'schedule_type'    => $timeline['schedule_type'],
                'openingtime'      => $timeline['openingtime_db'],
                'closingtime'      => $timeline['closingtime_db'],
                'finaldatetime'    => $timeline['finaldatetime_db'],
                'updated_date'     => $now
            ];

            $insertedIds[] = $this->Calender_model->saveOrUpdateVideo($data, $edit_id);
        }

        // ==========================
        // SYNC TIMELINE ITEMS
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'],
                $user_id,
                $timeline_items,
                $insertedIds[0]
            );
        }

        // ==========================
        // 🔥 RETURN PHP-RENDERED HTML
        // ==========================
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Videos saved successfully!',
            'html'    => $html
        ]);
    }


    // AUDIO FILE FUNCTIONALITY
    // public function saveAudio()
    // {
    //     // ==========================
    //     // AUTH
    //     // ==========================
    //     if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
    //         redirect(base_url(''));
    //     }

    //     $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

    //     // ==========================
    //     // INPUTS
    //     // ==========================
    //     $edit_id   = $this->input->post('id'); // edit mode
    //     $audiolink = trim($this->input->post('audiolink'));

    //     // ==========================
    //     // VALIDATION
    //     // ==========================
    //     if (empty($audiolink) && empty($_FILES['audiofile']['name'])) {
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Audio link cannot be empty!'
    //         ]);
    //         return;
    //     }

    //     date_default_timezone_set('Asia/Kolkata');
    //     $now = date('Y-m-d H:i:s');

    //     // ==========================
    //     // HANDLE TIMELINE
    //     // ==========================
    //     $timeline = $this->handleTimeline($user_id);

    //     if ($timeline === false) {
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Timeline could not be created'
    //         ]);
    //         return;
    //     }

    //     // ==========================
    //     // AUDIO UPLOAD
    //     // ==========================
    //     $uploadedAudioPath = null;

    //     if (!empty($_FILES['audiofile']['name'])) {

    //         $_FILES['audio'] = $_FILES['audiofile'];
    //         $_FILES['audio']['name'] = preg_replace('/\s+/', '_', $_FILES['audio']['name']);

    //         $path = FCPATH . 'uploads/calendar_audio/';
    //         if (!is_dir($path)) mkdir($path, 0777, true);

    //         $config = [
    //             'upload_path'   => $path,
    //             'allowed_types' => '*',
    //             'max_size'      => 10240,
    //             'encrypt_name'  => true,
    //             'detect_mime'   => false
    //         ];

    //         $this->load->library('upload');
    //         $this->upload->initialize($config);
    //         // echo '<pre>';
    //         // print_r($_FILES);
    //         // exit;
    //         if (!$this->upload->do_upload('audio')) {
    //             echo json_encode([
    //                 'success' => false,
    //                 'message' => $this->upload->display_errors('', '')
    //             ]);
    //             return;
    //         }

    //         $uploadedAudioPath = $this->upload->data('file_name');
    //     }

    //     // ==========================
    //     // DATA PAYLOAD
    //     // ==========================
    //     $data = [
    //         'user_id'       => $user_id,
    //         'audiolink'     => $audiolink,
    //         'schedule_type' => $timeline['schedule_type'],
    //         'openingtime'   => $timeline['openingtime_db'],
    //         'closingtime'   => $timeline['closingtime_db'],
    //         'finaldatetime' => $timeline['finaldatetime_db'],
    //         'updated_date'  => $now
    //     ];

    //     if ($uploadedAudioPath !== null) {
    //         $data['audio'] = $uploadedAudioPath;
    //     }

    //     // ==========================
    //     // UPDATE MODE
    //     // ==========================
    //     if (!empty($edit_id)) {
    //         $this->db->where('id', $edit_id)
    //                 ->where('user_id', $user_id)
    //                 ->update('tbl_calendar_audio', $data);

    //         // 🔥 Return PHP-rendered HTML
    //         $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

    //         echo json_encode([
    //             'success' => true,
    //             'message' => 'Audio updated successfully!',
    //             'html'    => $html
    //         ]);
    //         return;
    //     }

    //     // ==========================
    //     // CREATE MODE
    //     // ==========================
    //     $data['created_date'] = $now;
    //     $this->db->insert('tbl_calendar_audio', $data);
    //     $insertId = $this->db->insert_id();

    //     // ==========================
    //     // SYNC TIMELINE ITEMS
    //     // ==========================
    //     $timeline_items = json_decode($this->input->post('timeline'), true);

    //     if (!empty($timeline_items)) {
    //         $this->Calender_model->syncTimelineItems(
    //             $timeline['new_timeline_item'] ?? null,
    //             $user_id,
    //             $timeline_items,
    //             $insertId
    //         );
    //     }

    //     // 🔥 Return PHP-rendered HTML
    //     $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

    //     echo json_encode([
    //         'success' => true,
    //         'message' => 'Audio saved successfully!',
    //         'html'    => $html
    //     ]);
    // }

    public function saveAudio()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id   = $this->input->post('id');
        $audiolink = trim($this->input->post('audiolink'));
        $timeline_item_id = $this->input->post('timeline_item_id');

        // ==========================
        // CHECK FILE EXISTENCE
        // ==========================
        $hasFiles = false;

        if (isset($_FILES['audiofile']['name'])) {
            if (is_array($_FILES['audiofile']['name'])) {
                $hasFiles = !empty($_FILES['audiofile']['name'][0]);
            } else {
                $hasFiles = !empty($_FILES['audiofile']['name']);
            }
        }

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($audiolink) && !$hasFiles) {
            echo json_encode([
                'success' => false,
                'message' => 'Audio link or Audio file required!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // AUDIO UPLOAD (MULTIPLE)
        // ==========================
        $uploadedAudios = [];

        if ($hasFiles) {

            $path = FCPATH . 'uploads/calendar_audio/';
            if (!is_dir($path)) mkdir($path, 0777, true);

            $config = [
                'upload_path'   => $path,
                'allowed_types' => '*',
                'max_size'      => 10240,
                'encrypt_name'  => true
            ];

            $this->load->library('upload');

            $names = $_FILES['audiofile']['name'];
            $filesCount = is_array($names) ? count($names) : 1;

            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['audio']['name'] = is_array($names)
                    ? preg_replace('/\s+/', '_', $_FILES['audiofile']['name'][$i])
                    : preg_replace('/\s+/', '_', $_FILES['audiofile']['name']);

                $_FILES['audio']['type']     = is_array($names) ? $_FILES['audiofile']['type'][$i] : $_FILES['audiofile']['type'];
                $_FILES['audio']['tmp_name'] = is_array($names) ? $_FILES['audiofile']['tmp_name'][$i] : $_FILES['audiofile']['tmp_name'];
                $_FILES['audio']['error']    = is_array($names) ? $_FILES['audiofile']['error'][$i] : $_FILES['audiofile']['error'];
                $_FILES['audio']['size']     = is_array($names) ? $_FILES['audiofile']['size'][$i] : $_FILES['audiofile']['size'];

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('audio')) {

                    echo json_encode([
                        'success' => false,
                        'message' => $this->upload->display_errors('', '')
                    ]);
                    return;
                }

                $uploadedAudios[] = $this->upload->data('file_name');
            }
        }

        // ==========================
        // SAVE DATA
        // ==========================
        $insertedIds = [];

        if (!empty($uploadedAudios)) {

            foreach ($uploadedAudios as $audioName) {

                $data = [
                    'user_id'          => $user_id,
                    'audiolink'        => $audiolink,
                    'audio'            => $audioName,
                    'timeline_item_id' => $timeline['new_timeline_item'] ?? $timeline_item_id,
                    'schedule_type'    => $timeline['schedule_type'],
                    'openingtime'      => $timeline['openingtime_db'],
                    'closingtime'      => $timeline['closingtime_db'],
                    'finaldatetime'    => $timeline['finaldatetime_db'],
                    'updated_date'     => $now
                ];

                $this->db->insert('tbl_calendar_audio', $data);
                $insertedIds[] = $this->db->insert_id();
            }

        } else {

            $data = [
                'user_id'          => $user_id,
                'audiolink'        => $audiolink,
                'timeline_item_id' => $timeline['new_timeline_item'] ?? $timeline_item_id,
                'schedule_type'    => $timeline['schedule_type'],
                'openingtime'      => $timeline['openingtime_db'],
                'closingtime'      => $timeline['closingtime_db'],
                'finaldatetime'    => $timeline['finaldatetime_db'],
                'updated_date'     => $now
            ];

            if (!empty($edit_id)) {

                $this->db->where('id', $edit_id)
                        ->where('user_id', $user_id)
                        ->update('tbl_calendar_audio', $data);

                $insertedIds[] = $edit_id;

            } else {

                $data['created_date'] = $now;
                $this->db->insert('tbl_calendar_audio', $data);
                $insertedIds[] = $this->db->insert_id();
            }
        }

        // ==========================
        // SYNC TIMELINE
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {

            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'],
                $user_id,
                $timeline_items,
                $insertedIds[0]
            );
        }

        // ==========================
        // RETURN HTML
        // ==========================
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Audio saved successfully!',
            'html'    => $html
        ]);
    }


    public function saveImage()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id   = $this->input->post('id'); // for edit
        $imagelink = trim($this->input->post('imagelink'));
        $timeline_item_id = $this->input->post('timeline_item_id');

        // ==========================
        // CHECK FILE EXISTENCE (PHP 8 SAFE)
        // ==========================
        $hasFiles = false;

        if (isset($_FILES['imagefile']['name'])) {
            if (is_array($_FILES['imagefile']['name'])) {
                $hasFiles = !empty($_FILES['imagefile']['name'][0]);
            } else {
                $hasFiles = !empty($_FILES['imagefile']['name']);
            }
        }

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($imagelink) && !$hasFiles) {
            echo json_encode([
                'success' => false,
                'message' => 'Image link and File cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // IMAGE UPLOAD (SINGLE + MULTIPLE)
        // ==========================
        $uploadedImages = [];

        if ($hasFiles) {

            $path = FCPATH . 'uploads/calendar_image/';

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $config = [
                'upload_path'   => $path,
                'allowed_types' => '*',
                'max_size'      => 10240,
                'encrypt_name'  => true
            ];

            $this->load->library('upload');

            $names = $_FILES['imagefile']['name'];
            $filesCount = is_array($names) ? count($names) : 1;

            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['image']['name']     = is_array($names)
                    ? preg_replace('/\s+/', '_', $_FILES['imagefile']['name'][$i])
                    : preg_replace('/\s+/', '_', $_FILES['imagefile']['name']);

                $_FILES['image']['type']     = is_array($names)
                    ? $_FILES['imagefile']['type'][$i]
                    : $_FILES['imagefile']['type'];

                $_FILES['image']['tmp_name'] = is_array($names)
                    ? $_FILES['imagefile']['tmp_name'][$i]
                    : $_FILES['imagefile']['tmp_name'];

                $_FILES['image']['error']    = is_array($names)
                    ? $_FILES['imagefile']['error'][$i]
                    : $_FILES['imagefile']['error'];

                $_FILES['image']['size']     = is_array($names)
                    ? $_FILES['imagefile']['size'][$i]
                    : $_FILES['imagefile']['size'];

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    echo json_encode([
                        'success' => false,
                        'message' => $this->upload->display_errors('', '')
                    ]);
                    return;
                }

                $uploadedImages[] = $this->upload->data('file_name');
            }
        }

        // ==========================
        // SAVE DATA (MULTIPLE ROWS)
        // ==========================
        $insertedIds = [];

        if (!empty($uploadedImages)) {
            foreach ($uploadedImages as $imageName) {
                $data = [
                    'user_id'          => $user_id,
                    'imagelink'        => $imagelink,
                    'image'            => $imageName,
                    'timeline_item_id' => $timeline['new_timeline_item'] ?? $timeline_item_id,
                    'schedule_type'    => $timeline['schedule_type'],
                    'openingtime'      => $timeline['openingtime_db'],
                    'closingtime'      => $timeline['closingtime_db'],
                    'finaldatetime'    => $timeline['finaldatetime_db'],
                    'updated_date'     => $now
                ];

                $insertedIds[] = $this->Calender_model->saveOrUpdateImage($data, null);
            }
        } else {
            $data = [
                'user_id'          => $user_id,
                'imagelink'        => $imagelink,
                'timeline_item_id' => $timeline['new_timeline_item'] ?? $timeline_item_id,
                'schedule_type'    => $timeline['schedule_type'],
                'openingtime'      => $timeline['openingtime_db'],
                'closingtime'      => $timeline['closingtime_db'],
                'finaldatetime'    => $timeline['finaldatetime_db'],
                'updated_date'     => $now
            ];

            $insertedIds[] = $this->Calender_model->saveOrUpdateImage($data, $edit_id);
        }

        // ==========================
        // SYNC TIMELINE ITEMS
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'],
                $user_id,
                $timeline_items,
                $insertedIds[0]
            );
        }

        // ==========================
        // 🔥 RETURN PHP-RENDERED HTML
        // ==========================
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Images saved successfully!',
            'html'    => $html
        ]);
    }






    // DOCS FILE FUNCTIONALITY
    public function saveDocsLink()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id  = $this->input->post('id'); // edit mode
        $docslink = trim($this->input->post('docslink'));

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($docslink) && empty($_FILES['docsfile']['name'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Docs link & Docs File cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // DOCS UPLOAD
        // ==========================
        $uploadedDocsPath = null;

        if (!empty($_FILES['docsfile']['name'])) {

            $_FILES['docs'] = $_FILES['docsfile'];
            $_FILES['docs']['name'] = preg_replace('/\s+/', '_', $_FILES['docs']['name']);

            $path = FCPATH . 'uploads/calendar_docs/';
            if (!is_dir($path)) mkdir($path, 0777, true);

            $config = [
                'upload_path'   => $path,
                'allowed_types' => 'pdf|doc|docx|xls|xlsx|ppt|pptx|txt|html',
                'max_size'      => 10240,
                'encrypt_name'  => true
            ];

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('docs')) {
                echo json_encode([
                    'success' => false,
                    'message' => $this->upload->display_errors('', '')
                ]);
                return;
            }

            $uploadedDocsPath = $this->upload->data('file_name');
        }

        // ==========================
        // DATA PAYLOAD
        // ==========================
        $data = [
            'user_id'       => $user_id,
            'docslink'      => $docslink,
            'schedule_type' => $timeline['schedule_type'],
            'openingtime'   => $timeline['openingtime_db'],
            'closingtime'   => $timeline['closingtime_db'],
            'finaldatetime' => $timeline['finaldatetime_db'],
            'updated_date'  => $now
        ];

        if ($uploadedDocsPath !== null) {
            $data['docs'] = $uploadedDocsPath;
        }

        // ==========================
        // UPDATE MODE
        // ==========================
        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_docs', $data);

            // 🔥 Return PHP-rendered HTML
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Docs updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_docs', $data);
        $insertId = $this->db->insert_id();

        // ==========================
        // SYNC TIMELINE ITEMS
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $user_id,
                $timeline_items,
                $insertId
            );
        }

        // 🔥 Return PHP-rendered HTML
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Docs saved successfully!',
            'html'    => $html
        ]);
    }


    // saveCategory
    public function saveCategory()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id      = $this->input->post('id'); // edit mode
        $otherlink    = trim($this->input->post('otherlink'));
        $time         = $this->input->post('time');
        $timeslot     = $this->input->post('timeslot');
        $linkcategory = $this->input->post('linkcategory');

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($otherlink)) {
            echo json_encode([
                'success' => false,
                'message' => 'Other link cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // DATA PAYLOAD
        // ==========================
        $data = [
            'user_id'       => $user_id,
            'otherlink'     => $otherlink,
            'time'          => $time,
            'timeslot'      => $timeslot,
            'linkcategory'  => $linkcategory,
            'schedule_type' => $timeline['schedule_type'],
            'openingtime'   => $timeline['openingtime_db'],
            'closingtime'   => $timeline['closingtime_db'],
            'finaldatetime' => $timeline['finaldatetime_db'],
            'updated_date'  => $now,
        ];

        // ==========================
        // UPDATE MODE
        // ==========================
        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_otherlink', $data);

            // 🔥 Return PHP-rendered HTML
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Other link updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_otherlink', $data);
        $insertId = $this->db->insert_id();

        // ==========================
        // SYNC TIMELINE ITEMS
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $user_id,
                $timeline_items,
                $insertId
            );
        }

        // 🔥 Return PHP-rendered HTML
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Other link saved successfully!',
            'html'    => $html
        ]);
    }



    public function saveContact()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id = $this->input->post('id'); // edit mode
        $contact = trim($this->input->post('contact'));

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($contact)) {
            echo json_encode([
                'success' => false,
                'message' => 'Contact number cannot be empty!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // DATA PAYLOAD
        // ==========================
        $data = [
            'user_id'       => $user_id,
            'contact'       => $contact,
            'schedule_type' => $timeline['schedule_type'],
            'openingtime'   => $timeline['openingtime_db'],
            'closingtime'   => $timeline['closingtime_db'],
            'finaldatetime' => $timeline['finaldatetime_db'],
            'updated_date'  => $now
        ];

        // ==========================
        // UPDATE MODE
        // ==========================
        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_contact', $data);

            // 🔥 Return PHP-rendered HTML
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Contact updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_contact', $data);
        $insertId = $this->db->insert_id();

        // ==========================
        // SYNC TIMELINE ITEMS
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);
        
        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $user_id,
                $timeline_items,
                $insertId
            );
        }

        // 🔥 Return PHP-rendered HTML
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Contact saved successfully!',
            'html'    => $html
        ]);
    }


    public function saveUser()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $auth_user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id   = $this->input->post('id');
        $users     = json_decode($this->input->post('user'));
        $user_mode = $this->input->post('user_mode') ?? 'create-user'; // 🔥 new
        $timeline_item_id = $this->input->post('timeline_item_id');    // 🔥 for dialogue

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($users) || !is_array($users)) {
            echo json_encode([
                'success' => false,
                'message' => 'At least one user is required!'
            ]);
            return;
        }

        // ==========================
        // EXTRACT USER IDS
        // ==========================
        $userIds = [];

        foreach ($users as $u) {
            if (!empty($u->value)) {
                $userIds[] = $u->value;
            }
        }

        if (empty($userIds)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid user data!'
            ]);
            return;
        }

        $userIds = array_unique($userIds);
        $userIdsCsv = implode(',', $userIds);

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($auth_user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ======================================================
        // 🔥 MODE: ADD RECEIVERS TO EXISTING DIALOGUE
        // ======================================================
        if ($user_mode === 'add-receiver') {

            if (empty($timeline_item_id)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Timeline item missing for dialogue!'
                ]);
                return;
            }

            $dialogue = $this->CommonModal->getRowWhere('tbl_calendar_dialogue', [
                'timeline_item_id' => $timeline_item_id
            ]);

            if (!$dialogue) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Dialogue not found for this timeline item!'
                ]);
                return;
            }

            // Merge existing receivers + new receivers
            $existing = array_filter(explode(',', (string) $dialogue['to_user_id']));
            $merged   = array_unique(array_merge($existing, $userIds));
            $mergedCsv = implode(',', $merged);

            $this->db->where('id', $dialogue['id'])->update('tbl_calendar_dialogue', [
                'to_user_id'  => $mergedCsv,
                'updated_date'=> $now
            ]);

            // 🔥 Return full PHP-rendered timeline
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Receivers added to dialogue successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ======================================================
        // 🔥 MODE: NORMAL USER BLOCK (timeline user)
        // ======================================================

        $data = [
            'user_id'          => $auth_user_id,
            'timeline_user_id' => $userIdsCsv,
            'schedule_type'    => $timeline['schedule_type'],
            'openingtime'      => $timeline['openingtime_db'],
            'closingtime'      => $timeline['closingtime_db'],
            'finaldatetime'    => $timeline['finaldatetime_db'],
            'updated_date'     => $now
        ];

        // ==========================
        // UPDATE MODE
        // ==========================
        if ($edit_id) {
            $this->CommonModal->updateRowById('calendar_user', 'id', $edit_id, $data);

            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Users updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_user', $data);
        $insertId = $this->db->insert_id();

        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $auth_user_id,
                $timeline_items,
                $insertId
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Users saved successfully!',
            'html'    => $html
        ]);
    }



    public function saveBrick()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $auth_user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id = $this->input->post('id');
        $bricks  = $this->input->post('brick');  // frontend sends CSV

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($bricks)) {
            echo json_encode([
                'success' => false,
                'message' => 'At least one brick is required!'
            ]);
            return;
        }

        // ==========================
        // EXTRACT BRICK IDS
        // ==========================
        $brickIds = array_filter(array_unique(explode(',', $bricks)));

        if (empty($brickIds)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid brick data!'
            ]);
            return;
        }

        $timeline_brick_ids = implode(',', $brickIds);

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($auth_user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // DATA PAYLOAD
        // ==========================
        $data = [
            'user_id'           => $auth_user_id,
            'timeline_brick_id' => $timeline_brick_ids,
            'schedule_type'     => $timeline['schedule_type'],
            'openingtime'       => $timeline['openingtime_db'],
            'closingtime'       => $timeline['closingtime_db'],
            'finaldatetime'     => $timeline['finaldatetime_db'],
            'updated_date'      => $now
        ];

        // ==========================
        // UPDATE MODE
        // ==========================
        if ($edit_id) {
            $this->CommonModal->updateRowById('tbl_calendar_brick', 'id', $edit_id, $data);

            // 🔥 Return PHP-rendered timeline HTML
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Bricks updated successfully',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_brick', $data);
        $insertId = $this->db->insert_id();

        // ==========================
        // SYNC TIMELINE ITEMS
        // ==========================
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $auth_user_id,
                $timeline_items,
                $insertId
            );
        }

        // 🔥 Return PHP-rendered timeline HTML
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Bricks saved successfully!',
            'html'    => $html
        ]);
    }


    public function savePressRelease()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $auth_user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id = $this->input->post('id');
        $press_releases = $this->input->post('press_release');  // JSON array [{id, type}]

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($press_releases)) {
            echo json_encode([
                'success' => false,
                'message' => 'At least one press release is required!'
            ]);
            return;
        }

        // ==========================
        // EXTRACT PRESS RELEASE IDS WITH TYPE
        // ==========================
        $prData = is_array($press_releases) ? $press_releases : json_decode($press_releases, true);

        if (!is_array($prData) || empty($prData)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid press release data!'
            ]);
            return;
        }

        // Build CSV like: "9_user,8_company,7_company,39_project"
        $timeline_pr_ids = implode(',', array_map(function ($item) {
            return trim($item['id']) . '_' . trim($item['type']);
        }, $prData));

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($auth_user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // DATA PAYLOAD
        // ==========================
        $data = [
            'user_id'                    => $auth_user_id,
            'timeline_press_release_ids' => $timeline_pr_ids,
            'schedule_type'              => $timeline['schedule_type'],
            'openingtime'                => $timeline['openingtime_db'],
            'closingtime'                => $timeline['closingtime_db'],
            'finaldatetime'              => $timeline['finaldatetime_db'],
            'updated_date'               => $now
        ];

        // ==========================
        // UPDATE MODE
        // ==========================
        if ($edit_id) {
            $this->CommonModal->updateRowById('tbl_calendar_press_release', 'id', $edit_id, $data);

            // 🔥 Return PHP-rendered timeline HTML
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Press releases updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_press_release', $data);
        $insertId = $this->db->insert_id();

        /* ==========================
        🔥 UPDATE timeline_items WITH content_id
        ========================== */
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $auth_user_id,
                $timeline_items,
                $insertId
            );
        }

        // 🔥 Return PHP-rendered timeline HTML
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Press releases saved successfully!',
            'html'    => $html
        ]);
    }


    public function saveDialogue()
    {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        // ==========================
        // INPUTS
        // ==========================
        $edit_id          = $this->input->post('id');
        $dialogue         = trim($this->input->post('dialogue'));
        $sender_ids       = trim($this->input->post('sender_ids'));
        $timeline_item_id = $this->input->post('timeline_item_id');

        // ==========================
        // VALIDATION
        // ==========================
        if (empty($dialogue)) {
            echo json_encode([
                'success' => false,
                'message' => 'Dialogue cannot be empty!'
            ]);
            return;
        }

        if (empty($timeline_item_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline position missing!'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        // ==========================
        // HANDLE TIMELINE
        // ==========================
        $timeline = $this->handleTimeline($user_id);

        if ($timeline === false) {
            echo json_encode([
                'success' => false,
                'message' => 'Timeline could not be created'
            ]);
            return;
        }

        // ==========================
        // DATA PAYLOAD
        // ==========================
        $data = [
            'user_id'           => $user_id,
            'timeline_item_id'  => $timeline_item_id,
            'dialogue'          => $dialogue,
            'from_user_id'      => $sender_ids,
            'to_user_id'        => null,
            'schedule_type'     => $timeline['schedule_type'],
            'openingtime'       => $timeline['openingtime_db'],
            'closingtime'       => $timeline['closingtime_db'],
            'finaldatetime'     => $timeline['finaldatetime_db'],
            'updated_date'      => $now
        ];

        // ==========================
        // UPDATE MODE
        // ==========================
        if (!empty($edit_id)) {

            $this->db->where('id', $edit_id)
                    ->where('user_id', $user_id)
                    ->update('tbl_calendar_dialogue', $data);

            // 🔥 Return PHP-rendered timeline HTML
            $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

            echo json_encode([
                'success' => true,
                'message' => 'Dialogue updated successfully!',
                'html'    => $html
            ]);
            return;
        }

        // ==========================
        // CREATE MODE
        // ==========================
        $data['created_date'] = $now;
        $this->db->insert('tbl_calendar_dialogue', $data);
        $insertId = $this->db->insert_id();

        /* ==========================
        🔥 UPDATE timeline_items WITH content_id
        ========================== */
        $timeline_items = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline_items)) {
            $this->Calender_model->syncTimelineItems(
                $timeline['new_timeline_item'] ?? null,
                $user_id,
                $timeline_items,
                $insertId
            );
        }

        // 🔥 Return PHP-rendered timeline HTML
        $html = $this->renderTimelineHtmlForPanel($timeline['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Dialogue saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveFinance()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');
        $edit_id = $this->input->post('id');
        $amount  = $this->input->post('finance');
        $timeline_item_id = $this->input->post('timeline_item_id');

        if (empty($amount)) {
            echo json_encode(['success' => false, 'message' => 'Amount is required']);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $timelineData = $this->handleTimeline($user_id);
        if ($timelineData === false) {
            echo json_encode(['success' => false, 'message' => 'Timeline error']);
            return;
        }

        $data = [
            'amount'       => $amount,
            'updated_date' => $now,
            'timeline_item_id' => $timeline_item_id,
        ];

        if (!empty($edit_id)) {
            $this->db->where('id', $edit_id)->where('user_id', $user_id)
                    ->update('tbl_calendar_finance', $data);

            $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

            echo json_encode(['success' => true, 'message' => 'Finance updated', 'html' => $html]);
            return;
        }

        $data['user_id'] = $user_id;
        $data['created_date'] = $now;

        $this->db->insert('tbl_calendar_finance', $data);
        $insertId = $this->db->insert_id();

        $timeline = json_decode($this->input->post('timeline'), true);

        if (!empty($timeline)) {
            $this->Calender_model->syncTimelineItems(
                $timelineData['new_timeline_item'] ?? null,
                $user_id,
                $timeline,
                $insertId,
                'finance' // 👈 content_type
            );
        }

        $html = $this->renderTimelineHtmlForPanel($timelineData['timeline_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Finance saved successfully!',
            'html'    => $html
        ]);
    }

    public function saveBlackLine()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');
        $timeline_item_id = $this->input->post('timeline_item_id');

        if (empty($timeline_item_id)) {
            echo json_encode(['success' => false, 'message' => 'Invalid timeline item']);
            return;
        }

        $this->db->where('id', $timeline_item_id)
                ->where('user_id', $user_id)
                ->update('calendar_timeline_items', ['has_black_line' => 1]);

        $timeline_item = $this->db->where('id', $timeline_item_id)->get('calendar_timeline_items')->row();
        // dd($timeline_item);
        // 🔥 Re-render timeline panel HTML
        // $timeline_id = $this->input->post('timeline_id') ?? null;
        if ($timeline_item) {
            $html = $this->renderTimelineHtmlForPanel($timeline_item->timeline_id);
        } else {
            $html = null;
        }

        echo json_encode([
            'success' => true,
            'message' => 'Black line added',
            'html'    => $html
        ]);
    }



    public function updateDialogueReceivers()
    {

        $timeline_item_id = $this->input->post('timeline_item_id');
        $users       = json_decode($this->input->post('user'), true);

        $receiverIds = array_map(function ($u) {
            return $u['value'] ?? null;
        }, $users);

        $receiverIds = array_filter($receiverIds);        // remove nulls
        $receiverIds = implode(',', array_unique($receiverIds));

        // dd($receiverIds);
        $this->db->where('timeline_item_id', $timeline_item_id)
                ->update('tbl_calendar_dialogue', [
                    'to_user_id' => $receiverIds
                ]);

        $timeline_item = $this->db->where('id', $timeline_item_id)->get('calendar_timeline_items')->row();

        $html = $this->renderTimelineHtmlForPanel($timeline_item->timeline_id);

        echo json_encode([
            'success' => true,
            'message' => 'Receivers updated',
            'html'    => $html
        ]);
    }


    private function getTimelineDataForPanel($timeline_id, $user_id = null, $schedule_type = 0)
    {

        if (!$user_id) {
            $user_id = sessionId('freelancer_id') ?: sessionId('admin_id');
        }

        if (!$user_id) {
            return null; // prevent unexpected behaviour
        }

        $content_type_map = [
            'text'  => 'calendar_textbox',
            'other' => 'calendar_otherlink',
            'docs'  => 'calendar_docs',
            'image' => 'calendar_image',
            'audio' => 'calendar_audio',
            'video' => 'calendar_video',
            'user'  => 'calendar_user',
            'contact' => 'calendar_contact',
            'brick' => 'calendar_brick',
            'dialogue' => 'calendar_dialogue',
            'press_release' => 'calendar_press_release',
            'country' => 'calendar_country',
            'probability' => 'calendar_probability',
            'religion' => 'calendar_religion',
            'emotion' => 'calendar_emotion',
            'level' => 'calendar_level',
            'currency' => 'calendar_currency',
            'travel' => 'calendar_travel',
            'deal' => 'calendar_deal',
            'age' => 'calendar_age',
            'body_part' => 'calendar_body_part',
            'ethnicity' => 'calendar_ethnicity',
            'character' => 'calendar_character'
        ];

        $calendar_timeline = [];

        $timeline_details = $this->CommonModal->getRowWhere('calendar_timeline_master', [
            'user_id' => $user_id,
            'id'      => $timeline_id,
            'schedule_type' => $schedule_type
        ]);

        $timeline_items = $this->CommonModal->getRowsWhere(
            'calendar_timeline_items',
            [
                'user_id'     => $user_id,
                'timeline_id' => $timeline_id
            ],
            'position ASC'
        );

        if ($timeline_items) {
            $finance_total = 0;
            foreach ($timeline_items as $key => $item) {

                if (empty($item['content_id'])) continue;

                $table = $content_type_map[$item['content_type']] ?? null;
                if (!$table) continue;

                $content = $this->CommonModal->getRowWhere($table, [
                    'id' => $item['content_id']
                ]);

                $is_black_line = $item['has_black_line'];

                $content['is_black_line'] = $is_black_line;

                $finance = '';

                if($is_black_line == '1'){

                    $finance = $this->CommonModal->getRowWhere('calendar_finance', [
                        'timeline_item_id' => $item['id']
                    ]);
                    $finance_total = $finance_total + $finance['amount'];
                    $content['finance'] = $finance;
                }

                if ($item['content_type'] == 'video') {
                    $content['additional_videos'] = $this->CommonModal->getRowsWhere('calendar_video', [
                        'timeline_item_id' => $item['id']
                    ]);
                }

                if ($item['content_type'] == 'image') {
                    $content['additional_images'] = $this->CommonModal->getRowsWhere('calendar_image', [
                        'timeline_item_id' => $item['id']
                    ]);
                }

                if ($item['content_type'] == 'audio') {
                    $content['additional_audios'] = $this->CommonModal->getRowsWhere('calendar_audio', [
                        'timeline_item_id' => $item['id']
                    ]);
                }

                if ($item['content_type'] == 'user') {
                    $users = [];
                    $user_id_arr = explode(',', $content['timeline_user_id'] ?? '');

                    foreach ($user_id_arr as $user_id) {
                        if (!$user_id) continue;
                        $users[] = $this->CommonModal->getRowWhere('freelancer', ['id' => $user_id]);
                    }

                    $dialogue = $this->CommonModal->getRowWhere('tbl_calendar_dialogue', [
                        'timeline_item_id' => $item['id'] // 🔥 FIX: use item id, not $key
                    ]);

                    $receiver_ids = $dialogue['to_user_id'];
                    $receiver_ids_arr = explode(',', $receiver_ids);

                    foreach ($receiver_ids_arr as $receiver_id) {
                        if (!$receiver_id) continue;
                        $receivers[] = $this->CommonModal->getRowWhere('freelancer', ['id' => $receiver_id]);
                    }

                    $content['receivers'] = $receivers;
                    $content['users'] = $users;
                    $content['dialogue'] = $dialogue;
                }

                if ($item['content_type'] == 'brick') {
                    $bricks = [];
                    $brick_id_arr = explode(',', $content['timeline_brick_id'] ?? '');

                    foreach ($brick_id_arr as $brick_id) {
                        if (!$brick_id) continue;
                        $bricks[] = $this->CommonModal->getRowWhere('bricks', ['id' => $brick_id]);
                    }

                    $content['bricks'] = $bricks;
                }

                if ($item['content_type'] == 'press_release') {
                    $press_releases = [];

                    $press_release_keys = $content['timeline_press_release_ids'] ?? '';

                    if (!empty($press_release_keys)) {
                        $key_arr = explode(',', $press_release_keys);
                    } else {
                        $key_arr = [];
                    }

                    $press_release_map = [];

                    foreach ($key_arr as $val) {

                        $val = trim($val);

                        $parts = explode('_', $val, 2);

                        if (count($parts) !== 2) continue;

                        $id   = $parts[0];
                        $type = $parts[1];

                        if (empty($id) || empty($type)) continue;

                        $press_release_map[] = [
                            'id'   => $id,
                            'type' => $type
                        ];
                    }

                    foreach ($press_release_map as $map) {

                        $pr_table_map = [
                            'company' => 'company_press_release',
                            'user'    => 'user_press_release',
                            'project' => 'project_press_release'
                        ];

                        if (!isset($pr_table_map[$map['type']])) continue;

                        $pr = $this->CommonModal->getRowWhere(
                            $pr_table_map[$map['type']],
                            ['id' => $map['id']]
                        );

                        if (!$pr) continue;

                        $pr['type'] = $map['type'];
                        $pr['user'] = $this->CommonModal->getRowWhere('freelancer', ['id' => $pr['user_id']]);

                        if ($pr['type'] == 'company') {
                            $pr['company'] = $this->CommonModal->getRowWhere('companies', ['id' => $pr['company_id']]);
                        } elseif ($pr['type'] == 'project') {
                            $pr['company'] = $this->CommonModal->getRowWhere('companies', ['id' => $pr['company_id']]);
                            $pr['project'] = $this->CommonModal->getRowWhere('projects', ['id' => $pr['project_id']]);
                        }

                        $press_releases[] = $pr;
                    }

                    if (!empty($press_releases)) {
                        $content['press_releases'] = $press_releases;
                    }

                    if (!empty($press_releases)) {
                        $content['press_releases'] = $press_releases;
                    }
                }

                if ($content) {
                    $content['content_type'] = $item['content_type'];
                    $content['position']     = $item['position'];
                    $calendar_timeline[$item['id']]     = $content; // keep order
                }
            }
        }
        // dd($calendar_timeline);
        return [
            'timeline'         => $calendar_timeline,
            'timeline_details' => $timeline_details,
            'finance_total'    => $finance_total,
        ];
    }


    private function renderTimelineHtmlForPanel($timeline_id)
    {
        $calendar = $this->getTimelineDataForPanel($timeline_id);
        
        return $this->load->view('calendar/timeline', [
            'calendar' => $calendar
        ], true);
    }



    // DATA GET FROM CALENDAR DATA AND TIME - FOR DATA SHOWCASE TAB WISE
    public function gettextdata()
    {
        $scheduleType = $this->input->get('scheduleType');
        $user_id = sessionId('freelancer_id');

        if($scheduleType == 0){
            $date = $this->input->get('date');
        }

        $this->db->where("user_id", $user_id);

        if($scheduleType == 0){
            $this->db->where("DATE(finaldatetime)", $date);
        }
        $this->db->where("schedule_type", $scheduleType);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("tbl_calendar_textbox");
        $data = $query->result();
        

        $this->db->where("id", $user_id);
        $query = $this->db->get('freelancer');
        $user = $query->row();
        
        // print_r($data); die;
        echo json_encode([
            'status' => 'success',
            'message' => 'Data fetched successfully',
            'data' => $data,
            'user' => $user
        ]);
    }

    // DATA GET CALENDAR IMAGE FOR TIME LIST
    public function getImagesdata()
    {
        $scheduleType = $this->input->get('scheduleType');

        if($scheduleType == 0){
            $date = $this->input->get('date');
        }

        $user_id = sessionId('freelancer_id');

        $this->db->where("user_id", $user_id);

        if($scheduleType == 0){
            $this->db->where("DATE(finaldatetime)", $date);
        }

        $this->db->where("schedule_type", $scheduleType); 
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("tbl_calendar_image");
        $data = $query->result();

        echo json_encode([
            'status' => 'success',
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }

    // GET DOCS DATA 
    public function getDocsdata()
    {
        $scheduleType = $this->input->get('scheduleType');

        if($scheduleType == 0){
            $date = $this->input->get('date');
        }

        $user_id = sessionId('freelancer_id');

        $this->db->where("user_id", $user_id);

        if($scheduleType == 0){
            $this->db->where("DATE(finaldatetime)", $date);
        }

        $this->db->where("schedule_type", $scheduleType); 
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("tbl_calendar_docs");;
        $data = $query->result();

        echo json_encode([
            'status' => 'success',
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }


    // GET DOCS DATA 
    public function getVideodata()
    {
        $scheduleType = $this->input->get('scheduleType');
        
        if($scheduleType == 0){
            $date = $this->input->get('date');
        }

        $user_id = sessionId('freelancer_id');

        $this->db->where("user_id", $user_id);
        $this->db->where("DATE(finaldatetime)", $date);
        $this->db->where("schedule_type", $scheduleType);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("tbl_calendar_video");
        $data = $query->result();

        echo json_encode([
            'status' => 'success',
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }

    // GET DOCS DATA 
    public function getAudiodata()
    {
        $scheduleType = $this->input->get('scheduleType');

        if($scheduleType == 0){
            $date = $this->input->get('date');
        }

        $user_id = sessionId('freelancer_id');

        $data = $this->db->where("user_id", $user_id);
            $this->db->where("DATE(finaldatetime)", $date) ; // <-- FIX
            $this->db->where("schedule_type", $scheduleType); 
            $this->db->order_by("id", "DESC");
            $query = $this->db->get("tbl_calendar_audio");
            $data = $query->result();

        echo json_encode([
            'status' => 'success',
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }

    // GET OTHER LINKS - DATA 
    public function getOtherLinksdata()
    {
        $scheduleType = $this->input->get('scheduleType');

        if($scheduleType == 0){
            $date = $this->input->get('date');
        }

        $user_id = sessionId('freelancer_id');

        $this->db->where("user_id", $user_id);
        $this->db->where("DATE(finaldatetime)", $date);   // <-- FIX
        $this->db->where("schedule_type", $scheduleType); 
        $this->db->order_by("id", "DESC");
        $query = $this->db->get("tbl_calendar_otherlink");
        $data = $query->result();

        echo json_encode([
            'status' => 'success',
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }


    public function deleteTask()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $id   = $this->input->post('id');
        $type = $this->input->post('type');

        if (empty($id) || empty($type)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request'
            ]);
            return;
        }

        // Map task type → table
        $tableMap = [
            'text'  => 'calendar_textbox',
            'image' => 'calendar_image',
            'video' => 'calendar_video',
            'audio' => 'calendar_audio',
            'docs'  => 'calendar_docs',
            'other' => 'calendar_other',
            'user'  => 'calendar_user',
            'dialogue' => 'calendar_dialogue',
            'country' => 'calendar_country',
            'probability' => 'calendar_probability',
            'religion' => 'calendar_religion',
            'emotion' => 'calendar_emotion',
            'level' => 'calendar_level',
            'currency' => 'calendar_currency',
            'travel' => 'calendar_travel',
            'deal' => 'calendar_deal',
            'age' => 'calendar_age',
            'body_part' => 'calendar_body_part',
            'ethnicity' => 'calendar_ethnicity',
            'character' => 'calendar_character'
        ];

        if (!isset($tableMap[$type])) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid task type'
            ]);
            return;
        }

        $this->db->where('id', $id);
        $this->db->where('user_id', sessionId('freelancer_id'));
        $this->db->delete($tableMap[$type]);

        if ($this->db->affected_rows() === 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Task not found or already deleted'
            ]);
            return;
        }

        echo json_encode([
            'success' => true,
            'message' => 'Task deleted successfully'
        ]);
    }


    public function getTimeline()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $params = [
            'user_id'       => $user_id,
            'date'          => $this->input->post('date'),
            'opening_time'  => $this->input->post('openingTime'),
            'closing_time'  => $this->input->post('closingTime'),
            'schedule_type' => (int) $this->input->post('scheduleType')
        ];

        $data = $this->Calender_model->getTimelineWithItems($params);

        echo json_encode([
            'success' => true,
            'data'    => $data
        ]);
    }

    // private function handleTimeline($user_id)
    // {
    //     $openingTime   = $this->input->post('openingTime');
    //     $closingTime   = $this->input->post('closingTime');
    //     $finaldatetime = $this->input->post('finaldatetime');
    //     $scheduleType  = (int) $this->input->post('scheduleType');
    //     $timeline      = json_decode($this->input->post('timeline'), true);
    //     $date          = date('Y-m-d', strtotime($this->input->post('date')));

    //     if ($scheduleType === 0) {
    //         $openingtime_db   = $openingTime ?: null;
    //         $closingtime_db   = $closingTime ?: null;
    //         $finaldatetime_db = $finaldatetime ?: null;
    //     } else {
    //         $openingtime_db   = null;
    //         $closingtime_db   = null;
    //         $finaldatetime_db = null;
    //     }

    //     $timelineId = $this->Calender_model->getOrCreateTimeline([
    //         'user_id'       => $user_id,
    //         'date'          => $date,
    //         'opening_time'  => $openingtime_db,
    //         'closing_time'  => $closingtime_db,
    //         'schedule_type' => $scheduleType,
    //         'finaldatetime' => $finaldatetime_db
    //     ]);

    //     if (empty($timelineId)) {
    //         return false;
    //     }

    //     if (!empty($timeline)) {
    //         $this->db->where('timeline_id', $timelineId)
    //                 ->delete('tbl_calendar_timeline_items');

    //         foreach ($timeline as $item) {
    //             $this->db->insert('tbl_calendar_timeline_items', [
    //                 'timeline_id'  => $timelineId,
    //                 'user_id'      => $user_id,
    //                 'content_type' => $item['type'],
    //                 'position'     => (int) $item['position'],
    //                 'content_id'   => null
    //             ]);
    //         }
    //     }

    //     return [
    //         'timeline_id'      => $timelineId,
    //         'schedule_type'    => $scheduleType,
    //         'openingtime_db'   => $openingtime_db,
    //         'closingtime_db'   => $closingtime_db,
    //         'finaldatetime_db' => $finaldatetime_db
    //     ];
    // }
    private function handleTimeline($user_id)
    {
        $openingTime   = $this->input->post('openingTime');
        $closingTime   = $this->input->post('closingTime');
        $finaldatetime = $this->input->post('finaldatetime');
        $timeline_type = $this->input->post('timeline_type');
        $scheduleType  = (int) $this->input->post('scheduleType');
        $timeline      = json_decode($this->input->post('timeline'), true);
        $date          = date('Y-m-d', strtotime($this->input->post('date')));
        $timelineId   = $this->input->post('timeline_id');

        if ($scheduleType === 0) {
            $openingtime_db   = $openingTime ?: null;
            $closingtime_db   = $closingTime ?: null;
            $finaldatetime_db = $finaldatetime ?: null;
        } else {
            $openingtime_db   = null;
            $closingtime_db   = null;
            $finaldatetime_db = null;
        }

        if ($scheduleType === 0) {
            $timelineId = $this->Calender_model->getOrCreateTimeline([
                'user_id'       => $user_id,
                'date'          => $date,
                'opening_time'  => $openingtime_db,
                'closing_time'  => $closingtime_db,
                'schedule_type' => $scheduleType,
                'finaldatetime' => $finaldatetime_db,
                'timeline_type' => $timeline_type,
            ]);
        }

        if (empty($timelineId)) {
            return false;
        }

        $insert_id = null;

        if (!empty($timeline)) {

            $existingMap = $this->Calender_model->getTimelineItemsMap($timelineId, $user_id);

            foreach ($timeline as $item) {

                $type      = $item['type'];
                $contentId = $item['old_id'] ?? null;

                // 🔥 stable key (no position)
                $key = $type . '_' . ($contentId ?? 'new_' . ($item['temp_key'] ?? uniqid()));

                if (!isset($existingMap[$key])) {

                    $insert_id = $this->Calender_model->insertTimelineItemIfNotExists(
                        $timelineId,
                        $user_id,
                        $type,
                        $contentId
                    );
                }
            }
        }

        return [
            'timeline_id'       => $timelineId,
            'schedule_type'     => $scheduleType,
            'openingtime_db'    => $openingtime_db,
            'closingtime_db'    => $closingtime_db,
            'finaldatetime_db'  => $finaldatetime_db,
            'new_timeline_item' => $insert_id,
        ];
    }

    public function getItem()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $type = $data['type'] ?? null;
        $id   = $data['id'] ?? null; // this is timeline_item_id for user
        $timeline_item_id = $data['timeline_item_id'];

        if (!$type || !$id) {   
            echo json_encode(['success' => false]);
            return;
        }

        /* =======================
        USER TYPE (SPECIAL CASE)
        ======================= */
        if ($type === 'user') {

            $mode = $data['user_mode'] ?? 'sender';

            // 🔥 Editing RECEIVER users (dialogue)
            if ($mode === 'receiver') {

                $dialogue = $this->CommonModal->getRowWhere('tbl_calendar_dialogue', [
                    'timeline_item_id' => $timeline_item_id
                ]);
                // dd($dialogue);
                $receiver_ids = explode(',', $dialogue['to_user_id']);

                $this->db->where_in('id', $receiver_ids);
                $users = $this->db->get('freelancer')->result_array();

                echo json_encode([
                    'success' => true,
                    'data' => [
                        'id' => $dialogue['id'],
                        'users' => $users,
                        'mode' => 'receiver'
                    ]
                ]);
                return;
            }

            // 🔥 Editing SENDER users (normal timeline user block)
            $user_timeline_item = $this->CommonModal->getRowWhere('tbl_calendar_user', [
                'id' => $id
            ]);

            $user_ids_arr = explode(',', $user_timeline_item['timeline_user_id']);

            $this->db->where_in('id', $user_ids_arr);
            $users = $this->db->get('freelancer')->result_array();

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $user_timeline_item['id'],
                    'users' => $users,
                    'mode' => 'sender'
                ]
            ]);
            return;
        }


        if ($type === 'brick') {

            $brick_timeline_item = $this->CommonModal->getRowWhere('tbl_calendar_brick', [
                'id' => $id
            ]);

            $brick_ids_arr = explode(',', $brick_timeline_item['timeline_brick_id']);

            $this->db->where_in('id', $brick_ids_arr);
            $query = $this->db->get('bricks');
            
            $bricks = $query->result_array();

            $data['getBricks'] = $bricks; 

            $html = $this->load->view('search_results',$data, true);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $brick_timeline_item['id'],
                    'brick_ids' => $brick_ids_arr,
                ],
                'html' => $html
            ]);
            return;
        }

        if ($type === 'press_release') {

            $press_release_timeline_item = $this->CommonModal->getRowWhere('tbl_calendar_press_release', [
                'id' => $id
            ]);

            $press_release_keys = $press_release_timeline_item['timeline_press_release_ids'] ?? '';

            $key_arr = !empty($press_release_keys) ? explode(',', $press_release_keys) : [];

            $press_releases = [];

            foreach ($key_arr as $val) {

                $val = trim($val);
                $parts = explode('_', $val, 2);
                if (count($parts) !== 2) continue;

                $pr_id   = $parts[0];
                $pr_type = $parts[1];

                $pr_table_map = [
                    'company' => 'company_press_release',
                    'user'    => 'user_press_release',
                    'project' => 'project_press_release'
                ];

                if (!isset($pr_table_map[$pr_type])) continue;

                // Base PR row as object
                $pr = $this->db
                    ->where('id', $pr_id)
                    ->get($pr_table_map[$pr_type])
                    ->row();

                if (!$pr) continue;

                // Attach type
                $pr->type = $pr_type;

                // Attach user
                $user = $this->db
                    ->where('id', $pr->user_id)
                    ->get('freelancer')
                    ->row();

                if ($user) {
                    $pr->name       = $user->name ?? null;
                    $pr->email      = $user->email ?? null;
                    $pr->user_image = $user->user_image ?? null;
                } else {
                    $pr->name = $pr->email = $pr->user_image = null;
                }

                // Attach company / project names
                if ($pr_type === 'company') {

                    $company = $this->db
                        ->where('id', $pr->company_id)
                        ->get('companies')
                        ->row();

                    $pr->company_name = $company->company_name ?? null;
                    $pr->project_name = null;

                } elseif ($pr_type === 'project') {

                    $company = $this->db
                        ->where('id', $pr->company_id)
                        ->get('companies')
                        ->row();

                    $project = $this->db
                        ->where('id', $pr->project_id)
                        ->get('projects')
                        ->row();

                    $pr->company_name = $company->company_name ?? null;
                    $pr->project_name = $project->project_name ?? null;

                } else {
                    $pr->company_name = null;
                    $pr->project_name = null;
                }

                $press_releases[] = $pr;
            }

            // 👇 Load SAME view you already use
            $data['press_releases'] = $press_releases;
            $html = $this->load->view('press_release_select_results', $data, true);

            echo json_encode([
                'success' => true,
                'html' => $html,
                'data' => [
                    'id' => $press_release_timeline_item['id'],
                ],
            ]);

            return;
        }



        /* =======================
        ALL OTHER TYPES
        ======================= */
        $tables = [
            'text'    => 'tbl_calendar_textbox',
            'image'   => 'tbl_calendar_image',
            'video'   => 'tbl_calendar_video',
            'audio'   => 'tbl_calendar_audio',
            'docs'    => 'tbl_calendar_docs',
            'contact' => 'tbl_calendar_contact',
            'other'   => 'tbl_calendar_otherlink',
            'country' => 'tbl_calendar_country',
            'probability' => 'tbl_calendar_probability',
            'religion' => 'tbl_calendar_religion',
            'emotion' => 'tbl_calendar_emotion',
            'level' => 'tbl_calendar_level',
            'currency' => 'tbl_calendar_currency',
            'travel' => 'tbl_calendar_travel',
            'deal' => 'tbl_calendar_deal',
            'age' => 'tbl_calendar_age',
            'body_part' => 'tbl_calendar_body_part',
            'ethnicity' => 'tbl_calendar_ethnicity',
            'character' => 'calendar_character'
        ];

        if (!isset($tables[$type])) {
            echo json_encode(['success' => false]);
            return;
        }

        $row = $this->db
            ->where('id', $id)
            ->get($tables[$type])
            ->row_array();

        echo json_encode([
            'success' => true,
            'data'    => $row
        ]);
    }

    // public function deleteItem()
    // {

    //     $raw_input = file_get_contents('php://input');
    //     $data = json_decode($raw_input, true);
    //     $type = $data['type'];
    //     $id   = $data['id'];

    //     $tables = [
    //         'text'    => 'tbl_calendar_textbox',
    //         'image'   => 'tbl_calendar_image',
    //         'video'   => 'tbl_calendar_video',
    //         'audio'   => 'tbl_calendar_audio',
    //         'docs'    => 'tbl_calendar_docs',
    //         'contact' => 'tbl_calendar_contact',
    //         'other'   => 'tbl_calendar_otherlink',
    //     ];

    //     if (!isset($tables[$type])) {
    //         echo json_encode(['success' => false]);
    //         return;
    //     }

    //     $this->db->where('id', $id)->delete($tables[$type]);

    //     echo json_encode(['success' => true]);
    // }
    public function deleteItem()
    {
        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        $type = $data['type'] ?? null;
        $id   = $data['id']   ?? null;

        if (!$type || !$id) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }

        $tables = [
            'text'    => 'tbl_calendar_textbox',
            'image'   => 'tbl_calendar_image',
            'video'   => 'tbl_calendar_video',
            'audio'   => 'tbl_calendar_audio',
            'docs'    => 'tbl_calendar_docs',
            'contact' => 'tbl_calendar_contact',
            'other'   => 'tbl_calendar_otherlink',
            'user'    => 'tbl_calendar_user',
            'dialogue' => 'tbl_calendar_dialogue',
            'press_release' => 'tbl_calendar_press_release',
            'country' => 'tbl_calendar_country',
            'religion' => 'tbl_calendar_religion',
            'language' => 'tbl_calendar_language',
            'emotion' => 'tbl_calendar_emotion',
            'character' => 'tbl_calendar_character'
        ];

        if (!isset($tables[$type])) {
            echo json_encode(['success' => false, 'message' => 'Invalid type']);
            return;
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $res = [];

        $this->db->trans_start();

        $content_row = $this->CommonModal->getRowWhere($tables[$type],[
            'id' => $id
        ]);

        if(!empty($content_row[$type])){

            $file_path = FCPATH . 'uploads/calendar_' . $type . '/' . basename($content_row[$type]);

            if(file_exists($file_path)){
                unlink($file_path);
                    $res['file_status'] = 'file deleted';
            }else {
                    $res['file_status'] = 'file not exist';
            }
        }

        if ($type === 'video' || $type === 'image' || $type === 'audio') {

            // Find timeline item linked with this content
            $timeline_item = $this->db->where([
                    'content_type' => $type,
                    'content_id'   => $id,
                    'user_id'      => $user_id
                ])
                ->get('tbl_calendar_timeline_items')
                ->row();

            if ($timeline_item) {

                // Find all contents linked to same timeline item
                $all_linked_items = $this->db->where([
                        'timeline_item_id' => $timeline_item->id,
                        'user_id'          => $user_id
                    ])
                    ->get($tables[$type])
                    ->result_array();

                $linkedCount = count($all_linked_items);

                if ($linkedCount > 1) {
                    // 🔁 Relink timeline to another content
                    foreach ($all_linked_items as $item) {
                        if ($item['id'] != $id) {
                            $this->db->where([
                                    'id' => $timeline_item->id,
                                    'user_id' => $user_id
                                ])
                                ->update('tbl_calendar_timeline_items', [
                                    'content_id' => $item['id']
                                ]);
                            break;
                        }
                    }

                    // 🗑 Delete only content
                    $this->db->where([
                            'id'      => $id,
                            'user_id' => $user_id
                        ])
                        ->delete($tables[$type]);

                } else {
                    // 🧹 Last linked item → delete timeline item + content
                    $this->db->where([
                            'id'      => $timeline_item->id,
                            'user_id' => $user_id
                        ])
                        ->delete('tbl_calendar_timeline_items');

                    $this->db->where([
                            'id'      => $id,
                            'user_id' => $user_id
                        ])
                        ->delete($tables[$type]);
                }

            } else {
                // ❌ Not linked to timeline → delete content only
                $this->db->where([
                        'id'      => $id,
                        'user_id' => $user_id
                    ])
                    ->delete($tables[$type]);
            }
        } else {
            // For non-image/video types: remove any timeline links and delete the content row
            $this->db->where([
                    'content_type' => $type,
                    'content_id'   => $id,
                    'user_id'      => $user_id
                ])
                ->delete('tbl_calendar_timeline_items');

            $this->db->where([
                    'id'      => $id,
                    'user_id' => $user_id
                ])
                ->delete($tables[$type]);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $res  += ['success' => false, 'message' => 'Delete failed'];
            echo json_encode($res);
            return;
        }
        
        $res += ['success' => true];
        echo json_encode($res);
    }

    // END FUNCTIONALITY  

    public function getContentFileName(){
        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);
        $content_id = $data['content_id'];
        $type = $data['type'];

        $tables = [
            'text'    => 'tbl_calendar_textbox',
            'image'   => 'tbl_calendar_image',
            'video'   => 'tbl_calendar_video',
            'audio'   => 'tbl_calendar_audio',
            'docs'    => 'tbl_calendar_docs',
            'contact' => 'tbl_calendar_contact',
            'other'   => 'tbl_calendar_otherlink',
            'user'    => 'tbl_calendar_user'
        ];

        $content_data = $this->CommonModal->getRowWhere($tables[$type], [
            'id' => $content_id
        ]);

        echo json_encode($content_data);
    }

    public function saveTimelineOrder()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode(['success' => false]);
            return;
        }

        $timeline = json_decode($this->input->post('timeline'), true);

        foreach ($timeline as $item) {
            $this->db->where('content_type', $item['type']);
            $this->db->where('content_id', $item['old_id']);
            $this->db->update('calendar_timeline_items', [
                'position' => $item['position']
            ]);
        }

        echo json_encode(['success' => true]);
    }

    public function requestDialogue()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $id = $this->input->post('id');

        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'Dialogue ID missing']);
            return;
        }

        $this->db->where('id', $id)->where('dialogue_status', 0);
            if ($this->db->count_all_results('tbl_calendar_dialogue') > 0) {
                echo json_encode(['success' => false, 'message' => 'Already requested']);
                return;
        }


        $this->db->where('id', $id)->update('tbl_calendar_dialogue', [
            'dialogue_status' => 0 // 🔥 pending
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Dialogue request sent',
            'status'  => 'pending'
        ]);
    }


    public function updateDialogueStatus()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $id     = $this->input->post('id');
        $status = $this->input->post('status');

        if (!$id || !in_array($status, [1, 2])) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }

        $this->db->where('id', $id)->update('tbl_calendar_dialogue', [
            'dialogue_status' => $status
        ]);

        echo json_encode(['success' => true]);
    }

    public function print_event() {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $timeline_id = $this->input->get('id');

        // echo "<pre>";
        // print_r($timeline_ids); die;
        $content_type_map = [
            'text'  => 'calendar_textbox',
            'other' => 'calendar_otherlink',
            'docs'  => 'calendar_docs',
            'image' => 'calendar_image',
            'audio' => 'calendar_audio',
            'video' => 'calendar_video',
            'user'  => 'calendar_user',
            'contact' => 'calendar_contact',
            'brick' => 'calendar_brick',
            'dialogue' => 'calendar_dialogue',
            'press_release' => 'calendar_press_release',
            'country' => 'tbl_calendar_country',
            'probability' => 'tbl_calendar_probability',
            'religion' => 'tbl_calendar_religion',
            'emotion' => 'tbl_calendar_emotion',
            'level' => 'tbl_calendar_level',
            'currency' => 'tbl_calendar_currency',
            'travel' => 'tbl_calendar_travel',
            'deal' => 'tbl_calendar_deal',
            'age' => 'tbl_calendar_age',
            'body_part' => 'tbl_calendar_body_part',
            'ethnicity' => 'tbl_calendar_ethnicity',
            'character' => 'calendar_character'
        ];
        

        // 1️⃣ Get timeline master
        $timeline_details = $this->CommonModal->getRowWhere('calendar_timeline_master', [
            'user_id' => sessionId('freelancer_id'),
            'id'      => $timeline_id
        ]);

        // 2️⃣ Get timeline items (ordered)
        $timeline_items_raw = $this->CommonModal->getRowsWhere(
            'calendar_timeline_items',
            [
                'user_id'     => sessionId('freelancer_id'),
                'timeline_id' => $timeline_id
            ],
            'position ASC'
        );

        $timeline_items_final = []; // ✅ final structured items

        if (!empty($timeline_items_raw)) {
            foreach ($timeline_items_raw as $item) {

                if (empty($item['content_id'])) continue;

                $table = $content_type_map[$item['content_type']] ?? null;
                if (!$table) continue;

                $content = $this->CommonModal->getRowWhere($table, [
                    'id' => $item['content_id']
                ]);

                if (!$content) continue;

                // 🔹 Handle user type specially
                if ($item['content_type'] === 'user' && !empty($content['timeline_user_id'])) {

                    $users = [];
                    $user_id_arr = explode(',', $content['timeline_user_id']);

                    foreach ($user_id_arr as $user_id) {
                        $user = $this->CommonModal->getRowWhere('freelancer', [
                            'id' => trim($user_id)
                        ]);
                        if ($user) $users[] = $user;
                    }

                    $content['users'] = $users;
                }

                $bricks = [];
                if($item['content_type'] == 'brick'){
                    $brick_id_arr = explode(',', $content['timeline_brick_id']);
                    
                    foreach($brick_id_arr as $brick_id){
                        $bricks[] = $this->CommonModal->getRowWhere('bricks', [
                            'id' => $brick_id
                        ]);
                    }
                }

                if(!empty($bricks)){
                    $content['bricks'] = $bricks;
                }

                $press_releases = [];
                if ($item['content_type'] == 'press_release') {

                    $press_release_keys = $content['timeline_press_release_ids'] ?? '';

                    if (!empty($press_release_keys)) {
                        $key_arr = explode(',', $press_release_keys);
                    } else {
                        $key_arr = [];
                    }

                    $press_release_map = [];

                    foreach ($key_arr as $val) {

                        // Trim spaces just in case: "8_company, 7_company"
                        $val = trim($val);

                        // Safely split only into 2 parts
                        $parts = explode('_', $val, 2);

                        if (count($parts) !== 2) continue; // skip invalid values

                        $id   = $parts[0];
                        $type = $parts[1];

                        if (empty($id) || empty($type)) continue;

                        $press_release_map[] = [
                            'id'   => $id,
                            'type' => $type
                        ];
                    }

                    foreach ($press_release_map as $map) {

                        $pr_table_map = [
                            'company' => 'company_press_release',
                            'user'    => 'user_press_release',     // ✅ FIXED TABLE NAME
                            'project' => 'project_press_release'   // ✅ FIXED TABLE NAME
                        ];

                        // 🚨 Prevent "Undefined index" error
                        if (!isset($pr_table_map[$map['type']])) continue;

                        $pr = $this->CommonModal->getRowWhere(
                            $pr_table_map[$map['type']],
                            ['id' => $map['id']]
                        );

                        $pr['type'] = $map['type'];
                        $pr['user'] = $this->CommonModal->getRowWhere('freelancer', ['id' => $pr['user_id']]);

                        if($pr['type'] == 'company'){
                            $pr['company'] = $this->CommonModal->getRowWhere('companies', ['id' => $pr['company_id']]);
                        }elseif($pr['type'] == 'project'){
                            $pr['company'] = $this->CommonModal->getRowWhere('companies', ['id' => $pr['company_id']]);
                            $pr['project'] = $this->CommonModal->getRowWhere('projects', ['id' => $pr['project_id']]);

                        }

                        if (!empty($pr)) {
                            $press_releases[] = $pr;
                        }
                    }
                }
                
                if (!empty($press_releases)) {
                    $content['press_releases'] = $press_releases;
                }

                // 🔥 Attach meta info
                $content['content_type'] = $item['content_type'];
                $content['position']     = $item['position'];

                $timeline_items_final[] = $content; // ✅ append to FINAL array only
            }
        }
        $data['timeline_owner'] = $this->CommonModal->getRowWhere('freelancer', [
            'id' => $timeline_details['user_id']
        ]);
        
        $timeline_details['timeline_items'] = $timeline_items_final;

        $data['event'] = $timeline_details;
        // dd($data);
        // Load library
        // $this->load->library('dompdf_gen');
        
        $html = $this->load->view('event_pdf', $data, true);
        echo $html; die;
    }

    public function createTimeline(){

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        if(empty($user_id)){
            redirect('');
        }

        $date = $this->input->post('date');
        $openingtime = $this->input->post('openingtime');
        $closingtime = $this->input->post('closingtime');
        $timeline_type = $this->input->post('timeline_type');
        $finaldatetime = $this->input->post('finaldatetime');
        $company_id = $this->input->post('company_id');
        $project_id = $this->input->post('project_id');
        $schedule_type = $this->input->post('schedule_type');
        

        $timeline_data = [
            'user_id' => $user_id,
            'opening_time' => $openingtime,
            'closing_time'  => $closingtime,
            'timeline_type' => $timeline_type,
            'finaldatetime'=> $finaldatetime,
            'schedule_type' => $schedule_type
        ];

        if(!empty($date)){
            $timeline_data['date'] = $date;
        }
        if(!empty($openingtime)){
            $timeline_data['opening_time'] = $openingtime;
        }
        if(!empty($openingtime)){
            $timeline_data['closingtime'] = $closingtime;
        }

        $redirect_url = '';

        if($company_id){
            $timeline_data['company_id'] = $company_id;
        }elseif($project_id){
            $timeline_data['project_id'] = $project_id;
        }
        // dd($timeline_data);
        $timelineId = $this->Calender_model->getOrCreateTimeline($timeline_data);
        
        if($company_id){
            $redirect_url = base_url('calendar/data-feeding-panel-future') . "?id=$timelineId&company_id=$company_id";
        }elseif($project_id){
            $redirect_url = base_url('calendar/data-feeding-panel-future') . "?id=$timelineId&project_id=$project_id";
        }else{
            $redirect_url = base_url('calendar/data-feeding-panel-future') . "?id=$timelineId";
        }

        if ($timelineId) {
            echo json_encode([
                'success' => true,
                'timelineId' => $timelineId,
                'redirect' => $redirect_url
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create timeline'
            ]);
        }

    }

    public function deleteTimelineEvent()
    {
        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');
        $timeline_id = $this->input->post('timeline_id');

        if (!$user_id || !$timeline_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }

        // Fetch items first (to know what to delete)
        $items = $this->CommonModal->getRowsWhere('calendar_timeline_items', [
            'user_id'     => $user_id,
            'timeline_id' => $timeline_id
        ]);

        $content_type_map = [
            'text'  => 'calendar_textbox',
            'other' => 'calendar_otherlink',
            'docs'  => 'calendar_docs',
            'image' => 'calendar_image',
            'audio' => 'calendar_audio',
            'video' => 'calendar_video',
            'user'  => 'calendar_user',
            'contact' => 'calendar_contact',
            'brick' => 'calendar_brick',
            'dialogue' => 'calendar_dialogue',
            'press_release' => 'calendar_press_release'
        ];

        $this->db->trans_begin();

        try {
            foreach ($items as $item) {

                // 🔥 delete finance if exists
                $this->db->delete('calendar_finance', [
                    'timeline_item_id' => $item['id']
                ]);

                // 🔥 delete dialogue if exists
                $this->db->delete('tbl_calendar_dialogue', [
                    'timeline_item_id' => $item['id']
                ]);

                // 🔥 delete content row
                $table = $content_type_map[$item['content_type']] ?? null;
                if ($table && !empty($item['content_id'])) {
                    $this->db->delete($table, ['id' => $item['content_id']]);
                }
            }

            // 🔥 delete timeline items
            $this->db->delete('calendar_timeline_items', [
                'user_id'     => $user_id,
                'timeline_id' => $timeline_id
            ]);

            // 🔥 delete timeline master
            $this->db->delete('calendar_timeline_master', [
                'user_id' => $user_id,
                'id'      => $timeline_id
            ]);

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('DB error');
            }

            $this->db->trans_commit();

            echo json_encode(['success' => true]);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['success' => false, 'message' => 'Delete failed']);
        }
    }
    
    public function saveCalendarPermissions()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $user_id = sessionId('freelancer_id');

        if (!$data) {
            echo json_encode(['status' => false]);
            return;
        }

        foreach ($data as $row) {

            $insert = [
                'user_id' => $user_id,
                'permission_scope' => $row['scope'],
                'permission_type' => $row['permission_type'],
                'is_public' => $row['is_public']
            ];

            if ($row['scope'] == 'day') {
                $insert['reference_date'] = $row['date'];
            }

            if ($row['scope'] == 'month') {
                $insert['reference_month'] = $row['month'];
            }

            if ($row['scope'] == 'year') {
                $insert['reference_year'] = $row['year'];
            }

            $this->db->insert('tbl_calendar_permissions', $insert);
        }

        echo json_encode(['status' => true]);
    }

    public function getPermissions()
    {
        $user_id = sessionId('freelancer_id');

        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        $permissions = $this->db->get('tbl_calendar_permissions')->result_array();

        echo json_encode($permissions);
    }

    public function bulk_download(){
        $type = $this->input->get("timeline_type");
        $timeline_item_id = $this->input->get("timeline_item_id");
        $items = $this->CommonModal->getRowByConditions("calendar_$type", [
            'timeline_item_id' => $timeline_item_id,
        ]);

        $this->load->library('zip');

        foreach($items as $item){
            if (!empty($item[$type])) {

                $filePath = FCPATH . "uploads/calendar_$type/" . $item[$type];

                if (file_exists($filePath)) {
                    $this->zip->read_file($filePath);
                }

            } elseif (!empty($item[$type . "link"])) {

                $imageData = file_get_contents($item[$type . "link"]);
                $filename = basename($item[$type . "link"]);

                $this->zip->add_data($filename, $imageData);

            }
        }

        $this->zip->download("calendar_$type.zip");

        // dd($all_item);
        // dd($timeline_type);
        // dd($timeline_item_id);
    }
}

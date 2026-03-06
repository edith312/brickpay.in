<?php

defined('BASEPATH') or exit('No direct script access allowed');

// Shiv Web Developer

class AdminHome extends CI_Controller
{

    private $user_id;
    public function __construct()
    {
        parent::__construct();
        if (sessionId('admin_id') == "") {
            redirect("admin");
        }
        $this->user_id = sessionId('user_id');
    }

    public function dashboard()
    {
        $data['title'] = "Home";
        $data['totalProjectCreators'] = $this->CommonModal->getNumRow("companies");
        $data['totalConsultants'] = $this->CommonModal->getNumRow("freelancer");
        $data['totalProjects'] = $this->CommonModal->getNumRow("projects");
        $data['totalBricks'] = $this->CommonModal->getNumRow("bricks");
        $data['totalPrivateBricks'] = $this->CommonModal->getNumRows("bricks", ['brick_privacy' => 'private']);
        $data['totalPublicBricks'] = $this->CommonModal->getNumRows("bricks", ['brick_privacy' => 'public']);
        $data['totalPaidUsers'] = $this->CommonModal->getNumRows("freelancer", ['transaction_status' => '1']);
        $data['totalUnaidUsers'] = $this->CommonModal->getNumRows("freelancer", ['transaction_status' => '0']);

        $this->load->view('admin/template/header-link', $data);
        $this->load->view('admin/index');
    }

    public function projectCreators()
    {
        $data['title'] = "Project Creators";
        $data['projectCreators'] = $this->CommonModal->getAllRowsInOrder("companies", "id", "desc");
        $this->load->view('admin/template/header-link', $data);
        $this->load->view('admin/project-creators', $data);
    }

    public function projectConsultant()
    {
        $data['title'] = "Project Creators";
        $data['projectConsultants'] = $this->CommonModal->getAllRowsInOrder("tbl_freelancer", "id", "desc");
        $this->load->view('admin/template/header-link', $data);
        $this->load->view('admin/project-consultants', $data);
    }

    public function deleteCompany()
    {
        $getID = $this->input->get('id');
        $this->CommonModal->deleteRowById('tbl_companies', ['id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_projects', ['company_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_company_banks', ['company_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_company_directory', ['company_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_bricks', ['company_id' => $getID]);

        $this->session->set_userdata('deleteMsg', '<div class="alert alert-success">Company Deleted Successfully.</div>');
        redirect(base_url('admin/project-creators'));
    }

    // USER KYC 
    public function userKyc()
    {

        $data['title'] = "User KYC";
        $data['userKyc'] = $this->CommonModal->getAllRowsInOrder("tbl_userkyc", "id", "desc");
        $this->load->view('admin/template/header-link', $data);
        $this->load->view('admin/userKyc', $data);
    }


    public function deleteUserKyc()
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $userKycId = $this->input->get('id');
        $deletedUserKyc = $this->CommonModal->deleteRowById('tbl_userkyc', ['id' => $userKycId]);
        if ($deletedUserKyc) {
            $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">User KYC Deleted successfully.</div>');
        } else {
            $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function user_kycStatusUpdate()
    {

        extract($this->input->post());

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            redirect('admin/dashboard');
        } else {
            $status = $this->input->post('status');
            $id = $this->input->post('id');

            $updated = $this->CommonModal->updateRowById('tbl_userkyc', 'id', $id, ['status' => $status]);

            if ($updated) {
                echo json_encode(['bricksFundstatus' => 'success', 'message' => 'Status Updated successfully']);
            } else {
                echo json_encode(['bricksFundstatus' => 'error', 'message' => 'Failed to Update Status!']);
            }
            redirect('admin/user-kyc');
        }
    }

    public function deleteFreelancerUser()
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $freelancerId = $this->input->get('id');
        $deletedFreelancer = $this->CommonModal->deleteRowById('tbl_freelancer', ['id' => $freelancerId]);
        if ($deletedFreelancer) {
            $this->session->set_userdata('projectConsultation', '<div class="alert alert-success">User Deleted successfully.</div>');
        } else {
            $this->session->set_userdata('projectConsultation', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function police_court()
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'police_court';
        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/police_court');
        $this->load->view('admin/template/footer-link');
        
    }

    public function map()
    {

        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Map';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/map/map');
        $this->load->view('admin/template/footer-link');

    }

    public function school($stream = null, $subject = null)
    {

        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'School';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');

        if ($stream && $subject == null) {
            $this->load->view('admin/map/school/' . $stream);
        } elseif ($stream && $subject) {
            if ($subject == 'chemistry') {
                $data['elements'] = $this->CommonModal->getAllRows('elements');
                // echo "<pre>";
                // print_r($data['elements']);
                // var_dump($data['elements']);
                // die;
            }
            $this->load->view('admin/map/' . $stream . '/' . $subject, $data);
        } else {
            $this->load->view('admin/map/school', $data);
        }
        $this->load->view('admin/template/footer-link');
    }

    public function element($id = null)
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'School';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');

        $data['element'] = $this->CommonModal->getRowById('elements', 'id', $id);
        // print_r($data['element']);
        // die;
        $this->load->view('admin/map/science/element', $data);
        $this->load->view('admin/template/footer-link');
    }

    public function element_edit($id = null) {
        if($id) {
            $edit_data = [
                'strength' => $this->input->post('strength'),
                'weakness' => $this->input->post('weakness'),
                'opportunity' => $this->input->post('opportunity'),
                'threat' => $this->input->post('threat'),
                'mining' => $this->input->post('mining'),
                'extraction' => $this->input->post('extraction'),
                'sythenization' => $this->input->post('sythenization'),
                'processing' => $this->input->post('processing'),
                'education' => $this->input->post('education'),
                'industry' => $this->input->post('industry'),
            ];

            $this->CommonModal->updateRowById('elements', 'id', $id, $edit_data);
            $this->session->set_flashdata('success', 'Element Details Updated');
            redirect($this->agent->referrer());
        }else{
            $this->session->set_flashdata('error', 'Element ID Not Found');
            redirect($this->agent->referrer());
        }
    }

    public function degree($type = null)
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'School';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        if ($type) {
            $this->load->view('admin/map/degree/' . $type);
        }
        $this->load->view('admin/template/footer-link');
    }

    public function department()
    {

        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Department';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/map/industries/department');
        $this->load->view('admin/template/footer-link');
    }

    public function market_research()
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Department';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/map/market_research');
        $this->load->view('admin/template/footer-link');
    }

    public function reverse_process()
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Reverse Process';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/map/reverse_process');
        $this->load->view('admin/template/footer-link');
    }

    public function total_projects(): void
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Project Profile';
        $projects = $this->CommonModal->getAllRows('projects');

        foreach($projects as &$project){
            if($project['company_id']){
                $project['company_details'] = $this->CommonModal->getRowById('companies', 'id', $project['company_id']);
            }
        }
        unset($project);
        
        $data['projects'] = $projects;

        $scaleCounts = [];

        foreach ($projects as $project) {
            // Treat empty / null as NA
            $scale = $project['physical_scale'];

            if ($scale === '' || $scale === null) {
                $scale = 'NA';
            }

            if (!isset($scaleCounts[$scale])) {
                $scaleCounts[$scale] = 0;
            }

            $scaleCounts[$scale]++;
        }

        $data['scaleCounts'] = $scaleCounts;
        // echo "<pre>";
        // print_r($data['scaleCounts']); die;
        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/template/footer-link');
        $this->load->view('admin/project-profile', $data);
    }

    public function celebrity_management() {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Celebrity Management';

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/celebrity_management.php', $data);
        $this->load->view('admin/template/footer-link');
    }

    public function event_management() {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Event Management';

        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('admin_id'),
            'tree_type' => 4,
        ]);

        // print_r($data['trees']); die;

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/event_management.php', $data);
        $this->load->view('admin/template/footer-link');
    }

    public function data_feeding_panel() {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }
        $timeline_id = $this->input->get('id');

        $content_type_map = [
            'text'  => 'calendar_textbox',
            'other' => 'calendar_otherlink',
            'docs'  => 'calendar_docs',
            'image' => 'calendar_image',
            'audio' => 'calendar_audio',
            'video' => 'calendar_video',
            'user'  => 'calendar_user',
            'contact' => 'calendar_contact'
        ];

        if ($timeline_id) {

            $calendar_timeline = [];
            $timeline_details = $this->CommonModal->getRowWhere('calendar_timeline_master', [
                    'user_id' => sessionId('admin_id'),
                    'id'=> $timeline_id
            ]);
            // print_r($timeline_details); die;
            $timeline_items = $this->CommonModal->getRowsWhere(
                'calendar_timeline_items',
                [
                    'user_id'    => sessionId('admin_id'),
                    'timeline_id'=> $timeline_id
                ],
                'position ASC'   // 🔥 KEEP ORDER
            );

            if ($timeline_items) {

                foreach ($timeline_items as $item) {

                    if (empty($item['content_id'])) continue;

                    $table = $content_type_map[$item['content_type']] ?? null;
                    if (!$table) continue;

                    $content = $this->CommonModal->getRowWhere($table, [
                        'id' => $item['content_id']
                    ]);

                    $users = [];
                    if($item['content_type'] == 'user'){
                        $user_id_arr = explode(',', $content['timeline_user_id']);

                        foreach($user_id_arr as $user_id){
                            $users[] = $this->CommonModal->getRowWhere('freelancer', [
                                'id' => $user_id
                            ]);
                        }
                    }

                    if(!empty($users)){
                        $content['users'] = $users;
                    }

                    if ($content) {
                        // 🔥 attach meta info
                        $content['content_type'] = $item['content_type'];
                        $content['position']     = $item['position'];
                        $calendar_timeline[] = $content; // ✅ APPEND
                    }
                }
            }
            $data['calendar']['timeline'] = $calendar_timeline;
            $data['calendar']['timeline_details'] = $timeline_details;

            // echo "<pre>";
            // print_r($data);
            // die;
        }

        $data['title'] = 'Data Feeding Panel';

        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('admin_id'),
            'tree_type' => 4,
        ]);

        // print_r($data['trees']); die;

        $this->load->view('admin/template/header-link.php');
        $this->load->view('admin/template/header.php');
        $this->load->view('admin/template/footer-link');
        $this->load->view('admin/data_feeding_panel.php', $data);
    }

    public function searchUsers()
    {
        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON payload']);
            return;
        }

        $search = isset($data['search']) ? trim($data['search']) : '';

        // if (strlen($search) < 2) {
        //     echo json_encode(['success' => false, 'message' => 'Search term too short']);
        //     return;
        // }

        try {
            $this->db->select('id, name, email, user_image');
            $this->db->from('tbl_freelancer');
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
            // $this->db->limit(20);

            $query = $this->db->get();
            $users = $query->result_array();

            $formatted_users = array_map(function ($user) {
                return [
                    'id' => $user['id'],
                    'name' => !empty($user['name']) ? $user['name'] : 'No Name',
                    'email' => $user['email'],
                    'avatar' => !empty($user['user_image']) ?
                        base_url() . 'uploads/user_profile/' . $user['user_image'] :
                        base_url() . 'assets/user-icon.png'
                ];
            }, $users);

            echo json_encode([
                'success' => true,
                'users' => $formatted_users
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function searchUsersNew()
    {
        header('Content-Type: application/json');

        if (!sessionId('admin_id')) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid JSON payload'
            ]);
            return;
        }

        $search = isset($data['search']) ? trim($data['search']) : '';

        if ($search === '') {
            echo json_encode([
                'success' => true,
                'users' => []
            ]);
            return;
        }

        try {
            $this->db->select('id, name, email, user_image');
            $this->db->from('tbl_freelancer');
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
            $this->db->limit(20); // ✅ VERY IMPORTANT

            $users = $this->db->get()->result_array();

            $formatted_users = array_map(function ($user) {
                return [
                    'value'  => $user['id'],   // ✅ REQUIRED BY TAGIFY
                    'name'   => $user['name'] ?: 'No Name',
                    'email'  => $user['email'],
                    'avatar' => !empty($user['user_image'])
                        ? base_url('uploads/user_profile/' . $user['user_image'])
                        : base_url('assets/user-icon.png')
                ];
            }, $users);

            echo json_encode([
                'success' => true,
                'users' => $formatted_users
            ]);

        } catch (Throwable $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Server error'
            ]);
        }
    }

    public function create_tree(){
        // print_r($this->input->post()); die;

        if (!sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $tree_data = [];
        $tree_data['tree_type'] = $this->input->post('tree_type');
        $tree_data['type_id'] = null;
        $tree_data['user_id'] = sessionId('admin_id');
        $tree_data['title'] = $this->input->post('title');
        // print_r($tree_data); die;
        $tree_id = $this->CommonModal->insertRowReturnId('tree', $tree_data);

        $timeline_data = [
            "tree_id" => $tree_id
        ];

        $no_timelines = (int) $this->input->post('count');
         
        $timeline_ids = [];

        for ($i = 0; $i < $no_timelines; $i++) {
            $timeline_ids[] = $this->CommonModal->insertRowReturnId('timelines', [
                'tree_id' => $tree_id
            ]);
        }
        redirect($this->input->server('HTTP_REFERER'));  
    }

    public function get_branches(){
        $data = [];

        $tree_id = (int) $this->input->post('tree_id');
        
        $data['branches'] = $this->CommonModal->getRowsWhere('timelines',[
            'tree_id' => $tree_id,
        ]);

        $data['users'] = $this->db
                        ->select('tu.timeline_id, u.id, u.name, u.user_image')
                        ->from('timeline_users tu')
                        ->join('freelancer u', 'u.id = tu.user_id')
                        ->where('tu.tree_id', $tree_id)
                        ->get()
                        ->result_array();

        echo json_encode($data);
    }

    public function add_user_to_timeline()
    {
        $tree_id = $this->input->post('tree_id');
        $timeline_id = $this->input->post('timeline_id');
        $user_id = $this->input->post('user_id');

        // 🔥 CHECK DUPLICATE USER IN SAME TREE
        $exists = $this->db
            ->where([
                'tree_id' => $tree_id,
                'user_id' => $user_id
            ])
            ->count_all_results('timeline_users');

        if ($exists > 0) {
            echo json_encode([
                'status'  => 'duplicate',
                'message' => 'User already exists in this tree'
            ]);
            return;
        }


        $post_data = [
            "tree_id" => $tree_id,
            "timeline_id" => $timeline_id,
            "user_id" => $user_id
        ];

        $this->CommonModal->insertRowReturnId('timeline_users', $post_data);
        $user_data = $this->CommonModal->getUserById($user_id);

        $res = [
            "status" => "success",
            "user" => $user_data
        ];

        echo json_encode($res);
    }

    public function remove_user_from_timeline()
    {
        $this->db->where([
            'tree_id'     => $this->input->post('tree_id'),
            'timeline_id' => $this->input->post('timeline_id'),
            'user_id'     => $this->input->post('user_id')
        ])->delete('timeline_users');

        echo json_encode(['status' => 'success']);
    }


    public function getTimelineUsers()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['timeline_id'])) {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->select('u.id, u.name, u.email, u.user_image');
        $this->db->from('timeline_users tu');
        $this->db->join('tbl_freelancer u', 'u.id = tu.user_id');
        $this->db->where('tu.timeline_id', $data['timeline_id']);

        $users = $this->db->get()->result_array();

        $response = array_map(function ($u) {
            return [
                'value'  => (string) $u['id'],
                'name'   => $u['name'] ?: 'No Name',
                'email'  => $u['email'],
                'avatar' => !empty($u['user_image'])
                    ? base_url('uploads/user_profile/'.$u['user_image'])
                    : base_url('assets/user-icon.png')
            ];
        }, $users);

        echo json_encode([
            'success' => true,
            'users' => $response
        ]);
    }


    public function update_user_timeline()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $tree_id       = $this->input->post('tree_id');
        $user_id       = $this->input->post('user_id');
        $from_timeline = $this->input->post('from_timeline');
        $to_timeline   = $this->input->post('to_timeline');

        if (!$tree_id || !$user_id || !$to_timeline) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Invalid parameters'
            ]);
            return;
        }

        // 🔥 Update timeline mapping
        $this->db->where([
            'tree_id'     => $tree_id,
            'user_id'     => $user_id,
            'timeline_id' => $from_timeline
        ]);

        $updated = $this->db->update('timeline_users', [
            'timeline_id' => $to_timeline
        ]);

        if ($updated) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'User moved successfully'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to update'
            ]);
        }
    }

    public function save_connection()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $tree_id   = $this->input->post('tree_id');
        $from_user = $this->input->post('from_user');
        $to_user   = $this->input->post('to_user');

        // 🔒 Basic validation
        if (!$tree_id || !$from_user || !$to_user) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Invalid parameters'
            ]);
            return;
        }

        // ❌ Prevent self-connection
        if ($from_user == $to_user) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Cannot connect user to itself'
            ]);
            return;
        }

        // 🔄 Normalize order (A → B same as B → A)
        $user_a = min($from_user, $to_user);
        $user_b = max($from_user, $to_user);

        // 🔍 Check duplicate connection
        $exists = $this->db
            ->where([
                'tree_id'   => $tree_id,
                'from_user' => $user_a,
                'to_user'   => $user_b
            ])
            ->count_all_results('user_connections');

        if ($exists > 0) {
            echo json_encode([
                'status'  => 'duplicate',
                'message' => 'Connection already exists'
            ]);
            return;
        }

        // ✅ Insert connection
        $this->db->insert('user_connections', [
            'tree_id'   => $tree_id,
            'from_user' => $user_a,
            'to_user'   => $user_b
        ]);

        echo json_encode([
            'status'  => 'success',
            'message' => 'Connection saved'
        ]);
    }

    public function get_connections()
    {
        $tree_id = $this->input->get('tree_id');

        if (!$tree_id) {
            echo json_encode(['success' => false]);
            return;
        }

        $connections = $this->db
            ->where('tree_id', $tree_id)
            ->get('user_connections')
            ->result();

        echo json_encode([
            'success'     => true,
            'connections' => $connections
        ]);
    }
}

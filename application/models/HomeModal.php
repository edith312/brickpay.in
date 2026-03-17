<?php
class HomeModal extends CI_Model
{
    // public function get_all_press_release()
    // {
    //     $final = [];

    //     // ---------- COMPANY ----------
    //     $this->db->select("
    //         cpr.id,
    //         cpr.press_release,
    //         cpr.created_date,
    //         cpr.uniq_id,

    //         f.name,
    //         f.email,
    //         f.user_image,

    //         c.company_name,
    //         NULL AS project_name,

    //         'company' AS type
    //     ", false);
    //     $this->db->from('company_press_release cpr');
    //     $this->db->join('freelancer f', 'cpr.user_id = f.id', 'left');
    //     $this->db->join('companies c', 'c.id = cpr.company_id', 'left');
    //     $company = $this->db->get()->result();

    //     // ---------- PROJECT ----------
    //     $this->db->select("
    //         ppr.id,
    //         ppr.press_release,
    //         ppr.created_date,
    //         ppr.uniq_id,

    //         f.name,
    //         f.email,
    //         f.user_image,

    //         c.company_name,
    //         p.project_name AS project_name,

    //         'project' AS type
    //     ", false);
    //     $this->db->from('project_press_release ppr');
    //     $this->db->join('freelancer f', 'ppr.user_id = f.id', 'left');
    //     $this->db->join('projects p', 'p.id = ppr.project_id', 'left');
    //     $this->db->join('companies c', 'c.id = p.company_id', 'left');
    //     $project = $this->db->get()->result();

    //     // ---------- USER ----------
    //     $this->db->select("
    //         upr.id,
    //         upr.press_release,
    //         upr.created_date,
    //         upr.uniq_id,

    //         f.name,
    //         f.email,
    //         f.user_image,

    //         NULL AS company_name,
    //         NULL AS project_name,

    //         'user' AS type
    //     ", false);
    //     $this->db->from('user_press_release upr');
    //     $this->db->join('freelancer f', 'upr.user_id = f.id', 'left');
    //     $user = $this->db->get()->result();

    //     // ---------- MERGE ----------
    //     $final = array_merge($company, $project, $user);

    //     // ---------- SORT (LATEST → OLDEST) ----------
    //     usort($final, function ($a, $b) {
    //         return strtotime($b->created_date) - strtotime($a->created_date);
    //     });

    //     return $final;
    // }
    
    public function get_all_press_release($filters = [])
    {
        $final = [];

        // -------------------------------
        // PREPARE FILTER IDS BY TYPE
        // -------------------------------
        $companyIds = [];
        $projectIds = [];
        $userIds    = [];

        if (!empty($filters) && is_array($filters)) {
            foreach ($filters as $f) {
                if (empty($f['id']) || empty($f['type'])) continue;

                if ($f['type'] === 'company') {
                    $companyIds[] = $f['id'];
                } elseif ($f['type'] === 'project') {
                    $projectIds[] = $f['id'];
                } elseif ($f['type'] === 'user') {
                    $userIds[] = $f['id'];
                }
            }
        }

        // ---------- COMPANY ----------
        if (empty($filters) || !empty($companyIds)) {
            $this->db->select("
                cpr.id,
                cpr.press_release,
                cpr.created_date,
                cpr.uniq_id,

                f.name,
                f.email,
                f.user_image,

                c.company_name,
                NULL AS project_name,

                'company' AS type
            ", false);
            $this->db->from('company_press_release cpr');
            $this->db->join('freelancer f', 'cpr.user_id = f.id', 'left');
            $this->db->join('companies c', 'c.id = cpr.company_id', 'left');

            if (!empty($companyIds)) {
                $this->db->where_in('cpr.id', $companyIds);
            }

            $company = $this->db->get()->result();
        } else {
            $company = [];
        }

        // ---------- PROJECT ----------
        if (empty($filters) || !empty($projectIds)) {
            $this->db->select("
                ppr.id,
                ppr.press_release,
                ppr.created_date,
                ppr.uniq_id,

                f.name,
                f.email,
                f.user_image,

                c.company_name,
                p.project_name AS project_name,

                'project' AS type
            ", false);
            $this->db->from('project_press_release ppr');
            $this->db->join('freelancer f', 'ppr.user_id = f.id', 'left');
            $this->db->join('projects p', 'p.id = ppr.project_id', 'left');
            $this->db->join('companies c', 'c.id = p.company_id', 'left');

            if (!empty($projectIds)) {
                $this->db->where_in('ppr.id', $projectIds);
            }

            $project = $this->db->get()->result();
        } else {
            $project = [];
        }

        // ---------- USER ----------
        if (empty($filters) || !empty($userIds)) {
            $this->db->select("
                upr.id,
                upr.press_release,
                upr.created_date,
                upr.uniq_id,

                f.name,
                f.email,
                f.user_image,

                NULL AS company_name,
                NULL AS project_name,

                'user' AS type
            ", false);
            $this->db->from('user_press_release upr');
            $this->db->join('freelancer f', 'upr.user_id = f.id', 'left');

            if (!empty($userIds)) {
                $this->db->where_in('upr.id', $userIds);
            }

            $user = $this->db->get()->result();
        } else {
            $user = [];
        }

        // ---------- MERGE ----------
        $final = array_merge($company, $project, $user);

        // ---------- SORT (LATEST → OLDEST) ----------
        usort($final, function ($a, $b) {
            return strtotime($b->created_date) - strtotime($a->created_date);
        });

        return $final;
    }


    public function check_kyc($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->from('userkyc')
            ->count_all_results() > 0;
    }

    public function getUserConnections($user_id)
    {
        $this->db->select("
            u.id AS user_id,
            u.user_image,
            u.name,
            u.summary,
            u.email,
            u.phone,
            u.city,
            utc.status AS connection_status,
            IF(utc.sender_id = {$user_id}, 'sent', 'received') AS connection_direction
        ");

        $this->db->from('freelancer u');

        $this->db->join(
            'user_network_connections utc',
            "(
                (utc.sender_id = {$user_id} AND utc.receiver_id = u.id)
                OR
                (utc.sender_id = u.id AND utc.receiver_id = {$user_id})
            )",
            'left'
        );

        $this->db->where('u.id !=', $user_id);

        $query = $this->db->get();

        // Debug
        // echo $this->db->last_query(); die;

        return $query->result();
    }

    public function getAllIncomingRequests($user_id)
    {
        return $this->db
            ->select('
                unc.id as request_id,
                unc.sender_id,
                unc.status,
                unc.created_at,
                unc.updated_at,
                u.name,
                u.city,
                u.user_image,
                u.summary
            ')
            ->from('user_network_connections unc')
            ->join('freelancer u', 'u.id = unc.sender_id')
            ->where('unc.receiver_id', $user_id)
            ->order_by('unc.created_at', 'DESC')
            ->get()
            ->result_array();
    }

    public function search_calender_events($search_filter, $user_id)
    {
        $this->db->select('
            ctm.id as master_timeline_id,
            ctm.date,
            ctm.opening_time,
            ctm.closing_time,
            cti.content_type,
            cti.content_id
        ');
        $this->db->from('calendar_timeline_master ctm');
        $this->db->join('calendar_timeline_items cti', 'ctm.id = cti.timeline_id');
        $this->db->where('ctm.user_id', $user_id);
        $timeline_items = $this->db->get()->result_array();

        $tableMap = [
            'text'    => 'calendar_textbox',
            'image'   => 'calendar_image',
            'video'   => 'calendar_video',
            'audio'   => 'calendar_audio',
            'docs'    => 'calendar_docs',
            'other'   => 'calendar_other',
            'contact' => 'calendar_contact'
        ];

        $tableSearchCol = [
            'text'    => 'textbox_description',
            'image'   => 'imagelink',
            'video'   => 'videolink',
            'audio'   => 'audiolink',
            'docs'    => 'docslink',
            'other'   => 'otherlink',
            'contact' => 'contact'
        ];

        $matched_master_ids = [];

        foreach ($timeline_items as $timeline_item) {

            $type = $timeline_item['content_type'];

            /* ---------- CONTENT TABLE SEARCH ---------- */
            if (isset($tableMap[$type])) {

                $this->db->from($tableMap[$type]);
                $this->db->where('id', $timeline_item['content_id']);
                $this->db->like($tableSearchCol[$type], $search_filter, 'both');

                if ($this->db->count_all_results() > 0) {
                    $matched_master_ids[$timeline_item['master_timeline_id']] = true;
                }
            }

            /* ---------- USER SEARCH ---------- */
            if ($type === 'user') {

                $userRow = $this->db
                    ->where('id', $timeline_item['content_id'])
                    ->get('calendar_user')
                    ->row();

                if ($userRow && !empty($userRow->timeline_user_id)) {

                    $userIds = explode(',', $userRow->timeline_user_id);

                    foreach ($userIds as $user_id) {
                        $this->db->from('freelancer');
                        $this->db->where('id', $user_id);
                        $this->db->group_start()
                            ->like('name', $search_filter)
                            ->or_like('phone', $search_filter)
                            ->or_like('email', $search_filter)
                        ->group_end();

                        if ($this->db->count_all_results() > 0) {
                            $matched_master_ids[$timeline_item['master_timeline_id']] = true;
                            break;
                        }
                    }
                }
            }
        }

        /* ---------- FINAL RESULT (ARRAY OF ROWS) ---------- */

        $timeline_items_results = [];
        $added_master_ids = [];

        foreach ($timeline_items as $timeline_item) {

            $masterId = $timeline_item['master_timeline_id'];

            if (
                isset($matched_master_ids[$masterId]) &&
                !isset($added_master_ids[$masterId])
            ) {
                $timeline_items_results[] = $timeline_item; // add once
                $added_master_ids[$masterId] = true;        // mark as added
            }
        }

        return $timeline_items_results;
    }

    public function search_press_release($search_filter)
    {
        $final = [];
        $keyword = trim($search_filter);

        // ---------- COMPANY ----------
        $this->db->select("
            cpr.id,
            cpr.press_release,
            cpr.created_date,
            cpr.uniq_id,

            f.name,
            f.email,
            f.user_image,

            c.company_name,
            NULL AS project_name,

            'company' AS type
        ", false);
        $this->db->from('company_press_release cpr');
        $this->db->join('freelancer f', 'cpr.user_id = f.id', 'left');
        $this->db->join('companies c', 'c.id = cpr.company_id', 'left');

        if (!empty($keyword)) {
            $this->db->group_start()
                ->like('cpr.press_release', $keyword)
                ->or_like('c.company_name', $keyword)
                ->or_like('f.name', $keyword)
                ->or_like('f.email', $keyword)
            ->group_end();
        }

        $company = $this->db->get()->result();


        // ---------- PROJECT ----------
        $this->db->select("
            ppr.id,
            ppr.press_release,
            ppr.created_date,
            ppr.uniq_id,

            f.name,
            f.email,
            f.user_image,

            c.company_name,
            p.project_name AS project_name,

            'project' AS type
        ", false);
        $this->db->from('project_press_release ppr');
        $this->db->join('freelancer f', 'ppr.user_id = f.id', 'left');
        $this->db->join('projects p', 'p.id = ppr.project_id', 'left');
        $this->db->join('companies c', 'c.id = p.company_id', 'left');

        if (!empty($keyword)) {
            $this->db->group_start()
                ->like('ppr.press_release', $keyword)
                ->or_like('p.project_name', $keyword)
                ->or_like('c.company_name', $keyword)
                ->or_like('f.name', $keyword)
                ->or_like('f.email', $keyword)
            ->group_end();
        }

        $project = $this->db->get()->result();


        // ---------- USER ----------
        $this->db->select("
            upr.id,
            upr.press_release,
            upr.created_date,
            upr.uniq_id,

            f.name,
            f.email,
            f.user_image,

            NULL AS company_name,
            NULL AS project_name,

            'user' AS type
        ", false);
        $this->db->from('user_press_release upr');
        $this->db->join('freelancer f', 'upr.user_id = f.id', 'left');

        if (!empty($keyword)) {
            $this->db->group_start()
                ->like('upr.press_release', $keyword)
                ->or_like('f.name', $keyword)
                ->or_like('f.email', $keyword)
            ->group_end();
        }

        $user = $this->db->get()->result();


        // ---------- MERGE ----------
        $final = array_merge($company, $project, $user);

        // ---------- SORT (LATEST → OLDEST) ----------
        usort($final, function ($a, $b) {
            return strtotime($b->created_date) - strtotime($a->created_date);
        });

        return $final;
    }

    public function getAppointments($ids)
    {
        if (!empty($ids) && is_array($ids)) {

            $this->db->select('
                a.*, 
                f.name as sender_name, 
                f.email as sender_email, 
                f.user_image as sender_image, 
                c.company_name,
                p.project_name
            ');

            $this->db->from('appointments a');

            $this->db->join('freelancer f', 'a.user_id = f.id');
            $this->db->join('companies c', 'c.id = a.company_id');

            // ✅ LEFT JOIN (important)
            $this->db->join('projects p', 'p.id = a.project_id', 'left');

            // ✅ Fix where_in
            $this->db->where_in('a.company_id', $ids);

            $query = $this->db->get();
            return $query->result_array();

        } else {
            return [];
        }
    }

    public function updateAppointmentStatus($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('appointments', [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getTeamRequest(){
        $this->db->select('tcm.*, tcm.id as id, d.name, c.company_name, p.project_name, b.brick_title, cd.director_name');
        $this->db->from('teamcompanymember tcm');
        $this->db->join('departments d', 'tcm.department_id = d.id', 'left');
        $this->db->join('companies c', 'c.id = d.company_id', 'left');
        $this->db->join('projects p', 'p.id = d.project_id', 'left');
        $this->db->join('bricks b', 'b.id = d.brick_id', 'left');
        $this->db->join('company_directory cd', 'cd.company_id = c.id', 'left');
        $this->db->where('tcm.member_id', sessionId('freelancer_id'));
        $this->db->where('tcm.created_by IS NULL', null, false);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTeamStructure($where){
        $this->db->select('
            d.id AS department_id,
            d.name AS department_name,

            tcm.id AS team_row_id,
            tcm.member_id,
            tcm.department_id AS tcm_department_id,
            tcm.nickname,

            f.id AS freelancer_id,
            f.name,
            f.email,
            f.user_image,

            da.id AS agreement_id,
            da.file_name,
            da.file_path,
            da.uploaded_at

        ');

        $this->db->from('tbl_departments d');

        $this->db->join(
            'tbl_teamcompanymember tcm',
            "d.id = tcm.department_id AND tcm.status = 'Accepted'",
            'left'
        );

        $this->db->join(
            'tbl_department_agreements da',
            'da.department_id = d.id',
            'left'
        );

        $this->db->join(
            'tbl_freelancer f',
            'tcm.member_id = f.id',
            'left'
        );

        $this->db->where('d.company_id', $where['company_id']);
        $this->db->where('d.project_id', $where['project_id']);
        $this->db->where('d.brick_id', $where['brick_id']);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCompaniesWithTeam($user_id)
    {
        $this->db->select("
            c.*,
            CASE 
                WHEN c.user_id = ".$this->db->escape($user_id)."
                THEN 1 
                ELSE 0 
            END as is_owner,
            COUNT(DISTINCT tcm_all.member_id) as total_members
        ", FALSE);

        $this->db->from('tbl_companies c');

        $this->db->join(
            'tbl_departments d',
            'c.id = d.company_id AND d.project_id IS NULL AND d.brick_id IS NULL',
            'left'
        );

        // check if current user belongs
        $this->db->join(
            'teamcompanymember tcm',
            "tcm.department_id = d.id 
            AND tcm.member_id = '$user_id' 
            AND tcm.status = 'Accepted'",
            'left'
        );

        // join again to count all accepted members
        $this->db->join(
            'teamcompanymember tcm_all',
            "tcm_all.department_id = d.id 
            AND tcm_all.status = 'Accepted'",
            'left'
        );

        $this->db->where("(c.user_id = '$user_id' OR tcm.member_id = '$user_id')");
        $this->db->where('c.transaction_status', '1');
        $this->db->where('c.status', 'Active');

        $this->db->group_by('c.id');

        $this->db->order_by('c.id', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getProjectsWithTeam($user_id, $company_id = null)
    {

        $this->db->select("DISTINCT p.*,
            CASE 
                WHEN p.user_id = ". $this->db->escape($user_id) ."
                THEN 1 
                ELSE 0 
            END as is_owner
        ", FALSE);

        $this->db->from('projects p');

        $this->db->join(
            'teamcompanymember tcm',
            "tcm.project_id = p.id 
            AND tcm.member_id = ".$this->db->escape($user_id)." 
            AND tcm.status = 'Accepted'",
            'left'
        );

        $this->db->where("(p.user_id = ".$this->db->escape($user_id)." OR tcm.member_id = ".$this->db->escape($user_id).")");
        $this->db->where('p.transaction_status', '1');
        $this->db->where('p.project_status', 'Active');

        if ($company_id) {
            $this->db->where('p.company_id', $company_id);
        }

        $this->db->order_by('p.id', 'DESC');

        return $this->db->get()->result_array();
    }
}

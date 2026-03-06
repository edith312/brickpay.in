<?php

class TeamsModel extends CI_Model {

    public function getDepartmentsWithTeamAndUsers($companyId, $projectId = null, $brickId = null)
    {
        $this->db->select('
            d.id AS department_id,
            d.name,
            d.company_id,
            d.project_id,
            d.brick_id,

            t.id AS team_row_id,
            t.member_id,
            t.status,

            f.id as freelancer_id,
            f.name AS freelancer_name,
            f.email AS freelancer_email,
            f.user_image AS freelancer_avatar
        ');
        $this->db->from('tbl_departments d');
        $this->db->join('tbl_teamcompanymember t', 't.department_id = d.id', 'left');
        $this->db->join('tbl_freelancer f', 'f.id = t.member_id', 'left');

        $this->db->where('d.company_id', $companyId);

        if ($projectId === null) {
            $this->db->where('d.project_id IS NULL', null, false);
        } else {
            $this->db->where('d.project_id', $projectId);
        }

        if ($brickId === null) {
            $this->db->where('d.brick_id IS NULL', null, false);
        } else {
            $this->db->where('d.brick_id', $brickId);
        }

        $rows = $this->db->get()->result_array();

        return $this->groupDepartmentsWithTeam($rows);
    }

    private function groupDepartmentsWithTeam($rows)
    {
        $departments = [];

        foreach ($rows as $row) {
            $deptId = $row['department_id'];

            if (!isset($departments[$deptId])) {
                $departments[$deptId] = [
                    'id' => $deptId,
                    'department_name' => $row['name'],
                    'company_id' => $row['company_id'],
                    'project_id' => $row['project_id'],
                    'brick_id' => $row['brick_id'],
                    'team' => []
                ];
            }

            // If team member exists (LEFT JOIN can return NULLs)
            if (!empty($row['team_row_id'])) {
                $departments[$deptId]['team'][] = [
                    'id' => $row['team_row_id'],
                    'member_id' => $row['member_id'],
                    'role' => $row['role'],
                    'status' => $row['status'],
                    'freelancer' => [
                        'id' => $row['freelancer_id'],
                        'name' => $row['freelancer_name'],
                        'email' => $row['freelancer_email'],
                        'avatar' => $row['freelancer_avatar'],
                    ]
                ];
            }
        }

        return array_values($departments); // reindex
    }

    public function createDepartment($data)
    {
        $this->db->insert('tbl_departments', $data);
        return $this->db->insert_id();
    }

    public function departmentExists($name, $companyId, $projectId, $brickId)
    {
        $this->db->where('name', $name);
        $this->db->where('company_id', $companyId);

        if ($projectId === null) {
            $this->db->where('project_id IS NULL', null, false);
        } else {
            $this->db->where('project_id', $projectId);
        }

        if ($brickId === null) {
            $this->db->where('brick_id IS NULL', null, false);
        } else {
            $this->db->where('brick_id', $brickId);
        }

        return $this->db->count_all_results('tbl_departments') > 0;
    }

    public function searchFreelancers($q)
    {
        return $this->db
            ->select('id, name, email, user_image')
            ->from('tbl_freelancer')
            ->group_start()
                ->like('name', $q)
                ->or_like('email', $q)
            ->group_end()
            ->limit(10)
            ->get()
            ->result_array();
    }

    public function teamMemberExists($departmentId, $memberId)
    {
        return $this->db
            ->where('department_id', $departmentId)
            ->where('member_id', $memberId)
            ->count_all_results('tbl_teamcompanymember') > 0;
    }

    public function addTeamMember($data)
    {
        $this->db->insert('tbl_teamcompanymember', $data);
        return $this->db->insert_id();
    }
}
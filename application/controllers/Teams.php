<?php

class Teams extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TeamsModel');
    }

    public function create() {
        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $user_id = sessionId('freelancer_id');

        $data = [];

        $data['companies'] = $this->CommonModal->getRowsWhere('companies', [
            'user_id' => $user_id
        ]);

        $this->load->view('includes/header', $data);
        $this->load->view('includes/header-link');
        $this->load->view('teams/create_teams');
        $this->load->view('includes/footer');
    }

    public function get_projects() {

        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $selectedCompanyId = $this->input->post('selectedCompanyId');
        
        if(empty($selectedCompanyId)){
            $res = [
                'success' => false,
                'msg' => 'company id not found'
            ];

            echo json_encode($res); 
        }

        $projects = $this->CommonModal->getRowsWhere('projects', [
            'company_id' => $selectedCompanyId
        ]);

        $data['projects'] = $projects;

        $html = $this->load->view('teams/project_options', $data, true);

        $res = [
            'success' => true,
            'html' => $html
        ];

        echo json_encode($res);
    }

    public function get_bricks() {

        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $selectedProjectId = $this->input->post('selectedProjectId');
        
        if(empty($selectedProjectId)){
            $res = [
                'success' => false,
                'msg' => 'project id not found'
            ];

            echo json_encode($res); 
        }

        $bricks = $this->CommonModal->getRowsWhere('bricks', [
            'project_id' => $selectedProjectId
        ]);

        $data['bricks'] = $bricks;

        $html = $this->load->view('teams/bricks_options', $data, true);

        $res = [
            'success' => true,
            'html' => $html
        ];

        echo json_encode($res);
    }

    public function get_team_structure()
    {
        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $companyId = $this->input->post('selectedCompanyId');
        $projectId = $this->input->post('selectedProjectId');
        $brickId   = $this->input->post('selectedBrickId');

        if (empty($companyId)) {
            echo json_encode(['success' => false, 'msg' => 'Company is required']);
            return;
        }

        $departments = $this->TeamsModel->getDepartmentsWithTeamAndUsers(
            $companyId,
            $projectId ?: null,
            $brickId ?: null
        );
        // dd($departments);
        if (empty($departments)) {
            $html = $this->load->view('teams/alert', ['msg' => 'No Department Found'], true);
            echo json_encode(['success' => true, 'html' => $html]);
            return;
        }

        $html = $this->load->view('teams/team_structure', ['departments' => $departments], true);

        echo json_encode([
            'success' => true,
            'html' => $html
        ]);
    }

    public function create_department()
    {

        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $name      = trim($this->input->post('department_name'));
        $companyId = $this->input->post('company_id');
        $projectId = $this->input->post('project_id');
        $brickId   = $this->input->post('brick_id');

        if (empty($companyId) || empty($name)) {
            echo json_encode([
                'success' => false,
                'msg' => 'Company and Department name are required'
            ]);
            return;
        }

        $is_exist = $this->TeamsModel->departmentExists($name, $companyId, $projectId, $brickId);

        if ($is_exist) {
            echo json_encode(['success' => false, 'msg' => 'Department already exists']);
            return;
        }

        $insert = [
            'name' => $name,   // ⚠️ match DB column
            'company_id' => $companyId,
            'project_id' => $projectId ?: null,
            'brick_id'   => $brickId ?: null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $id = $this->TeamsModel->createDepartment($insert);

        if ($id) {
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'msg' => 'DB insert failed']);
        }
    }

    public function update_department()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $department_id   = $this->input->post('department_id');
        $department_name = trim($this->input->post('department_name'));

        if (empty($department_id) || empty($department_name)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid department data'
            ]);
            return;
        }

        $update = $this->CommonModal->updateRowById(
            'departments',
            'id',
            $department_id,
            [
                'name' => $department_name
            ]
        );

        if ($update) {
            echo json_encode([
                'success' => true,
                'message' => 'Department updated successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Update failed'
            ]);
        }
    }

    public function delete_department() {

        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $departmentId = $this->input->post('department_id');

        if(!empty($departmentId)){
            $res = $this->CommonModal->deleteRowById('departments', [
                'id' => $departmentId
            ]);
        }

        if($res){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false]);
        }
    }

    public function search_freelancers()
    {
        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $q = trim($this->input->get('q'));

        if (strlen($q) < 2) {
            echo json_encode(['success' => false, 'users' => []]);
            return;
        }

        $this->load->model('TeamsModel');

        $users = $this->TeamsModel->searchFreelancers($q);

        echo json_encode(['success' => true, 'users' => $users]);
    }

    public function add_team_member()
    {

        if(!sessionId('freelancer_id')){
            redirect('/');
        }

        $departmentId = $this->input->post('department_id');
        $memberId     = $this->input->post('member_id');

        if (empty($departmentId) || empty($memberId)) {
            echo json_encode(['success' => false, 'msg' => 'Invalid data']);
            return;
        }

        $this->load->model('TeamsModel');

        if ($this->TeamsModel->teamMemberExists($departmentId, $memberId)) {
            echo json_encode(['success' => false, 'msg' => 'Member already in this department']);
            return;
        }

        $id = $this->TeamsModel->addTeamMember([
            'department_id' => $departmentId,
            'member_id' => $memberId,
            'status' => 'Requested',   // or Approved based on your flow
            'create_date' => date('Y-m-d H:i:s')
        ]);

        if ($id) {
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'msg' => 'DB insert failed']);
        }
    }


}
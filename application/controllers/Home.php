<?php
require_once APPPATH . '../vendor/autoload.php'; // Include Composer's autoloader
// require_once __DIR__ . '/../vendor/autoload.php';


use Razorpay\Api\Api;
use SebastianBergmann\Environment\Console;

class Home extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('HomeModal');
    }
    public function index()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        // Default dashboard view   
        $data['title'] = 'Dashboard';

        // Search Filter Implement Start Here
        // Get all filters from GET
        $filters = $this->input->get();

        // Remove empty values
        $activeFilters = array_filter($filters, function ($val) {
            return is_array($val) ? !empty(array_filter($val)) : strlen(trim($val)) > 0;
        });

        if (!empty($activeFilters)) {
            // ✅ If filters are applied, use custom query
            $this->db->select('*');
            $this->db->from('tbl_bricks');
            $this->db->where('brick_privacy', 'public');
            $this->db->where('brick_status !=', 'draft');
            $this->db->where('brick_status !=', 'trash');

            //  filter logic
            if (!empty($filters['filter_work'])) {
                // if ($filters['filter_work'] == 'both') {
                // No filter needed, show all
                // } else {
                $this->db->like('filter_work', $filters['filter_work']);
                // }
                // $this->db->like('filter_work', $filters['filter_work']);
            }

            if (!empty($filters['brick_type'])) {
                if ($filters['brick_type'] == 'Silver') {
                    echo $filterUpdated = '0';
                } else if ($filters['brick_type'] == 'Golden') {
                    $filterUpdated = '1';
                } else if ($filters['brick_type'] == 'Platinum') {
                    $filterUpdated = '2';
                } else if ($filters['brick_type'] == 'Titanium') {
                    $filterUpdated = '3';
                } else if ($filters['brick_type'] == 'Vibranium') {
                    $filterUpdated = '4';
                } else {
                    $filterUpdated = '';
                }
                $this->db->where('brick_type', $filterUpdated);
            }
            if (!empty($filters['filter-execution'])) {
                $this->db->where('filter_execution', $filters['filter-execution']);
            }
            if (!empty($filters['execution_unit'])) {
                $this->db->like('execution_unit', $filters['execution_unit']);
            }
            if (!empty($filters['filter-location'])) {
                $this->db->like('filter_location', $filters['filter-location']);
            }
            if (!empty($filters['filter_country'])) {
                $this->db->like('filter_country', $filters['filter_country']);
            }
            if (!empty($filters['filter_state'])) {
                $this->db->like('filter_state', $filters['filter_state']);
            }
            if (!empty($filters['filter_range'])) {
                $this->db->like('filter_range', $filters['filter_range']);
            }
            if (!empty($filters['filter_revenue_from']) && !empty($filters['filter_revenue_to'])) {
                $this->db->like('filter_revenue_from', (int)$filters['filter_revenue_from']);
                $this->db->like('filter_revenue_to', (int)$filters['filter_revenue_to']);
            }
            if (!empty($filters['filter-revenue-type'])) {
                $this->db->like('filter_revenue_type', $filters['filter-revenue-type']);
            }
            if (!empty($filters['filter-industry'])) {
                $this->db->like('filter_industry', $filters['filter-industry']);
            }
            if (!empty($filters['filter-industry-type'])) {
                $this->db->like('filter_industry_type', $filters['filter-industry-type']);
            }
            if (!empty($filters['filter-department'])) {
                $this->db->like('filter_department', $filters['filter-department']);
            }
            if (!empty($filters['filter-department-type'])) {
                $this->db->like('filter_department_type', $filters['filter-department-type']);
            }

            if (!empty($filters['filter_skills'])) {
                $this->db->like('filter_skills', $filters['filter_skills']);
            }
            if (!empty($filters['filter_education'])) {
                $this->db->like('filter_education', $filters['filter_education']);
            }
            /// NEW FILTER ADDED 
            if (!empty($filters['company_id'])) {
                $this->db->like('company_id', $filters['company_id']);
            }
            if (!empty($filters['project_id'])) {
                $this->db->like('project_id', $filters['project_id']);
            }
            if (!empty($filters['brick_id'])) {
                $this->db->like('id', $filters['brick_id']);
            }

            if (!empty($filters['user_search'])) {
                $this->db->like('user_id', $filters['user_search']);
            }

            if (!empty($filters['filter_brick_details'])) {
                $this->db->like('brick_title', $filters['filter_brick_details']);
            }


            // GLOBALLY SEARCH FILTER FOR BRICKS
            if (!empty($filters['globally_search_filter'])) {
                $keyword = $filters['globally_search_filter'];

                // Get table fields automatically
                $columns = $this->db->list_fields('tbl_bricks');

                $this->db->group_start();
                foreach ($columns as $col) {
                    $this->db->or_like($col, $keyword);
                }
                $this->db->group_end();
            }


            // Add more filters here as needed...

            $this->db->order_by('id', 'ASC');
            // $data['getBricks'] = $this->db->get()->result(); // ✅ Corrected
            $data['getBricks'] = $this->db->get()->result_array(); // ✅ arrays
            $data['filterSetup'] = $filters;

            // print_r($data['getBricks']) ; // Debugging line to check the output

        } else {
            // If no filters, load default public, non-draft bricks
            $data['getBricks'] = $this->CommonModal->getRowById(
                'tbl_bricks',
                [
                    'brick_privacy' => 'public',
                    'brick_status !=' => 'draft',
                    'brick_status !=' => 'trash',
                ],
                'id',
                'ASC'
            );
        }

        // Search Filter Implemnt End here

        // Default Dashboard Datas
        $data['totalProjectCreators'] = $this->CommonModal->getNumRow("companies");
        $data['totalConsultants'] = $this->CommonModal->getNumRow("freelancer");
        $data['totalProjects'] = $this->CommonModal->getNumRow("projects");
        $data['totalBricks'] = $this->CommonModal->getNumRow("bricks");

        // Search Filter 
        $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['transaction_status' => '1', 'status' => 'Active'], 'id', 'DESC');
        $data['totalPrivateBricks'] = $this->CommonModal->getNumRows("bricks", ['brick_privacy' => 'private']);
        $data['totalPublicBricks'] = $this->CommonModal->getNumRows("bricks", ['brick_privacy' => 'public']);

        // get all press release

        $data['press_releases'] = $this->HomeModal->get_all_press_release();
        // echo "<pre>";
        // print_r($data['press_releases']); die;
        // echo '<pre>';
        // print_r($data['getBricks']);
        // die;
        $this->load->view('includes/header-link', $data);
        $this->load->view('home');
    }

    public function choose_role()
    {
        $data['title'] = 'Choose Role';
        $this->load->view('includes/header-link', $data);
        $this->load->view('choose-role');
    }

    public function userLogin()
    {
        if (sessionId('freelancer_id')) {
            redirect(base_url('company/dashboard'));
        }

        $data['title'] = 'User Login';
        $this->load->view('includes/header-link', $data);
        $this->load->view('user-login');
    }

    public function register()
    {
        $data['title'] = 'Register';
        $this->load->view('includes/header-link', $data);
        $this->load->view('register');
    }

    public function notification()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Notification';
        $this->load->view('includes/header-link', $data);
        $this->load->view('notification');
    }

    public function wallet(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Wallet';
        $this->load->view('includes/header-link', $data);
        $this->load->view('wallet');
    }
    public function profile_update(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Profile Update';
        $data['profile_progress'] = $this->CompanyModal->get_profile_completion(sessionId('company_id'));
        $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', ['id = ' . sessionId('company_id'), 'status' => 'Active']);
        $this->load->view('includes/header-link', $data);
        $this->load->view('profile_update');
    }

    public function user_profile(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Contact', 'required|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|numeric|min_length[6]|max_length[6]');

        if ($this->form_validation->run() == FALSE) {
            // Money Section
            $freelancer_id = sessionId('freelancer_id');
            // Total Credit
            $this->db->select_sum('amount_cr');
            $this->db->where('shared_by', $freelancer_id);
            $this->db->where('status', 'Cr');
            $credit = $this->db->get('tbl_money_wallet')->row()->amount_cr;

            // Total Debit
            $this->db->select_sum('amount_dr');
            $this->db->where('shared_by', $freelancer_id);
            $this->db->where('status', 'Dr');
            $debit = $this->db->get('tbl_money_wallet')->row()->amount_dr;

            // Calculate balance
            $credit = $credit ?? 0;
            $debit = $debit ?? 0;
            $balance = $credit - $debit;

            // Send to view
            $data['wallet_balance'] = $balance;
            $data['wallet_credit'] = $credit;
            $data['wallet_debit'] = $debit;
            // Money Wallet Section

            $data['title'] = 'User Profile';
            $data['getProfile'] = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
            $data['getCountries'] = $this->CommonModal->getAllRowsInOrder('countries', 'name', 'ASC');
            $data['getCompanyCount'] = $this->CommonModal->getNumRows('companies', ['user_id' => sessionId('freelancer_id'), 'status' => 'Active']);
            $data['getProjectCount'] = $this->CommonModal->getNumRows('projects', ['user_id' => sessionId('freelancer_id')]);
            $data['getUserCount'] = $this->CommonModal->getNumRows('bricks', ['user_id' => sessionId('freelancer_id')]);
            $this->load->view('includes/header-link', $data);
            $this->load->view('user_profile');
        } else {

            $freelancer_id = $this->session->userdata('freelancer_id');
            $update = $this->CommonModal->updateRowById('tbl_freelancer', 'id', $freelancer_id, $_POST);

            if ($update) {
                $this->session->set_userdata('profileUpdate', '<div class="alert alert-success">Profile details updated successfully.</div>');
            } else {
                $this->session->set_userdata('profileUpdate', '<div class="alert alert-warning">Profile is already up to date.</div>');
            }
            $data['title'] = 'User Profile';
            redirect('company/user_profile');
        }
    }

    public function add_networth()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('networth_type', 'Networth Type', 'required');
        $this->form_validation->set_rules('networth_text', 'Networth Text', 'required');
        $this->form_validation->set_rules('networth_proof', 'Networth Proof', 'required');
        $this->form_validation->set_rules('networth_amount', 'Networth Amount', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {
            $networthData = [
                'networth_type' => $this->input->post('networth_type'),
                'networth_text' => $this->input->post('networth_text'),
                'networth_proof' => $this->input->post('networth_proof'),
                'networth_amount' => $this->input->post('networth_amount'),
                'user_id' => sessionId('freelancer_id'),
            ];

            // Insert project data into the database
            $insert = $this->CommonModal->insertRowReturnId('networth', $networthData);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Networth Added Successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Adding Networth!</div>');
            }

            // Redirect to Company Dashboard
            redirect('company/user_profile');
        }
    }

    public function user_kyc()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());


        $this->form_validation->set_rules('kyc_country', 'KYC Country', 'required');
        $this->form_validation->set_rules('kyc_tokenid', 'KYC Tokenid', 'required');
        $this->form_validation->set_rules('kyc_adharcard', 'KYC Adharcard', 'required');
        $this->form_validation->set_rules('kyc_pancard', 'KYC Pancard', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {
            $networthData = [
                'country_name' => $this->input->post('kyc_country'),
                'token_id' => $this->input->post('kyc_tokenid'),
                'adharcard' => $this->input->post('kyc_adharcard'),
                'pancard' => $this->input->post('kyc_pancard'),
                'user_id' => sessionId('freelancer_id'),

                // Pathology (panel-level)
                'cbc'                => $this->input->post('cbc'),
                'lft'                => $this->input->post('lft'),
                'rft'                => $this->input->post('rft'),
                'urine_rm'           => $this->input->post('urine_rm'),
                'stool_rm'           => $this->input->post('stool_rm'),
                'diabetes_profile'   => $this->input->post('diabetes_profile'),
                'vitamin_b12_d3'     => $this->input->post('vitamin_b12_d3'),
                'thyroid_profile'    => $this->input->post('thyroid_profile'),
                
                'status' => 'pending',
            ];

            // Insert project data into the database
            $insert = $this->CommonModal->insertRowReturnId('tbl_userkyc', $networthData);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">KYC Submitted Successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Submittin KYC!</div>');
            }

            // Redirect to User Profile
            redirect('company/user_profile');
        }
    }


    public function getPersonalBricks()
    {
        $privatebricks = $this->CommonModal->getRowById('tbl_bricks', ['user_id' => sessionId('freelancer_id'), 'perpro' => 'personal', 'forpercomp' => 'user'], 'id', 'DESC');

        if ($privatebricks) {
            $html = $this->load->view('/personal_brick_list', ['privatebricks' => $privatebricks], true);
            echo json_encode(['success' => true, 'html' => $html]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No Bricks Found']);
        }
    }

    public function getProfessionalBricks()
    {
        $privatebricks = $this->CommonModal->getRowById('tbl_bricks', ['user_id' => sessionId('freelancer_id'), 'perpro' => 'professional', 'forpercomp' => 'user'], 'id', 'DESC');

        if ($privatebricks) {
            $html = $this->load->view('/personal_brick_list', ['privatebricks' => $privatebricks], true);
            echo json_encode(['success' => true, 'html' => $html]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No Bricks Found']);
        }
    }


    public function create_company_profile(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('ciin_number', 'CIIN Number', 'required|callback_check_unique_cin');
        // $this->form_validation->set_rules('dipp_number', 'DIPP Number', 'required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('about_us', 'About Us', 'required');
        $this->form_validation->set_rules('mission', 'Mission', 'required');
        $this->form_validation->set_rules('vision', 'Vision', 'required');
        $this->form_validation->set_rules('valuation', 'Valuation', 'numeric');
        $this->form_validation->set_rules('equity_dilution', 'Equity Dilution', 'numeric');
        $this->form_validation->set_rules('founded_year', 'Founded Year', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Company Profile';
            // $data['profile_progress'] = $this->CompanyModal->get_profile_completion(sessionId('company_id'));
            $getcompany_id = sessionId('company_id');
            $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', ['id = ' . sessionId('company_id'), 'status' => 'Active']);
            $this->load->view('includes/header-link', $data);
            $this->load->view('create-company-profile');
        } else {

            $getcompany_id = sessionId('company_id');
            $company_id = sessionId('company_id');
            $user_id = $this->session->userdata('freelancer_id');


            $postData = [
                'user_id' => $user_id,
                'ciin_number' => $ciin_number,
                'dipp_number' => $dipp_number,
                'pan_number' => $pan_number,
                'tan_number' => $tan_number,
                'gst_number' => $gst_number,
                'company_name' => $company_name,
                'about_us' => $about_us,
                'mission' => $mission,
                'vision' => $vision,
                'valuation' => $valuation,
                'equity_dilution' => $equity_dilution,
                'founded_year' => $founded_year,
                'employercount' => $employercount,
                'currentemployercount' => $currentemployercount,
                'lifetimerevenue' => $lifetimerevenue,
                'currentlifetimerevenue' => $currentlifetimerevenue,
            ];

            $update = $this->CommonModal->updateRowById('companies', 'id', sessionId('company_id'), $postData);

            if (!empty($director_name)) {
                foreach ($director_name as $key => $name) {
                    if (!empty($director_name)) {
                        $directorData = [
                            'company_id' => $getcompany_id,
                            'director_name' => $director_name[$key] ?? null,
                            'director_din_number' => $director_din_number[$key] ?? null,
                            'director_mobile_number' => $director_mobile_number[$key] ?? null,
                            'director_email' => $director_email[$key] ?? null,
                            'director_address' => $director_address[$key] ?? null,
                        ];
                        $this->CommonModal->insertRow('tbl_company_directory', $directorData);
                    }
                }
            }
            if (!empty($account_holder_name)) {
                foreach ($account_holder_name as $key => $name) {
                    if (!empty($account_holder_name)) {
                        $accountData = [
                            'company_id' => $getcompany_id,
                            'account_holder_name' => $account_holder_name[$key] ?? null,
                            'account_number' => $account_number[$key] ?? null,
                            'bank_name' => $bank_name[$key] ?? null,
                            'ifsc_code' => $ifsc_code[$key] ?? null
                        ];
                        $this->CommonModal->insertRow('tbl_company_banks', $accountData);
                    }
                }
            }
            if ($update) {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-success">Company Created Successfully.</div>');
                $this->session->unset_userdata('company_id');
            } else {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-success">Company is up-to-date</div>');
            }
            redirect(base_url('company/company-profile'));
        }
    }
    public function user_preview(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'User Preview';
        $getID = $this->input->get('id');
        $userId = sessionId('freelancer_id');
        if (isset($getID)) {
            $userId = $getID;
        }
        // echo $userId;
        // exit();
        // $data['profile_progress'] = $this->CompanyModal->get_profile_completion(sessionId('company_id'));
        // $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . sessionId('company_id'));
        $data['getProfile'] = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => $userId]);
        // echo '<pre>';
        // print_r($data['getProfile']);
        // exit();

        // Profile Count 
        $count = $data['getProfile']['views'];
        $counts = $count + 1;

        $this->CommonModal->updateRowById('tbl_freelancer', 'id', sessionId('freelancer_id'), ['views' => $counts]);

        $userId = sessionId('freelancer_id');
        $data['ageBlocks'] = $this->CommonModal->getRowsByMultipleWhere('tbl_age_blocks', ['user_id' => $userId]);
        $data['documents'] = $this->CommonModal->getRowsByMultipleWhere('tbl_block_documents', ['user_id' => $userId]);
        $data['images']    = $this->CommonModal->getRowsByMultipleWhere('tbl_block_images', ['user_id' => $userId]);
        $data['videos']    = $this->CommonModal->getRowsByMultipleWhere('tbl_block_videos', ['user_id' => $userId]);

        $this->load->view('includes/header-link', $data);
        $this->load->view('user_preview');
    }

    public function UserProfileResume()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        // Load library
        $this->load->library('dompdf_gen');

        // Load view HTML content
        $data['title'] = 'User Profile Resume';
        $data['userDetails'] = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => sessionId('freelancer_id')]);
        $freelancerName = $data['userDetails']['name'];
        $country_id = $data['userDetails']['country'];
        $state_id = $data['userDetails']['state'];

        $data['country'] = $this->CommonModal->getSingleRowById('tbl_countries', ['id' => $country_id]);
        $data['state'] = $this->CommonModal->getSingleRowById('tbl_states', ['id' => $state_id]);
        $data['AgeBlocks'] = $this->CommonModal->getRowByIdInOrder('tbl_age_blocks', ['user_id' => sessionId('freelancer_id')], 'id', 'ASC');

        $imagePath = FCPATH . 'uploads/user_profile/' . $data['userDetails']['user_image'];

        if (file_exists($imagePath)) {
            $imgData = base64_encode(file_get_contents($imagePath));
            $mimeType = mime_content_type($imagePath); // e.g. image/png, image/jpeg
            $data['userDetails']['image_base64'] = 'data:' . $mimeType . ';base64,' . $imgData;
        } else {
            $data['userDetails']['image_base64'] = '';
        }

        $html = $this->load->view('user_profile_resume_pdf.php', $data, true);

        // Setup dompdf
        $this->dompdf_gen->loadHtml($html);
        $this->dompdf_gen->setPaper('A4', 'portrait');
        $this->dompdf_gen->render();

        // Output to browser
        $this->dompdf_gen->stream("$freelancerName'_Profile_Resume.pdf", array("Attachment" => 0)); // 1 = download
    }

    public function brick_pdf(){
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $brickId = $this->input->get('brick_id');
        
        if ($brickId) {
            $data['bricks'] = $this->CommonModal->getSingleRowById('bricks', ['id' => $brickId]);
            $data['bricksFunding'] = $this->CommonModal->getSingleRowById('brick_funding', ['brick_id' => $brickId]);
            $data['bricksSkills'] = $this->CommonModal->getSingleRowById('brick_skills', ['brick_id' => $brickId]);
            $data['companyDetails'] = $this->CommonModal->getSingleRowById('companies', ['id' => $data['bricks']['company_id'], 'status' => 'Active']);
            $data['projectDetails'] = $this->CommonModal->getSingleRowById('projects', ['id' => $data['bricks']['project_id']]);
            $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder('tbl_teamcompanymember', ['brick_id' => $brickId, 'member_id !=' => sessionId('freelancer_id')], 'id', 'DESC', ['department_id IS NULL']);
            $data['brickNonliving'] = $this->CommonModal->getSingleRowById('tbl_brick_nonliving', ['brick_id' => $brickId]);

            $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
                'tbl_teamcompanymember',
                [
                    'brick_id'              => $brickId,
                    // 'member_id !='          => sessionId('freelancer_id'),
                    'department_id IS NULL' => null,
                    'channel_id IS NULL'    => null,
                    'chid IS NULL'          => null,
                    'status' => 'Accepted',
                ],
                'id',
                'DESC'
            );
        }

        $data['title'] = 'Preview Brick';

        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('freelancer_id'),
            'tree_type' => 0,
            'type_id' => $brickId
        ]);
        
        $data['brick_id'] = $brickId;

        // echo "<pre>";
        // print_r($brickDetails); die;
        ob_clean();
        $html = $this->load->view('bricks_pdf', $data, TRUE);
        echo $html; die;
        $this->dompdf_gen->loadHtml($html);
        $this->dompdf_gen->setPaper('A4', 'portrait');
        $this->dompdf_gen->render();

        // Output to browser
        $this->dompdf_gen->stream("$freelancerName'_Profile_Resume.pdf", array("Attachment" => 0));

    }

    public function download_project_pdf()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getID = $this->input->get('id');

        // Load library
        $this->load->library('dompdf_gen');

        // Load view HTML content
        $data['title'] = 'Project Profile PDF';
        $data['projectDetails'] = $this->CommonModal->getSingleRowById('tbl_projects', ['id' => $getID, 'user_id' => sessionId('freelancer_id'), 'project_status' => 'Active']);
        $project_name = $data['projectDetails']['project_name'];
        $project_id = $data['projectDetails']['id'];
        $company_id = $data['projectDetails']['company_id'];

        $data['getBricks'] = $this->CommonModal->getRowsByMultipleWhere('tbl_bricks', ['project_id' => $project_id, 'user_id' => sessionId('freelancer_id'), 'brick_status !=' => 'trash']);
        $data['companyId'] = $this->CommonModal->getSingleRowById('tbl_companies', ['id' => $company_id]);


        $html = $this->load->view('project_profile_resume_pdf.php', $data, true);

        // Setup dompdf
        $this->dompdf_gen->loadHtml($html);
        $this->dompdf_gen->setPaper('A4', 'portrait');
        $this->dompdf_gen->render();

        // Output to browser
        $this->dompdf_gen->stream("$project_name'_Project_Profile.pdf", array("Attachment" => 0)); // 1 = download
    }

    public function update_company_profile()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('ciin_number', 'CIIN Number', 'required|callback_check_unique_cin');
        $this->form_validation->set_rules('dipp_number', 'DIPP Number', 'required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('about_us', 'About Us', 'required');
        $this->form_validation->set_rules('mission', 'Mission', 'required');
        $this->form_validation->set_rules('vision', 'Vision', 'required');
        $this->form_validation->set_rules('valuation', 'Valuation', 'numeric');
        $this->form_validation->set_rules('equity_dilution', 'Equity Dilution', 'numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['profile_progress'] = $this->CompanyModal->get_profile_completion(sessionId('company_id'));
            $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . sessionId('company_id'));
            $this->load->view('includes/header-link', $data);
            $this->load->view('profile_update');
        } else {
            $company_id = $this->session->userdata('company_id');
            $user_id = $this->session->userdata('freelancer_id');

            $postData = [
                'user_id' => $user_id,
                'ciin_number' => $ciin_number,
                'dipp_number' => $dipp_number,
                'pan_number' => $pan_number,
                'tan_number' => $tan_number,
                'gst_number' => $gst_number,
                'company_name' => $company_name,
                'about_us' => $about_us,
                'mission' => $mission,
                'vision' => $vision,
                'valuation' => $valuation,
                'equity_dilution' => $equity_dilution,
            ];

            $update = $this->CommonModal->updateRowById('companies', 'id', $company_id, $postData);

            if ($update) {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-success">Company Created Successfully.</div>');
            } else {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-danger">Something went wrong in, Please try again later.</div>');
            }
            redirect('company/create-company-profile');
        }
    }

    public function posted_task(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = '';
        $data['myBricks'] = $this->CommonModal->getRowByIdInOrder('tasks', ['company_id' => sessionId('company_id')], 'id', 'DESC');
        $data['myCompany'] = $this->CommonModal->getSingleRowById('companies', ['id' => sessionId('company_id'), 'status' => 'Active']);
        $this->load->view('includes/header-link', $data);
        $this->load->view('posted_task');
    }

    public function view_posted($id = null, $title = null)
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = '';
        $data['brickDetails'] = $this->CommonModal->getSingleRowById('tasks', ['id' => $id]);
        $data['companyDetails'] = $this->CommonModal->getSingleRowById('companies', ['id' => $data['brickDetails']['company_id']]);
        $this->load->view('includes/header-link', $data);
        $this->load->view('view_posted');
    }

    public function role_employment(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Create Team';
        $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'transaction_status' => '1', 'status' => 'Active'], 'id', 'DESC');
        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('freelancer_id'),
            'tree_type' => 3,
        ]);
        $this->load->view('includes/header-link', $data);
        $this->load->view('role_employment');
    }

    // public function project_profile(): void
    // {
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }

    //     $company_id = $this->input->get('company_id');
    //     $data['title'] = 'Project Profile';
    //     $this->load->view('includes/header-link', $data);

    //     if($company_id){
    //         $data['getProjects'] = $this->CommonModal->getRowByIdInOrder('projects', [
    //             'user_id' => sessionId('freelancer_id'), 
    //             'transaction_status' => '1', 
    //             'project_status' => 'Active',
    //             'company_id' => $company_id
    //         ], 'id', 'DESC');
    //     }else{
    //         $data['getProjects'] = $this->CommonModal->getRowByIdInOrder('projects', [
    //             'user_id' => sessionId('freelancer_id'), 
    //             'transaction_status' => '1', 
    //             'project_status' => 'Active',
    //         ], 'id', 'DESC');
    //     }

    //     $data['getUser'] = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
    //     $data['getCompanyCount'] = $this->CommonModal->getNumRows('companies', ['user_id' => sessionId('freelancer_id')]);
    //     $data['numOfCountries'] = $this->CommonModal->runQuery("SELECT COUNT(DISTINCT location) AS total_countries FROM tbl_companies WHERE user_id = " . sessionId('freelancer_id'));
    //     // echo "<pre>";
    //     // print_r($data['getProjects']); die;
    //     $this->load->view('project-profile', $data);
    // }

    public function project_profile(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $company_id = $this->input->get('company_id');

        $data['title'] = 'Project Profile';
        $this->load->view('includes/header-link', $data);

        $data['getProjects'] = $this->HomeModal->getProjectsWithTeam($user_id, $company_id);

        $data['getUser'] = $this->CommonModal->getSingleRowById(
            'tbl_freelancer',
            'id = '.$user_id
        );

        $data['getCompanyCount'] = $this->CommonModal->getNumRows(
            'companies',
            ['user_id' => $user_id]
        );

        $data['numOfCountries'] = $this->CommonModal->runQuery(
            "SELECT COUNT(DISTINCT location) AS total_countries 
            FROM tbl_companies 
            WHERE user_id = ".$user_id
        );

        $this->load->view('project-profile', $data);
    }
    
    public function getProjectsWithTeam(){

        $user_id = sessionId('freelancer_id');
        $company_id = $this->input->post('company_id');
        $getProjects = $this->HomeModal->getProjectsWithTeam($user_id, $company_id);
        echo json_encode(['success' => true, 'projects' => $getProjects]);

    }


    public function create_team_member(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = '';
        $this->load->view('create-team-member');
    }

    public function company_preview(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getId = $this->input->get('id');
        $data['title'] = 'Company Preview';
        $company_id = sessionId('company_id');
        if (!empty($getId)) {
            $company_id = $getId;
        }
        $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $company_id);
        $data['getDirectors'] = $this->CommonModal->getRowByIdInOrder('tbl_company_directory', ['company_id' => $company_id], 'id', 'DESC');
        $data['getBanks'] = $this->CommonModal->getRowByIdInOrder('tbl_company_banks', ['company_id' => $company_id], 'id', 'DESC');
        // $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder('tbl_teamcompanymember', ['company_id' => $company_id, 'member_id !=' => sessionId('freelancer_id')], 'id', 'DESC', ['department_id IS NULL' => null ]);

        $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
            'tbl_teamcompanymember',
            [
                'company_id' => $company_id,
                'member_id !=' => sessionId('freelancer_id'),
                'department_id IS NULL' => null,
                'channel_id IS NULL'    => null,
                'chid IS NULL'          => null,
                'status' => 'Accepted',
            ],
            'id',
            'DESC'
        );

        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('freelancer_id'),
            'tree_type' => 2,
            'type_id' => $company_id
        ]);
        
        $data['company_id'] = $company_id;

        $data['is_owner'] = sessionId('freelancer_id') == $data['getProfile']['user_id'];

        $this->load->view('company-preview', $data);
    }

    public function company_team_members() {
        $getId = $this->input->get('id');
        $data['title'] = 'Company Preview';
        $company_id = sessionId('company_id');

        if (!empty($getId)) {
            $company_id = $getId;
        }

        $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $company_id);

        $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
            'tbl_teamcompanymember',
            [
                'company_id' => $company_id,
                'member_id !=' => sessionId('freelancer_id'),
                'department_id IS NULL' => null,
                'channel_id IS NULL'    => null,
                'chid IS NULL'          => null,
                'status' => 'Accepted',
            ],
            'id',
            'DESC'
        );
        // dd($data['getTeamMembers']);

        $this->load->view('company/team-members', $data);
    }

    public function company_added_valuation(){
         
        $getId = $this->input->get('id');
        $data['title'] = 'Company Preview';
        $company_id = sessionId('company_id');
        if (!empty($getId)) {
            $company_id = $getId;
        }
        $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $company_id);
        
        $data['company_id'] = $company_id;

        $this->load->view('company/company_added_valuation', $data);
    }

    public function company_financial_year_reports(){
         
        $getId = $this->input->get('id');
        $data['title'] = 'Company Preview';
        $company_id = sessionId('company_id');
        if (!empty($getId)) {
            $company_id = $getId;
        }
        $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $company_id);
        // dd($data['getProfile']);
        if ($data['getProfile']['founded_year']) {
            $financial_years = $this->getAllFinancialYearsTillDate($data['getProfile']['founded_year']);
            // print_r($financial_years); die;
            if (count($financial_years) > 0) {
                $data['getProfile']['financial_years'] = $financial_years;
            }
        }

        $data['company_id'] = $company_id;

        $financial_reports = $this->CommonModal->getRowsWhere('financial_reports', [
            'company_id' => $company_id
        ]);

        $reportsByYear = [];

        foreach ($financial_reports as $row) {
            $reportsByYear[$row['financial_year']] = $row;
        }

        $data['reportsByYear'] = $reportsByYear;

        // dd($data);

        $this->load->view('company/company_financial_year_reports', $data);
    }

    public function company_cashflow_projection_booking() {
        $company_id = $this->input->get('id');

        $data = [];
        if(!empty($company_id)){
            
            $data['company_id'] = $company_id;

            $data['company_details'] = $this->CommonModal->getRowWhere('companies',[
                'id' => $company_id
            ]);

        }


        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('company/company_cashflow_projection_booking', $data);
        $this->load->view('includes/footer');
    }

    public function company_bid_over_booking() {

        $getId = $this->input->get('id');
        $data['title'] = 'Company Preview';
        $company_id = sessionId('company_id');
        if (!empty($getId)) {
            $company_id = $getId;
        }
        $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $company_id);
        // dd($data['getProfile']);
        if ($data['getProfile']['founded_year']) {
            $financial_years = $this->getAllFinancialYearsTillDate($data['getProfile']['founded_year']);
            // print_r($financial_years); die;
            if (count($financial_years) > 0) {
                $data['getProfile']['financial_years'] = $financial_years;
            }
        }

        $data['company_id'] = $company_id;

        $financial_reports = $this->CommonModal->getRowsWhere('financial_reports', [
            'company_id' => $company_id
        ]);

        $reportsByYear = [];

        foreach ($financial_reports as $row) {
            $reportsByYear[$row['financial_year']] = $row;
        }

        $data['reportsByYear'] = $reportsByYear;

        $this->load->view('company/company_bid_over_booking', $data);
    }

    // function getFinancialYear(string $date): string {
    //     $timestamp = strtotime($date);
    //     $year = date('Y', $timestamp);
    //     $month = date('n', $timestamp); // 1–12

    //     if ($month >= 4) {
    //         return $year . '-' . ($year + 1);
    //     } else {
    //         return ($year - 1) . '-' . $year;
    //     }
    // }

    function getAllFinancialYearsTillDate(string $startDate)
    {
        $years = [];

        $startTimestamp = strtotime($startDate);
        $today = time();

        // Determine starting FY
        $startYear = (int) date('Y', $startTimestamp);
        $startMonth = (int) date('n', $startTimestamp);

        if ($startMonth < 4) {
            $startYear--; // FY started previous year
        }

        // Determine current FY
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        if ($currentMonth < 4) {
            $currentFYEnd = $currentYear;
        } else {
            $currentFYEnd = $currentYear + 1;
        }

        for ($year = $startYear; $year < $currentFYEnd; $year++) {
            $years[] = $year . '-' . ($year + 1);
        }

        return $years;
    }


    public function project_profile_preview(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getId = $this->input->get('id');
        if (empty($getId)) {
            redirect(base_url('company/project-profile'));
        }
        $data['getProject'] = $this->CommonModal->getSingleRowById('projects', 'id = ' . $getId);
        // $data['getCompany'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $data['getProject']['company_id']);
        // $data['getBricks'] = $this->CommonModal->getRowByIdInOrder('tbl_bricks', ['project_id' => $getId], 'id', 'ASC',);
        $data['getBricks'] = $this->CommonModal->getRowByIdInOrder(
            'tbl_bricks',
            [
                'project_id' => $getId,
                'brick_status !=' => 'draft',
                'brick_status !=' => 'trash',
            ],
            'id',
            'ASC'
        );
        $data['brickTypeCount'] = $this->CommonModal->runQuery("SELECT brick_type, COUNT(*) AS brick_count FROM tbl_bricks WHERE project_id = '$getId' GROUP BY brick_type;");
        // $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder('tbl_teamcompanymember', ['project_id' => $getId, 'member_id !=' => sessionId('freelancer_id')], 'id', 'DESC', ['department_id IS NULL']);

        $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
            'tbl_teamcompanymember',
            [
                'project_id'            => $getId,
                'member_id !='          => sessionId('freelancer_id'),
                'department_id IS NULL' => null,
                'channel_id IS NULL'    => null,
                'chid IS NULL'          => null,
                'status' => 'Accepted',
            ],
            'id',
            'DESC'
        );
        if ($data['getProject']['project_start_date']) {
            $financial_years = $this->getAllFinancialYearsTillDate($data['getProject']['project_start_date']);
            // print_r($financial_years); die;
            if (count($financial_years) > 0) {
                $data['getProject']['financial_years'] = $financial_years;
            }
        }
        $data['project_id'] = $this->input->get('id');
        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('freelancer_id'),
            'tree_type' => 1,
            'type_id' => $data['project_id']
        ]);

        $financial_reports = $this->CommonModal->getRowsWhere('financial_reports', [
            'project_id' => $getId
        ]);

        $reportsByYear = [];

        foreach ($financial_reports as $row) {
            $reportsByYear[$row['financial_year']] = $row;
        }

        $data['reportsByYear'] = $reportsByYear;
        $data['is_owner'] = sessionId('freelancer_id') == $data['getProject']['user_id'];
        
        // dd($data);
        // dd($reportsByYear);
        // echo "<pre>";
        // print_r($data['getBricks']);
        // die;
        $this->load->view('includes/header-link', $data);
        $this->load->view('project-profile-preview');
    }

    public function project_team_members(){

        $getId = $this->input->get('id');

        if (empty($getId)) {
            redirect(base_url('company/project-profile'));
        }

        $data['getProject'] = $this->CommonModal->getSingleRowById('projects', 'id = ' . $getId);

        $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
            'tbl_teamcompanymember',
            [
                'project_id'            => $getId,
                'member_id !='          => sessionId('freelancer_id'),
                'department_id IS NULL' => null,
                'channel_id IS NULL'    => null,
                'chid IS NULL'          => null,
                'status' => 'Accepted',
            ],
            'id',
            'DESC'
        );

        $data['perm'] = $this->db->get_where('tbl_permissions_new', [
            'entity_type' => 'project',
            'entity_id'   => $getId,
            'target_team' => 'company'
        ])->row_array();
        // dd($data);
        $this->load->view('includes/header-link', $data);
        $this->load->view('projects/team_members');
    }

    public function getpressreleaseedit()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('project_press_release', ['id' => $id])->row_array();

        if ($data) {
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function getpressreleaseeditcompany()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('company_press_release', ['id' => $id])->row_array();

        if ($data) {
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function getpressreleaseedituser()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('user_press_release', ['id' => $id])->row_array();

        if ($data) {
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function galaxy()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Galaxy';

        $base = base_url('/uploads/user_profile/'); // assumes avatars at /uploads/
        $data['profiles'] = [
            ['id' => 1, 'name' => 'Asha',   'avatar' => $base . '68891c2951e40.jpg'],
            ['id' => 2, 'name' => 'Ravi',   'avatar' => $base . '6867723d95bc9.png'],
            ['id' => 3, 'name' => 'Maya',   'avatar' => $base . '68cd985990fd6.png'],
            ['id' => 4, 'name' => 'Arjun',  'avatar' => $base . '6800eed3dd656.jpg'],
            ['id' => 5, 'name' => 'Neha',   'avatar' => $base . '69175c9915c40.png'],
        ];

        // Optional: define connections as pairs of ids (from -> to)
        $data['connections'] = [
            ['from' => 1, 'to' => 2],
            ['from' => 2, 'to' => 3],
            ['from' => 3, 'to' => 4],
            ['from' => 4, 'to' => 5],
            ['from' => 5, 'to' => 1],
            ['from' => 1, 'to' => 3]
        ];

        $this->load->view('includes/header-link', $data);
        $this->load->view('galaxy_view');
    }

    public function threeDWorld()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = '3D World';
        $this->load->view('includes/header-link', $data);
        $this->load->view('threeD_world_view');
    }

    public function map()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        if($this->input->post()){
            $pin = $this->input->post('pin');
        
            if($this->pin_validation($pin)){
                $data['title'] = 'Map';
                
                $this->load->view('includes/header');
                $this->load->view('includes/header-link', $data);
                $this->load->view('map/map');
                $this->load->view('includes/footer');
                $this->load->view('includes/footer-link');
            }else {
                $this->session->set_flashdata('error', 'Incorrect PIN');
                redirect('company/police-court');                
            }
        }else{
            $this->load->view('includes/header');
            $this->load->view('includes/header-link', $data);
            $this->load->view('pin_validation');
            $this->load->view('includes/footer');
            $this->load->view('includes/footer-link');
        }
    }

    public function school($stream = null, $subject = null)
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'School';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);

        if ($stream && $subject == null) {
            $this->load->view('map/school/' . $stream);
        } elseif ($stream && $subject) {
            if ($subject == 'chemistry') {
                $data['elements'] = $this->CommonModal->getAllRows('elements');
                // echo "<pre>";
                // print_r($data['elements']);
                // var_dump($data['elements']);
                // die;
            }
            $this->load->view('map/' . $stream . '/' . $subject, $data);
        } else {
            $this->load->view('map/school', $data);
        }
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function element($id = null)
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'School';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);

        $data['element'] = $this->CommonModal->getRowById('elements', 'id', $id);
        // print_r($data['element']);
        // die;
        $this->load->view('map/science/element', $data);
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
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
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'School';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        if ($type) {
            $this->load->view('map/degree/' . $type);
        }
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function department()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Department';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('map/industries/department');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function market_research()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Department';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('map/market_research');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function reverse_process()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Reverse Process';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('map/reverse_process');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function language()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Language';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('map/language');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function third_dimension(){
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('map/third_dimension');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function crm()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'CRM';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('crm');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function revenue()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'CRM';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('revenue');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function plant_manufacturing_production()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'CRM';

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('plant-manufacturing-production');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function pin_validation($pin = null){

        if($pin == '007007'){
            return true;
        }else{
            return false;
        }
    }

    public function police_court()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        if($this->input->post()){
            $pin = $this->input->post('pin');
        
            if($this->pin_validation($pin)){
                $data['title'] = 'police_court';

                $this->load->view('includes/header');
                $this->load->view('includes/header-link', $data);
                $this->load->view('police_court');
                $this->load->view('includes/footer');
                $this->load->view('includes/footer-link');
            }else {
                $this->session->set_flashdata('error', 'Incorrect PIN');
                redirect('company/police-court');                
            }
        }else{
            $this->load->view('includes/header');
            $this->load->view('includes/header-link', $data);
            $this->load->view('pin_validation');
            $this->load->view('includes/footer');
            $this->load->view('includes/footer-link');
        }
    }

    public function medical_defence()
    {
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('medical_defence');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function medical_identity()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
            
        $data = [];

        $data['title'] = 'medical identity';

        $freelancer_id = sessionId('freelancer_id');
        
        if ($this->input->method() === 'post') {
            // dd($this->input->post());

            $edit_id = $this->input->post('edit_id');

            date_default_timezone_set('Asia/Kolkata');
            $modified_date = date('Y-m-d H:i:s');

            // All fields
            $fields = [
                'cbc',
                'lft',
                'rft',
                'urine_rm',
                'stool_rm',
                'diabetes_profile',
                'vitamin_b12_d3',
                'thyroid_profile',
                'x_ray',
                'ecg_report',
                'mri_report',
                'ct_scan_report',
                'ultra_sound_report',

                'physical_params',
                'anatomical_params',
                'physiological_params',
                'physiotherapy_params',
                'acupuncture_points_params',
                'geolocation_coordinates',
                'sea_level_params',

                // 🆕 Environment / monitoring
                'pm_levels',
                'o2_level',
                'co2_level',
                'toxic_gases_level',
                'airflow_changes_per_min',
                'camera_feed',
                'negative_pressure_level',
                'positive_pressure_level',
                'opd',
                'ivf_central_lab',
                'general_surgery',
                'robotic_surgery_programming',
                'robots_building_robot',
                'hydration_cell_response',
                'digestion_realtime_monitoring',
                'bowel_movement_tracking',

            ];

            // Fields that use DATETIME (_at)
            $timestampFields = [
                'pm_levels',
                'o2_level',
                'co2_level',
                'toxic_gases_level',
                'airflow_changes_per_min',
                'camera_feed',
                'negative_pressure_level',
                'positive_pressure_level',
                'hydration_cell_response',
                'digestion_realtime_monitoring',
                'bowel_movement_tracking',
            ];

            $medical_identity_data = [
                'user_id'      => $freelancer_id,
                'updated_date' => $modified_date,
            ];

            // Only set created_date on insert
            if (!$edit_id) {
                $medical_identity_data['created_date'] = $modified_date;
            }

            foreach ($fields as $field) {

                $medical_identity_data[$field] = $this->input->post($field);

                if (in_array($field, $timestampFields)) {
                    // DATETIME fields
                    $medical_identity_data[$field . '_at'] =
                        $this->input->post($field . '_at') ?: date('Y-m-d H:i:s');
                } else {
                    // DATE fields
                    $medical_identity_data[$field . '_date'] =
                        $this->input->post($field . '_date');
                }
            }

            if ($edit_id) {
                // --- UPDATE ---
                $update = $this->CommonModal->updateRowById('tbl_medical_identity', 'id', $edit_id, $medical_identity_data);
                $msg = $update ? 'Data Updated Successfully.' : 'Data Update Failed!';
            } else {
                // --- INSERT ---
                $insert = $this->CommonModal->insertRowReturnId('tbl_medical_identity', $medical_identity_data);
                $msg = $insert ? 'Data Added Successfully.' : 'Data Saving Failed!';
            }

            $this->session->set_flashdata('taskMsg', '<div class="alert alert-success">' . $msg . '</div>');
            redirect(base_url('/company/medical-identity'));
        }


        $edit_id = $this->input->get('edit_id');

        $data['editData'] = '';
        
        if ($edit_id) {
            $data['editData'] = $this->CommonModal->getSingleRowById('medical_identity', ['id' => $edit_id]);
        }

        $data['getMedicalReports'] = $this->CommonModal->getAllRows('medical_identity');

        // echo "<pre>";
        // print_r($data['getMedicalReports']); die;
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('medical_identity');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }
    
    public function medical_identity_post(){
        $post_data = [];

        $post_data = $this->input->post();
        $post_data['user_id'] = sessionId('freelancer_id');

        $exists = $this->CommonModal->getNumRows('medical_identity', [
            'user_id' => sessionId('freelancer_id')
        ]);

        $this->CommonModal->insertRow('medical_identity',$post_data);

        redirect('company/medical-identity');
    } 

    public function print_medical_report()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url());
        }

        $report_id = (int) $this->input->get('id');
        $report_type = $this->input->get('type');

        if (!$report_id) {
            show_error('Report ID missing');
        }

        // Fetch medical identity data
        $report = $this->db
            ->where('id', $report_id)
            ->get('medical_identity')   // 👈 your table name
            ->row_array();

        $user = $this->db
            ->where('id', $report['user_id'])
            ->get('freelancer')
            ->row_array();

        // print_r($user_details); die;
        if (!$report) {
            show_error('No medical report found');
        }

        // Pass header/footer image URLs
        $data['report'] = $report;
        $data['user'] = $user;
        $data['report_type'] = $report_type;
        $data['header'] = base_url('assets/report/report_header.jpeg');  // 👈 change path
        $data['footer'] = base_url('assets/report/report_footer.jpeg');  // 👈 change path
        $data['signature'] = base_url('assets/report/director_signature.jpeg');  // 👈 change path

        // Load view as HTML
        $html = $this->load->view('reports/medical_report_print', $data, true);
        // echo $html; die;
        
        // Dompdf
        $this->load->library('dompdf_gen');

        $this->dompdf_gen->loadHtml($html);
        $this->dompdf_gen->setPaper('A4', 'portrait');
        $this->dompdf_gen->render();
        $this->dompdf_gen->stream("Medical_Report_{$user_id}.pdf", ["Attachment" => false]);
    }


    public function getpressrelease()
    {
        // ✅ Always set timezone
        date_default_timezone_set('Asia/Kolkata');

        $id = $this->input->post('id');
        $data = $this->db->get_where('project_press_release', ['id' => $id])->row_array();

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Story not found']);
            return;
        }

        // 🕒 Parse custom date format (e.g., "31-10-2025 11:09:00 PM")
        $created = DateTime::createFromFormat('Y-m-d H:i:s', $data['updated_date']);
        if (!$created) {
            echo json_encode(['success' => false, 'message' => 'Invalid date format']);
            return;
        }

        // 🧮 Determine expiry time based on storytime
        $expiry = clone $created;
        switch ($data['storytime']) {
            case '24h':
            case '1Day':
                $expiry->modify('+1 day');
                break;
            case '1Week':
                $expiry->modify('+1 week');
                break;
            case '1Month':
                $expiry->modify('+1 month');
                break;
            case '6Months':
                $expiry->modify('+6 months');
                break;
            case '1Year':
                $expiry->modify('+1 year');
                break;
            case '5Year':
                $expiry->modify('+5 year');
                break;
            case '10Year':
                $expiry->modify('+10 year');
                break;
            default:
                $expiry->modify('+100 years'); // Lifetime
                break;
        }

        // 🧨 Compare with current time (in Asia/Kolkata)
        $current = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

        if ($current > $expiry) {
            echo json_encode([
                'success' => false,
                'message' => 'This Story has Expired.',
                'expired_at' => $expiry->format('Y-m-d H:i:s')
            ]);
            return;
        }

        // ✅ Still valid
        $data['expires_at'] = $expiry->format('Y-m-d H:i:s');
        $data['is_expired'] = false;

        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getpressreleasecompany()
    {
        // ✅ Always set timezone
        date_default_timezone_set('Asia/Kolkata');

        $id = $this->input->post('id');
        $data = $this->db->get_where('company_press_release', ['id' => $id])->row_array();

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Story not found']);
            return;
        }

        // 🕒 Parse custom date format (e.g., "31-10-2025 11:09:00 PM")
        $created = DateTime::createFromFormat('Y-m-d H:i:s', $data['updated_date']);
        if (!$created) {
            echo json_encode(['success' => false, 'message' => 'Invalid date format']);
            return;
        }

        // 🧮 Determine expiry time based on storytime
        $expiry = clone $created;
        switch ($data['storytime']) {
            case '24h':
            case '1Day':
                $expiry->modify('+1 day');
                break;
            case '1Week':
                $expiry->modify('+1 week');
                break;
            case '1Month':
                $expiry->modify('+1 month');
                break;
            case '6Months':
                $expiry->modify('+6 months');
                break;
            case '1Year':
                $expiry->modify('+1 year');
                break;
            case '5Year':
                $expiry->modify('+5 year');
                break;
            case '10Year':
                $expiry->modify('+10 year');
                break;
            default:
                $expiry->modify('+100 years'); // Lifetime
                break;
        }

        // 🧨 Compare with current time (in Asia/Kolkata)
        $current = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

        if ($current > $expiry) {
            echo json_encode([
                'success' => false,
                'message' => 'This Story has Expired.',
                'expired_at' => $expiry->format('Y-m-d H:i:s')
            ]);
            return;
        }

        // ✅ Still valid
        $data['expires_at'] = $expiry->format('Y-m-d H:i:s');
        $data['is_expired'] = false;

        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getpressreleaseuser()
    {
        // ✅ Always set timezone
        date_default_timezone_set('Asia/Kolkata');

        $id = $this->input->post('id');
        $data = $this->db->get_where('user_press_release', ['id' => $id])->row_array();

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Story not found']);
            return;
        }

        // 🕒 Parse custom date format (e.g., "31-10-2025 11:09:00 PM")
        $created = DateTime::createFromFormat('Y-m-d H:i:s', $data['updated_date']);
        if (!$created) {
            echo json_encode(['success' => false, 'message' => 'Invalid date format']);
            return;
        }

        // 🧮 Determine expiry time based on storytime
        $expiry = clone $created;
        switch ($data['storytime']) {
            case '24h':
            case '1Day':
                $expiry->modify('+1 day');
                break;
            case '1Week':
                $expiry->modify('+1 week');
                break;
            case '1Month':
                $expiry->modify('+1 month');
                break;
            case '6Months':
                $expiry->modify('+6 months');
                break;
            case '1Year':
                $expiry->modify('+1 year');
                break;
            case '5Year':
                $expiry->modify('+5 year');
                break;
            case '10Year':
                $expiry->modify('+10 year');
                break;
            default:
                $expiry->modify('+100 years'); // Lifetime
                break;
        }

        // 🧨 Compare with current time (in Asia/Kolkata)
        $current = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

        if ($current > $expiry) {
            echo json_encode([
                'success' => false,
                'message' => 'This Story has Expired.',
                'expired_at' => $expiry->format('Y-m-d H:i:s')
            ]);
            return;
        }

        // ✅ Still valid
        $data['expires_at'] = $expiry->format('Y-m-d H:i:s');
        $data['is_expired'] = false;

        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    }

    




    public function project_press_release()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $postData = $this->input->post();
        extract($postData);

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        // Validation
        $this->form_validation->set_rules('press_release', 'Press Release', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('company/dashboard');
        } else {
            $user_id = sessionId('freelancer_id');
            $id = $this->input->post('id');

            if (!empty($id)) {
                // -----------------------
                // UPDATE EXISTING RECORD
                // -----------------------
                $updateData = [
                    'press_release' =>  $this->input->post('press_release'),
                    'editordata' =>  $this->input->post('editordata'),
                    'storytime' =>  $this->input->post('storytime'),
                    'updated_date'  =>  $modified_date,
                ];

                $this->db->where('id', $id);
                $update = $this->db->update('project_press_release', $updateData);

                if ($update) {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Release Updated Successfully</div>');
                } else {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to Update Press Release!</div>');
                }
            } else {
                // -----------------------
                // INSERT NEW RECORD
                // -----------------------
                // Get last record for uniq_id
                $lastPressRelease = $this->db
                    ->where('project_id', $project_id)
                    ->where('user_id', $user_id)
                    ->order_by('id', 'DESC')
                    ->limit(1)
                    ->get('project_press_release')
                    ->row_array();

                if (!empty($lastPressRelease) && !empty($lastPressRelease['uniq_id'])) {
                    $lastNumber = (int) str_replace('A - ', '', $lastPressRelease['uniq_id']);
                    $newUniqId = 'A - 00' . ($lastNumber + 1);
                } else {
                    $newUniqId = 'A - 001';
                }

                $insertData = [
                    'project_id'    => $project_id,
                    'user_id'       => $user_id,
                    'press_release' => $press_release,
                    'uniq_id'       => $newUniqId,
                    'created_date'  =>  $modified_date,
                ];

                $insert = $this->CommonModal->insertRowReturnId('project_press_release', $insertData);

                if ($insert) {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Release Added Successfully</div>');
                } else {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to Add Press Release!</div>');
                }
            }

            // Redirect back to project profile preview
            redirect('company/project-profile-preview?id=' . $project_id);
        }
    }

    public function company_press_release()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $postData = $this->input->post();
        extract($postData);

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        // Validation
        $this->form_validation->set_rules('press_release', 'Press Release', 'required');
        $this->form_validation->set_rules('company_id', 'Company ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('company/dashboard');
        } else {
            $user_id = sessionId('freelancer_id');
            $id = $this->input->post('id');

            if (!empty($id)) {
                // -----------------------
                // UPDATE EXISTING RECORD
                // -----------------------
                $updateData = [
                    'press_release' =>  $this->input->post('press_release'),
                    'editordata' =>  $this->input->post('editordata'),
                    'storytime' =>  $this->input->post('storytime'),
                    'press_release_tags' =>  $this->input->post('press_release_tags'),
                    'updated_date'  =>  $modified_date,
                ];

                // print_r($updateData); die;

                $this->db->where('id', $id);
                $update = $this->db->update('company_press_release', $updateData);

                if ($update) {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Release Updated Successfully</div>');
                } else {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to Update Press Release!</div>');
                }
            } else {
                // -----------------------
                // INSERT NEW RECORD
                // -----------------------
                // Get last record for uniq_id
                $lastPressRelease = $this->db
                    ->where('company_id', $company_id)
                    ->where('user_id', $user_id)
                    ->order_by('id', 'DESC')
                    ->limit(1)
                    ->get('company_press_release')
                    ->row_array();

                if (!empty($lastPressRelease) && !empty($lastPressRelease['uniq_id'])) {
                    $lastNumber = (int) str_replace('A - ', '', $lastPressRelease['uniq_id']);
                    $newUniqId = 'A - 00' . ($lastNumber + 1);
                } else {
                    $newUniqId = 'A - 001';
                }

                $insertData = [
                    'company_id'    => $company_id,
                    'user_id'       => $user_id,
                    'press_release' => $press_release,
                    'uniq_id'       => $newUniqId,
                    'created_date'  =>  $modified_date,
                ];
                // print_r($insertData); die;

                $insert = $this->CommonModal->insertRowReturnId('company_press_release', $insertData);

                if ($insert) {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Release Added Successfully</div>');
                } else {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to Add Press Release!</div>');
                }
            }

            // Redirect back to project profile preview
            redirect('company/company-preview?id=' . $company_id);
        }
    }

    public function user_press_release()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $postData = $this->input->post();
        extract($postData);

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        // Validation
        $this->form_validation->set_rules('press_release', 'Press Release', 'required');
        $this->form_validation->set_rules('user_id', 'User ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('company/dashboard');
        } else {
            $user_id = sessionId('freelancer_id');
            $id = $this->input->post('id');
            
            if (!empty($id)) {
                // -----------------------
                // UPDATE EXISTING RECORD
                // -----------------------
                $updateData = [
                    'press_release' =>  $this->input->post('press_release'),
                    'editordata' =>  $this->input->post('editordata'),
                    'storytime' =>  $this->input->post('storytime'),
                    'press_release_tags' =>  $this->input->post('press_release_tags'),
                    'updated_date'  =>  $modified_date,
                ];

                // print_r($updateData); die;

                $this->db->where('id', $id);
                $update = $this->db->update('user_press_release', $updateData);

                if ($update) {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Release Updated Successfully</div>');
                } else {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to Update Press Release!</div>');
                }
            } else {
                // -----------------------
                // INSERT NEW RECORD
                // -----------------------
                // Get last record for uniq_id
                $lastPressRelease = $this->db
                    ->where('user_id', $user_id)
                    ->order_by('id', 'DESC')
                    ->limit(1)
                    ->get('user_press_release')
                    ->row_array();

                if (!empty($lastPressRelease) && !empty($lastPressRelease['uniq_id'])) {
                    $lastNumber = (int) str_replace('A - ', '', $lastPressRelease['uniq_id']);
                    $newUniqId = 'A - 00' . ($lastNumber + 1);
                } else {
                    $newUniqId = 'A - 001';
                }

                $insertData = [
                    'user_id'       => $user_id,
                    'press_release' => $press_release,
                    'uniq_id'       => $newUniqId,
                    'storytime'     => 'lifetime',
                    'created_date'  =>  $modified_date,
                    'updated_date'  =>  $modified_date,
                ];
                // print_r($insertData); die;

                $insert = $this->CommonModal->insertRowReturnId('user_press_release', $insertData);

                if ($insert) {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Release Added Successfully</div>');
                } else {
                    $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to Add Press Release!</div>');
                }
            }

            // Redirect back to project profile preview
            redirect('company/user_profile');
        }
    }
    
    public function get_press_release_date_wise(){

        $data = json_decode($this->input->raw_input_stream, true);

        $type_id = $data['type_id'];
        $type = $data['type'];
        $selected_date = $data['selected_date'];
        $searchValue = $data['searchValue'];
        $context_ai = $data['context_ai'] ?? 0;

        if(!empty($type)){
            $press_release_type_map = [
                'company' => 'company_press_release',
                'project' => 'project_press_release',
                'user' => 'user_press_release'
            ];

            $press_release_id_map = [
                'company' => 'company_id',
                'project' => 'project_id',
                'user' => 'user_id'
            ];

            $where = [];

            if(!empty($type_id)){
                $where += [
                    $press_release_id_map[$type] => $type_id
                ];
            }

            if(!empty($selected_date)) {
                $where += [
                    'created_date >=' => $selected_date,
                    'created_date <'  => date('Y-m-d', strtotime('+1 day', strtotime($selected_date)))
                ];
            }
            
            if(!empty($searchValue)){
                $likes = [
                    'press_release' => $searchValue
                ];
            };

            if (!empty($context_ai)) {
                $likes['press_release_tags'] = $searchValue;
            }
            $press_release = [];

            if(!empty($selected_date)){
                $press_release = $this->CommonModal->getRowsWhere($press_release_type_map[$type], $where, 'created_date DESC');
            }else if(!empty($searchValue)){
                $press_release = $this->CommonModal->getRowByLikesInOrder(
                    $press_release_type_map[$type], 
                    $where,                         
                    $likes,                         
                    'created_date',                 
                    'DESC'
                );
            }

            $res = [
                'success' => true,
                'data' => $press_release
            ];

            echo json_encode($res);

        }else {

            $res = [
                'success' => false,
                'error' => 'Something Went Wrong',
                'type_id' => $type_id,
                'type' => $type,
                'selected_date' => $selected_date
            ];

            echo json_encode($res);
        }
    }

    public function search_press_release(){

        $data = json_decode($this->input->raw_input_stream, true);

        $searchValue = $data['searchValue'];

        if(empty($searchValue)){

            echo $res = [
                'success' => false,
                'msg' => 'no search value'
            ];

        }
        
        $press_releases = $this->HomeModal->search_press_release($searchValue);
        $data['press_releases'] = $press_releases;

        // print_r($data); die;

        $html = $this->load->view('press_release_select_results', $data, true);

        $res = [
            'success' => true,
            'html' => $html
        ];

        echo json_encode($res);
    }




    // Updated by Shiv Web Developer on 04 July 2025
    public function preview_brick()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $brickId = $this->input->get('id');
        if ($brickId) {
            $data['bricks'] = $this->CommonModal->getSingleRowById('bricks', ['id' => $brickId]);
            $data['bricksFunding'] = $this->CommonModal->getSingleRowById('brick_funding', ['brick_id' => $brickId]);
            $data['bricksSkills'] = $this->CommonModal->getSingleRowById('brick_skills', ['brick_id' => $brickId]);
            $data['companyDetails'] = $this->CommonModal->getSingleRowById('companies', ['id' => $data['bricks']['company_id'], 'status' => 'Active']);
            $data['projectDetails'] = $this->CommonModal->getSingleRowById('projects', ['id' => $data['bricks']['project_id']]);
            $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder('tbl_teamcompanymember', ['brick_id' => $brickId, 'member_id !=' => sessionId('freelancer_id')], 'id', 'DESC', ['department_id IS NULL']);
            $data['brickNonliving'] = $this->CommonModal->getSingleRowById('tbl_brick_nonliving', ['brick_id' => $brickId]);

            $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
                'tbl_teamcompanymember',
                [
                    'brick_id'              => $brickId,
                    // 'member_id !='          => sessionId('freelancer_id'),
                    'department_id IS NULL' => null,
                    'channel_id IS NULL'    => null,
                    'chid IS NULL'          => null,
                    'status' => 'Accepted',
                ],
                'id',
                'DESC'
            );
        }

        $data['title'] = 'Preview Brick';

        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => sessionId('freelancer_id'),
            'tree_type' => 0,
            'type_id' => $brickId
        ]);
        
        $data['brick_id'] = $brickId;

        $this->load->view('includes/header-link', $data);
        $this->load->view('preview_brick');
    }


    public function brick_team_members() {

        $brickId = $this->input->get('id');

        $data['brick_id'] = $brickId;

        if ($brickId) {
            $data['bricks'] = $this->CommonModal->getSingleRowById('bricks', ['id' => $brickId]);
            $data['bricksFunding'] = $this->CommonModal->getSingleRowById('brick_funding', ['brick_id' => $brickId]);
            $data['bricksSkills'] = $this->CommonModal->getSingleRowById('brick_skills', ['brick_id' => $brickId]);
            $data['companyDetails'] = $this->CommonModal->getSingleRowById('companies', ['id' => $data['bricks']['company_id'], 'status' => 'Active']);
            $data['projectDetails'] = $this->CommonModal->getSingleRowById('projects', ['id' => $data['bricks']['project_id']]);
            $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder('tbl_teamcompanymember', ['brick_id' => $brickId, 'member_id !=' => sessionId('freelancer_id')], 'id', 'DESC', ['department_id IS NULL']);
            $data['brickNonliving'] = $this->CommonModal->getSingleRowById('tbl_brick_nonliving', ['brick_id' => $brickId]);

            $data['getTeamMembers'] = $this->CommonModal->getRowByIdInOrder(
                'tbl_teamcompanymember',
                [
                    'brick_id'              => $brickId,
                    // 'member_id !='          => sessionId('freelancer_id'),
                    'department_id IS NULL' => null,
                    'channel_id IS NULL'    => null,
                    'chid IS NULL'          => null,
                    'status' => 'Accepted',
                ],
                'id',
                'DESC'
            );
        }

        $data['brickCompanyPerm'] = $this->db->get_where('tbl_permissions_new', [
            'entity_type' => 'brick',
            'entity_id'   => $brickId,
            'target_team' => 'company'
        ])->row_array();

        $data['brickProjectPerm'] = $this->db->get_where('tbl_permissions_new', [
            'entity_type' => 'brick',
            'entity_id'   => $brickId,
            'target_team' => 'project'
        ])->row_array();
        // dd($data['bricks']);
        $this->load->view('includes/header-link', $data);
        $this->load->view('bricks/team-members');
    }

    public function getAddedValuation()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $project_id = $this->input->post('project_id');
        $user_id = sessionId('freelancer_id');

        // Fetch total valuation
        $totalValuation = $this->db->select_sum('addedValuation')
            ->where('project_id', $project_id)
            ->where('user_id', $user_id)
            ->get('tbl_addedvaluation')
            ->row()
            ->addedValuation;

        // Fetch detailed rows
        $getAddedValuation = $this->CommonModal->getRowByIdInOrder(
            'tbl_addedvaluation',
            ['project_id' => $project_id, 'user_id' => $user_id],
            'id',
            'DESC'
        );

        // Prepare rows with brick id
        $rows = [];
        if (!empty($getAddedValuation)) {
            foreach ($getAddedValuation as $valuation) {
                $bricks = $this->CommonModal->getSingleRowById('bricks', ['id' => $valuation['brick_id']]);
                $rows[] = [
                    'brick_id' => generateBrickId($bricks['id']),
                    'addedValuation' => $valuation['addedvaluation'],
                    'created_at' => $valuation['created_at'],
                ];
            }
        }

        echo json_encode([
            'success' => true,
            'totalValuation' => $totalValuation,
            'rows' => $rows
        ]);
    }

    public function getAddedValuationCompany()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id');
        $user_id = sessionId('freelancer_id');

        // Fetch total valuation
        $totalValuation = $this->db->select_sum('addedValuation')
            ->where('company_id', $company_id)
            ->where('user_id', $user_id)
            ->get('tbl_addedvaluation')
            ->row()
            ->addedValuation;

        // Fetch detailed rows
        $projectWiseValuation = $this->db
                                    ->select('project_id, SUM(addedValuation) as totalValuation')
                                    ->from('tbl_addedvaluation')
                                    ->where('company_id', $company_id)
                                    ->where('user_id', $user_id)
                                    ->group_by('project_id')
                                    ->order_by('project_id', 'DESC')
                                    ->get()
                                    ->result_array();

        // Prepare rows with brick id
        $rows = [];
        if (!empty($projectWiseValuation)) {
            foreach ($projectWiseValuation as $valuation) {
                $project = $this->CommonModal->getSingleRowById('projects', ['id' => $valuation['project_id']]);
                $rows[] = [
                    'project_id' => generateProjectId($project['id']),
                    'addedValuation' => $valuation['totalValuation'],
                    'created_at' => $valuation['created_at'],
                ];
            }
        }

        echo json_encode([
            'success' => true,
            'totalValuation' => $totalValuation,
            'rows' => $rows
        ]);
    }

    public function getAddedValuationUser()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');

        // Fetch total valuation
        $totalValuation = $this->db->select_sum('addedValuation')
            ->where('user_id', $user_id)
            ->get('tbl_addedvaluation')
            ->row()
            ->addedValuation;

        // Fetch detailed rows
        $CompanyWiseValuation = $this->db
                                    ->select('
                                        av.company_id,
                                        SUM(av.addedValuation) AS totalValuation,
                                        COUNT(DISTINCT p.id) AS totalProjects,
                                        COUNT(DISTINCT b.id) AS totalBricks
                                    ')
                                    ->from('tbl_addedvaluation av')
                                    ->join('projects p', 'p.company_id = av.company_id', 'LEFT')
                                    ->join('bricks b', 'b.project_id = p.id', 'LEFT')
                                    ->where('av.user_id', $user_id)
                                    ->group_by('av.company_id')
                                    ->order_by('av.company_id', 'DESC')
                                    ->get()
                                    ->result_array();
        // print_r($CompanyWiseValuation); die;
        // Prepare rows with brick id
        $rows = [];
        if (!empty($CompanyWiseValuation)) {
            foreach ($CompanyWiseValuation as $valuation) {
                $rows[] = [
                    'company_id' => generateCompanyId($valuation['company_id']),
                    'addedValuation' => $valuation['totalValuation'],
                    'totalProjects'  => $valuation['totalProjects'],
                    'totalBricks'  => $valuation['totalBricks']
                ];
            }
        }

        echo json_encode([
            'success' => true,
            'totalValuation' => $totalValuation,
            'rows' => $rows
        ]);
    }

    public function brickMarkasCompleted()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $brickId = $this->input->post('brick_id_markas');


        // Check if user has added valuation for this brick
        $check = $this->CommonModal->getSingleRowById(
            'tbl_addedvaluation',
            [
                'brick_id'   => $brickId,
                'user_id'    => sessionId('freelancer_id') // ensure correct freelancer check
            ]
        );

        if ($check) {
            // ✅ Only update brick_completed in tbl_bricks
            $update = $this->CommonModal->updateRowById(
                'tbl_bricks',
                'id',
                $brickId,
                ['brick_completed' => 'completed']
            );

            if ($update) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Brick marked as completed successfully',
                    'redirect_url' => base_url('company/preview_brick?id=' . $brickId)
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to update brick status!'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Please add valuation on this brick before marking as completed'
            ]);
        }
    }




    public function fund_request_for_brick()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('fund_amount', 'Fund Amount', 'required|numeric');
        $this->form_validation->set_rules('fund_percentage', 'Fund Percentage', 'required|numeric');

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {
            $fund_request = [
                'company_id' => $this->input->post('company_id'),
                'funded_by' => sessionId('freelancer_id'),
                'funded_to' => sessionId('freelancer_id'),
                'project_id' => $this->input->post('project_id'),
                'brick_id' => $this->input->post('brick_id'),
                'fund_amount' => $this->input->post('fund_amount'),
                'fund_percentage' => $this->input->post('fund_percentage'),
            ];

            // Insert project data into the database
            $insert = $this->CommonModal->insertRowReturnId('fund_requests', $fund_request);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">fund applied successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Adding Fund!</div>');
            }

            // Redirect to Company Dashboard
            redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        }
    }

    public function add_work_allotment()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('bid_amount', 'Bid Amount', 'required');
        $this->form_validation->set_rules('delivery_time', 'Delivery Time', 'required');

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {
            $workallotment = [
                'company_id' => $this->input->post('company_id'),
                'project_id' => $this->input->post('project_id'),
                'brick_id' => $this->input->post('brick_id'),
                'bid_amount' => $this->input->post('bid_amount'),
                'delivery_time' => $this->input->post('delivery_time'),
                'allotment_by' => sessionId('freelancer_id'),
                'allotment_to' => sessionId('freelancer_id'),
            ];

            // Insert Work Allotment data into the database
            $insert = $this->CommonModal->insertRowReturnId('brick_work_allotment', $workallotment);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Bid applied successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Adding Bidding!</div>');
            }

            // Redirect to Brick Preview
            redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        }
    }


    public function moneywallet_transfer()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('amount', 'Amount Id', 'required');

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }
            redirect('company/dashboard');
        } else {
            $moneywallet = [
                'amount_dr' => $this->input->post('amount'),
                'shared_by' => sessionId('freelancer_id'),
                'status' => 'Dr',
                'shared_to' => '',
            ];

            // Data Transfer to Database
            $insert = $this->CommonModal->insertRowReturnId('money_wallet', $moneywallet);
            if ($insert) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Money Transfer Successfully',
                    'redirect_url' => base_url('company/user_profile')
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to send money!'
                ]);
            }
        }
    }

    public function check_votingrights()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        $this->form_validation->set_rules('votefor', 'Vote For', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            exit;
        }

        $brick_id = $this->input->post('brick_id');
        $user_id = $this->input->post('user_id');
        $votefor = $this->input->post('votefor');

        $where = [
            'brick_id' => $brick_id,
            'funded_by' => $user_id,
            'fund_status' => 'Approve',
        ];



        $votingrights = $this->CommonModal->getSingleRowById('tbl_brick_voting', ['brick_id' => $brick_id]);
        // Investor Rights
        $investorright =  $votingrights['investor'];

        if ($votefor == 'investor') {
            $checkVotingRights = $this->CommonModal->getSingleRowById('tbl_fund_requests', $where);
            if ($checkVotingRights) {
                // $getTotalInvestor = $this->CommonModal->getNumRows('tbl_fund_requests', ['brick_id' => $brick_id, 'fund_status' => 'Approve']);
                $value1 = $checkVotingRights['fund_percentage'];
                $totalRights = $investorright * $value1 / 100;
                $getUserName = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
                $msg = "VoteShare to this brick";
            } else {
                $totalRights = 'N/A';
                $getUserName = '--';
                $msg = "You are Not a Funded Member for VoteShare to this brick";
            }
        } else if ($votefor == 'owner') {
            $whereForOwner = [
                'brick_id' => $brick_id,
                'member_id' => $user_id,
                'status' => 'Accepted',
                'channel_id' => NULL,
                'chid' => NULL,
                'request_tab_id' => NULL
            ];
            // Owner Rights
            $ownerright =  $votingrights['owner'];
            $checkVotingRights = $this->CommonModal->getNumRows('tbl_bricks', ['id' => $brick_id, 'user_id' => $user_id, 'brick_status' => 'preview']);
            if ($checkVotingRights) {
                $OwnerVotingRights = $this->CommonModal->getSingleRowById('tbl_teamcompanymember', $whereForOwner);
                $getTotalOwner = $this->CommonModal->getNumRows('tbl_teamcompanymember', ['brick_id' => $brick_id, 'status' => 'Accepted', 'channel_id' => NULL, 'chid' => NULL, 'request_tab_id' => NULL]);

                if ($OwnerVotingRights) {
                    $getTotalOwnerCount = $checkVotingRights + $getTotalOwner;
                } else {
                    $getTotalOwnerCount = $checkVotingRights;
                }

                $totalRights = $ownerright / $getTotalOwnerCount; // 40 / 2 = 20
                $getUserName = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
                $msg = "VoteShare to this brick";
            } else {
                $totalRights = 'N/A';
                $getUserName = '--';
                $msg = "You are Not a Team Member for VoteShare to this brick";
            }
        } else if ($votefor == 'passer') {
            $whereForPasser = [
                'brick_id' => $brick_id,
                'member_id' => $user_id,
                'status' => 'Accepted',
                'channel_id !=' => NULL,
                'chid !=' => NULL,
                'request_tab_id !=' => NULL
            ];
            // Passer Rights
            $passerRight =  $votingrights['passers'];

            $checkVotingRights = $this->CommonModal->getSingleRowById('tbl_teamcompanymember', $whereForPasser);
            if ($checkVotingRights) {
                $getTotalPasser = $this->CommonModal->getNumRows('tbl_teamcompanymember', ['brick_id' => $brick_id, 'status' => 'Accepted', 'channel_id !=' => NULL, 'chid !=' => NULL, 'request_tab_id !=' => NULL]);
                $totalRights = $passerRight / $getTotalPasser; // 40 / 2 = 20
                $getUserName = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
                $msg = "VoteShare to this brick";
            } else {
                $totalRights = 'N/A';
                $getUserName = '--';
                $msg = "You are Not a Channel Member for VoteShare to this brick";
            }
        } else if ($votefor == 'executer') {
            $whereForExecuter = [
                'brick_id' => $brick_id,
                'allotment_by' => $user_id,
                'status' => 'Accept',
            ];
            // Passer Rights
            $executerRight =  $votingrights['executer'];

            $checkVotingRights = $this->CommonModal->getSingleRowById('tbl_brick_work_allotment', $whereForExecuter);
            if ($checkVotingRights) {
                $getTotalExecuter = $this->CommonModal->getNumRows('tbl_brick_work_allotment', ['brick_id' => $brick_id, 'status' => 'Accept']);
                $totalRights = $executerRight / $getTotalExecuter; // 40 / 2 = 20
                $getUserName = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
                $msg = "VoteShare to this brick";
            } else {
                $totalRights = 'N/A';
                $getUserName = '--';
                $msg = "You are Not a Work Allotment Member for VoteShare to this brick";
            }
        } else if ($votefor == 'other') {
            $whereForOther = [
                'brick_id' => $brick_id,
                'member_id' => $user_id,
                'status' => 'Accepted',
                'channel_id' => NULL,
                'chid' => NULL,
                'request_tab_id' => NULL
            ];

            // Other Rights
            $otherright =  $votingrights['other'];
            $checkVotingRights = $this->CommonModal->getSingleRowById('tbl_teamcompanymember', $whereForOther);

            if ($checkVotingRights) {
                $getTotalOther = $this->CommonModal->getNumRows('tbl_teamcompanymember', ['brick_id' => $brick_id, 'status' => 'Accepted', 'channel_id' => NULL, 'chid' => NULL, 'request_tab_id' => NULL]);

                $totalRights = $otherright / $getTotalOther; // 40 / 2 = 20
                $getUserName = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
                $msg = "VoteShare to this brick";
            } else {
                $totalRights = 'N/A';
                $getUserName = '--';
                $msg = "You are Not a Team Member for VoteShare to this brick";
            }
        } else {
            $totalRights = 'Select Correct Voting Rights';
            $getUserName = '--';
        }

        if ($checkVotingRights) {
            echo json_encode([
                'success' => true,
                'message' => $msg,
                'rights' => $totalRights,
                'votefor' =>  $votefor,
                'votername' => $getUserName['name'],
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $msg,
                'rights' => $totalRights,
                'votefor' =>  $votefor,
                'votername' => $getUserName,
            ]);
        }
    }

    public function brick_voting()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('voted', 'Voting Value', 'required');
        $this->form_validation->set_rules('votefor', 'Vote Form ', 'required');
        $this->form_validation->set_rules('votingrights', 'Voting Rights', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            exit;
        }

        $brick_id = $this->input->post('brick_id');
        $voted = $this->input->post('voted');
        $freelancer_id = sessionId('freelancer_id');
        $votefor = $this->input->post('votefor');
        $votingrights = $this->input->post('votingrights');

        if (!$freelancer_id) {
            echo json_encode([
                'success' => false,
                'message' => 'User not logged in'
            ]);
            exit;
        }

        $data = [
            'brick_id' => $brick_id,
            'voted' => $voted,
            'voting_by' => $freelancer_id,
            'votingrights' =>  $votingrights,
            'votefor' =>  $votefor,
            'status' => 'New'
        ];

        $where = [
            'brick_id' => $brick_id,
            'voting_by' => $freelancer_id
        ];

        $existingVoting = $this->CommonModal->getSingleRowById('tbl_brick_voted', $where);

        if ($existingVoting) {
            $update = $this->CommonModal->updateRowByIdbrick('tbl_brick_voted', $where, $data); // Now only 3 args needed

            echo json_encode([
                'success' => (bool)$update,
                'message' => $update ? 'Voting updated successfully!' : 'Failed to update vote!'
            ]);
            exit;
        } else {
            $insert = $this->CommonModal->insertRowReturnId('tbl_brick_voted', $data);

            echo json_encode([
                'success' => (bool)$insert,
                'message' => $insert ? 'Voting done successfully!' : 'Failed to submit vote!',
                'redirect_url' => base_url('company/preview_brick?id=' . $brick_id)
            ]);
            exit;
        }
    }


    public function add_consultancy_advisory()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_rules('money', 'Money', 'required');
        $this->form_validation->set_rules('consultancy_type', 'consultancy_type', 'required');

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {
            date_default_timezone_set('Asia/Kolkata');
            $modified_date = date('Y-m-d H:i:s');

            $workallotment = [
                'company_id' => $this->input->post('company_id'),
                'project_id' => $this->input->post('project_id'),
                'brick_id' => $this->input->post('brick_id'),
                'message' => $this->input->post('message'),
                'money' => $this->input->post('money'),
                'consultancy_type' => $this->input->post('consultancy_type'),
                'consultancy_by' => sessionId('freelancer_id'),
                'consultancy_to' => sessionId('freelancer_id'),
                'created_at' => $modified_date,
                'updated_at' => $modified_date,
            ];

            // Insert Consultancy data into the database
            $insert = $this->CommonModal->insertRowReturnId('bricks_cosultancy', $workallotment);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Consultancy Applied successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Adding Consultancy!</div>');
            }

            // Redirect to Brick Preview
            redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        }
    }


    public function manage_tasks(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Manage Task';
        $this->load->view('includes/header-link', $data);
        $this->load->view('manage-tasks');
    }

    // public function company_profile(): void
    // {
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }
    //     $data['title'] = 'company Profile';
    //     $this->load->view('includes/header-link', $data);
    //     $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'transaction_status' => '1', 'status' => 'Active'], 'id', 'DESC');
    //     $data['getUser'] = $this->CommonModal->getSingleRowById('tbl_freelancer', 'id = ' . sessionId('freelancer_id'));
    //     $data['getCompanyCount'] = $this->CommonModal->getNumRows('companies', ['user_id' => sessionId('freelancer_id')]);
    //     $data['numOfCountries'] = $this->CommonModal->runQuery("SELECT COUNT(DISTINCT location) AS total_countries FROM tbl_companies WHERE user_id = " . sessionId('freelancer_id'));
    //     $this->load->view('company-profile', $data);
    // }
    
    public function company_profile(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');

        $data['title'] = 'company Profile';
        $this->load->view('includes/header-link', $data);

        $data['getCompanies'] = $this->HomeModal->getCompaniesWithTeam($user_id);
        // dd($data['getCompanies']);
        $data['getUser'] = $this->CommonModal->getSingleRowById(
            'tbl_freelancer',
            'id = '.$user_id
        );

        $data['getCompanyCount'] = $this->CommonModal->getNumRows(
            'companies',
            ['user_id' => $user_id]
        );

        $data['numOfCountries'] = $this->CommonModal->runQuery("
            SELECT COUNT(DISTINCT location) AS total_countries 
            FROM tbl_companies 
            WHERE user_id = $user_id
        ");

        $this->load->view('company-profile', $data);
    }

    public function active_bids(): void
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Active Bids';
        $this->load->view('includes/header-link', $data);
        $this->load->view('active_bids');
    }

    public function manage_bidders()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Mange Bidder';
        $this->load->view('includes/header-link', $data);
        $this->load->view('manage_bidders');
    }

    public function contact_us()
    {
        $data['title'] = 'Contact Us';
        $this->load->view('includes/header-link', $data);
        $this->load->view('contact-us');
    }

    public function setting()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Setting';
        $this->load->view('includes/header-link', $data);
        $this->load->view('setting');
    }

    public function terms_condition()
    {
        $data['title'] = 'Terms condition';
        $this->load->view('includes/header-link', $data);
        $this->load->view('terms-condition');
    }

    public function request_panel()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Request Panel';
        $where = [
            'member_id' => sessionId('freelancer_id'),
            'created_by !=' => sessionId('freelancer_id')
        ];

        $data['getTeamRequest'] = $this->HomeModal->getTeamRequest();
        // dd($data['getTeamRequest']);
        
        // $data['getTeamRequest'] = $this->CommonModal->getRowById('tbl_teamcompanymember', ['member_id' => sessionId('freelancer_id'), 'created_by IS NULL' => null], 'id', 'DESC');
        $data['getAllBrickRequest'] = $this->CommonModal->getRowById('tbl_teamcompanymember', $where, 'id', 'DESC');
        $user_id = sessionId('freelancer_id');
        $data['getAllNetworkRequest'] = $this->HomeModal->getAllIncomingRequests($user_id);
        // dd($data['getAllNetworkRequest']);
        // echo $user_id; die;
        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $this->db->select('
            d.*,
            d.id as dialogue_id,
            cu.id as calendar_user_item_id,
            f_sender.name as sender_name,
            f_sender.user_image as sender_image,
            f_receiver.name as receiver_name
        ');
        $this->db->from('tbl_calendar_dialogue d');
        $this->db->join('tbl_calendar_user cu', 'cu.id = d.timeline_item_id', 'left');

        // 🔥 Sender details
        $this->db->join('freelancer f_sender', 'FIND_IN_SET(f_sender.id, d.from_user_id) > 0', 'left');

        // 🔥 Receiver details
        $this->db->join('freelancer f_receiver', 'f_receiver.id = d.to_user_id', 'left');

        // 🔥 Only requests sent TO this user
        $this->db->where("FIND_IN_SET('$user_id', d.from_user_id) >", 0);

        // 🔥 Pending + Approved + Rejected
        $this->db->where_in('d.dialogue_status', [0, 1, 2]);

        $this->db->order_by('d.created_date', 'DESC');

        $query = $this->db->get();
        $raw = $query->result_array();
        $raw = $query->result_array();

        $grouped = [];

        foreach ($raw as $row) {
            $id = $row['dialogue_id'];

            if (!isset($grouped[$id])) {
                $grouped[$id] = $row;
                $grouped[$id]['senders'] = [];
            }

            if (!empty($row['sender_name'])) {
                $grouped[$id]['senders'][] = [
                    'name'  => $row['sender_name'],
                    'image' => $row['sender_image']
                ];
            }
        }

        $data['getDialogueRequest'] = array_values($grouped);
        
        $companies = $this->CommonModal->getRowsWhere('companies', [
            'user_id' => $user_id
        ]);

        $ids = array_column($companies, 'id');
        // dd($ids);
        // dd($companies);
        // $companies_ids = 

        $data['getAppointmentRequets'] = $this->HomeModal->getAppointments($ids);

        // dd($data['getAppointmentRequets']);
        
        $this->load->view('includes/header-link', $data);
        $this->load->view('request-panel');
    }
    
    public function update_connection_status()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if (!$data || empty($data['request_id']) || empty($data['action'])) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid request'
            ]);
            return;
        }

        $request_id = (int) $data['request_id'];
        $action     = $data['action'];
        $user_id    = sessionId('freelancer_id');

        if (!in_array($action, ['accept', 'reject'])) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid action'
            ]);
            return;
        }

        // Verify request belongs to logged-in user
        $request = $this->db
            ->where('id', $request_id)
            ->where('receiver_id', $user_id)
            ->where('status', 'pending')
            ->get('user_network_connections')
            ->row();

        if (!$request) {
            echo json_encode([
                'status' => false,
                'message' => 'Request not found'
            ]);
            return;
        }

        // Update status
        $new_status = ($action === 'accept') ? 'accepted' : 'rejected';

        $this->db
            ->where('id', $request_id)
            ->update('user_network_connections', [
                'status' => $new_status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        echo json_encode([
            'status'  => true,
            'message' => $action === 'accept'
                ? 'Connection accepted successfully ✅'
                : 'Connection rejected ❌'
        ]);
    }


    public function send_channel_request()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        $this->form_validation->set_rules('created_by', 'Logged Id User Id', 'required');
        $this->form_validation->set_rules('request_tab_id', 'Request Tab Id', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {

            if ($this->input->post('user_id') == sessionId('freelancer_id')) {
                $status = 'Accepted';
            } else {
                $status = 'Requested';
            }
            $workallotment = [
                'company_id' => $this->input->post('company_id'),
                'project_id' => $this->input->post('project_id'),
                'brick_id' => $this->input->post('brick_id'),
                'member_id' => $this->input->post('user_id'),
                'status' => $status,
                'created_by' => $this->input->post('created_by'),
                'request_tab_id' => $this->input->post('request_tab_id'),
            ];

            // Insert Consultancy data into the database
            $insert = $this->CommonModal->insertRowReturnId('teamcompanymember', $workallotment);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Channel Request Send successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Sending Channel Request!</div>');
            }
            // Redirect to Brick Preview
            redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        }
    }
    public function network_marketing_chanel_request()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('created_by', 'Logged In User id ID', 'required');
        $this->form_validation->set_rules('users-list-tags', 'User Id', 'required');
        $this->form_validation->set_rules('channel_id', 'Channel Id', 'required');
        $this->form_validation->set_rules('chid', 'Chid Not Found', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {

            $jsonString = $this->input->post('users-list-tags');  // JSON string from input
            $data = json_decode($jsonString, true);  // Convert JSON to PHP array
            $userIds = [];  // To store only the "value" fields

            if (!empty($data) && is_array($data)) {
                foreach ($data as $item) {
                    if (isset($item['value'])) {
                        $userIds[] = $item['value'];
                    }
                }
            }

            // Convert to comma-separated string if storing in a single DB field
            $memberIdsString = implode(',', $userIds);

            $networkMarketingChannelReq = [
                'company_id' => $this->input->post('company_id'),
                'project_id' => $this->input->post('project_id'),
                'brick_id' => $this->input->post('brick_id'),
                'created_by' => $this->input->post('created_by'),
                'member_id' =>  $memberIdsString,
                'channel_id' => $this->input->post('channel_id'),
                'chid' => $this->input->post('chid'),
                'request_tab_id' => 'network-marketing-request',
            ];

            // Insert Consultancy data into the database
            $insert = $this->CommonModal->insertRowReturnId('teamcompanymember', $networkMarketingChannelReq);
            if ($insert) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Network Marketing Channel Request sent successfully',
                    'redirect_url' => base_url('company/preview_brick?id=' . $this->input->post('brick_id'))
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to send Channel Request!'
                ]);
            }
        }
    }

    public function create_channel_name()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        extract($this->input->post());

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('created_by', 'Logged Id', 'required');
        $this->form_validation->set_rules('channel_id', 'Channel Id', 'required');
        $this->form_validation->set_rules('channel_name', 'Channel Name', 'required');
        $this->form_validation->set_rules('chennel_brick_type', 'Channel Brick Type', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/dashboard');
        } else {

            $channelNameCreate = [
                'channel_id' => $this->input->post('channel_id'),
                'channel_name' => $this->input->post('channel_name'),
                'company_id' => $this->input->post('company_id'),
                'project_id' => $this->input->post('project_id'),
                'brick_id' => $this->input->post('brick_id'),
                'created_by' =>  $this->input->post('created_by'),
                'chennel_brick_type' =>  $this->input->post('chennel_brick_type'),
                'status' => 'New',
            ];

            // Check if channel name already exists
            $where = [
                'channel_id'    => $this->input->post('channel_id'),
                'brick_id'      => $this->input->post('brick_id'),
                'created_by'    => $this->input->post('created_by'),
            ];

            // Check if channel name already exists
            $existingChannel = $this->CommonModal->getSingleRowById('brick_pass_channel', $where);

            // Prepare update/insert data
            $data = [
                'channel_id' => $this->input->post('channel_id'),
                'channel_name' => $this->input->post('channel_name'),
                'chennel_brick_type' => $this->input->post('chennel_brick_type'),
                'brick_id' => $this->input->post('brick_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($existingChannel) {
                // ✅ Update if exists
                $update = $this->CommonModal->updateRowById('brick_pass_channel', 'id', $existingChannel['id'], $data);
                if ($update) {

                    // ✅ Fetch all data based on brick_id & created_by
                    $allChannels = $this->CommonModal->getChannelsByBrickAndCreator(
                        $this->input->post('brick_id'),
                        $this->input->post('created_by')
                    );

                    echo json_encode([
                        'success' => true,
                        'message' => 'Channel updated successfully!',
                        'allChannels' => $allChannels,
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to update channel!'
                    ]);
                }
            } else {

                // Insert Consultancy data into the database
                $insert = $this->CommonModal->insertRowReturnId('brick_pass_channel', $channelNameCreate);
                if ($insert) {

                    // ✅ Fetch all data based on brick_id & created_by
                    $allChannels = $this->CommonModal->getChannelsByBrickAndCreator(
                        $this->input->post('brick_id'),
                        $this->input->post('created_by')
                    );

                    echo json_encode([
                        'success' => true,
                        'message' => 'Channel Created successfully',
                        'allChannels' => $allChannels,
                        'redirect_url' => base_url('company/preview_brick?id=' . $this->input->post('brick_id'))
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to send Channel Request!'
                    ]);
                }
            }
        }
    }


    public function permission()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $brick_id   = $this->input->post('brick_id');
        $checkyes = $this->input->post('checkyes');
        $permission = $this->input->post('permission');
        $company_id = $this->input->post('company_id');
        $project_id = $this->input->post('project_id');

        // ----------------------------
        // Permission flags reset
        // ----------------------------
        $view = $edit = $comment = '';
        if ($permission == 1) {
            $view = 1;
        } elseif ($permission == 2) {
            $edit = 2;
        } elseif ($permission == 3) {
            $comment = 3;
        }

        // ----------------------------
        // Condition 1: Company-based
        // ----------------------------
        if (!empty($company_id) && empty($project_id)) {
            $where = [
                'company_id'     => $company_id,
                'channel_id'     => NULL,
                'chid'           => NULL,
                'status'         => 'Accepted',
                'request_tab_id' => NULL,
            ];
        }

        // ----------------------------
        // Condition 2: Project-based
        // ----------------------------
        elseif (!empty($project_id) && empty($company_id)) {
            $where = [
                'project_id'     => $project_id,
                'channel_id'     => NULL,
                'chid'           => NULL,
                'status'         => 'Accepted',
                'request_tab_id' => NULL,
            ];
        }

        // Agar dono empty hai to return
        else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request: Company or Project ID required',
            ]);
            return;
        }

        // ----------------------------
        // Fetch members
        // ----------------------------
        $permissionList = $this->CommonModal->getRowByMoreId('tbl_teamcompanymember', $where);

        if (!empty($permissionList)) {
            foreach ($permissionList as $row) {
                $exists = $this->db->get_where('tbl_permissions', [
                    'brick_id' => $brick_id,
                    'user_id'  => $row['member_id']
                ])->row_array();

                $data = [
                    'brick_id'   => $brick_id,
                    'user_id'    => $row['member_id'],
                    'permission' => $checkyes,
                    'view'       => $view,
                    'edit'       => $edit,
                    'comment'    => $comment,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($exists) {
                    // ✅ keep existing IDs if not provided
                    $data['company_id'] = !empty($company_id) ? $company_id : $exists['company_id'];
                    $data['project_id'] = !empty($project_id) ? $project_id : $exists['project_id'];

                    $this->db->where('id', $exists['id']);
                    $this->db->update('tbl_permissions', $data);
                } else {
                    // ✅ for insert: allow only one
                    $data['company_id'] = !empty($company_id) ? $company_id : NULL;
                    $data['project_id'] = !empty($project_id) ? $project_id : NULL;
                    $data['created_at'] = date('Y-m-d H:i:s');

                    $this->CommonModal->insertRowReturnId('tbl_permissions', $data);
                }
            }

            echo json_encode([
                'success' => true,
                'message' => 'Permissions updated successfully',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No Members Found!',
            ]);
        }
    }


    public function taskcompleteupdate()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $post = $this->input->post();

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        // $this->form_validation->set_rules('document', 'document', 'required');
        // $this->form_validation->set_rules('audio', 'audio', 'required');
        // $this->form_validation->set_rules('video', 'video', 'required');
        // $this->form_validation->set_rules('textbox', 'document', 'required');

        $where = [
            'user_id'  => sessionId('freelancer_id'),
            'company_id'  => $this->input->post('company_id'),
            'project_id'  => $this->input->post('project_id'),
            'brick_id'   => $this->input->post('brick_id'),
        ];

        // Check if channel name already exists
        $existingTaskUpdate = $this->CommonModal->getSingleRowById('tbl_task_completion_report', $where);

        // Prepare data (skip empty values so old values remain)
        $data = [];
        foreach (['document', 'audio', 'video', 'textbox'] as $field) {
            if (!empty($post[$field])) {
                $data[$field] = $post[$field];
            }
        }

        if ($existingTaskUpdate) {
            // ✅ Update if exists
            $update = $this->CommonModal->updateRowById('tbl_task_completion_report', 'id', $existingTaskUpdate['id'], $data);

            if ($update) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Task Completion Update, Updated Successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Update Task Completionn Update !</div>');
            }

            // Redirect to Brick Preview
            redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        } else {

            // New insert (all fields allowed, even empty)
            $data = array_merge($where, $data);
            $insert = $this->CommonModal->insertRowReturnId('tbl_task_completion_report', $data);

            if ($insert) {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Task Completion Updated, Added successfully</div>');
            } else {
                $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">Failed to Update Task Completionn Update !</div>');
            }

            // Redirect to Brick Preview
            redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        }
    }

    public function addedValuation()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $post = $this->input->post();

        $this->form_validation->set_rules('company_id', 'Company ID', 'required');
        $this->form_validation->set_rules('project_id', 'Project ID', 'required');
        $this->form_validation->set_rules('brick_id', 'Brick ID', 'required');
        $this->form_validation->set_rules('currency', 'currency', 'required');
        $this->form_validation->set_rules('addedvaluation', 'addedvaluation', 'required');

        $where = [
            'user_id'  => sessionId('freelancer_id'),
            'company_id'  => $this->input->post('company_id'),
            'project_id'  => $this->input->post('project_id'),
            'brick_id'   => $this->input->post('brick_id'),
        ];

        // Check if Add valuation already exists
        $existingAddedValuation = $this->CommonModal->getSingleRowById('tbl_addedvaluation', $where);

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');


        $data = [
            'user_id'  => sessionId('freelancer_id'),
            'company_id'  => $this->input->post('company_id'),
            'project_id'  => $this->input->post('project_id'),
            'brick_id'   => $this->input->post('brick_id'),
            'currency'  => $this->input->post('currency'),
            'addedvaluation'   => $this->input->post('addedvaluation'),
            'created_at' => $modified_date,
            'updated_at' => $modified_date,
        ];

        if ($existingAddedValuation) {
            // ✅ Update if exists
            $update = $this->CommonModal->updateRowById('tbl_addedvaluation', 'id', $existingAddedValuation['id'], $data);

            if ($update) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Addded Valuation, Updated Successfully',
                    'redirect_url' => base_url('company/preview_brick?id=' . $this->input->post('brick_id'))
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to Updating, Added Valuation',
                ]);
            }

            // Redirect to Brick Preview
            // redirect('company/preview_brick?id=' . $this->input->post('brick_id'));

        } else {

            $insert = $this->CommonModal->insertRowReturnId('tbl_addedvaluation', $data);
            if ($insert) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Addded Valuation, Addedd Successfully',
                    'redirect_url' => base_url('company/preview_brick?id=' . $this->input->post('brick_id'))
                ]);
            } else {

                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to Updating, Added Valuation',
                ]);
            }

            // Redirect to Brick Preview
            // redirect('company/preview_brick?id=' . $this->input->post('brick_id'));
        }
    }



    public function get_all_channel_on_create()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $brick_id = $this->input->post('brick_id');
        $created_by = $this->input->post('created_by');

        $channels = $this->CommonModal->getChannelsByBrickAndCreator($brick_id, $created_by);

        echo json_encode([
            'success' => true,
            'allChannels' => $channels,
        ]);
    }


    public function channel_sharing()
    {

        $data['title'] = 'Channel Sharing System';
        $channel_id = $this->input->get('chid');
        $data['chid'] = $channel_id;
        $data['channelDetails'] = $this->CommonModal->getSingleRowById('tbl_brick_pass_channel', ['id' => $channel_id]);
        $data['companyDetails'] = $this->CommonModal->getSingleRowById('companies', ['id' => $data['channelDetails']['company_id'], 'status' => 'Active']);
        $data['projectDetails'] = $this->CommonModal->getSingleRowById('projects', ['id' => $data['channelDetails']['project_id']]);


        $this->load->view('includes/header-link', $data);
        $this->load->view('channel_sharing');
    }

    public function privacy_policy()
    {
        $data['title'] = 'Privacy Policy';
        $this->load->view('includes/header-link', $data);
        $this->load->view('privacy-policy');
    }

    public function disclaimer()
    {
        $data['title'] = 'Disclaimer';
        $this->load->view('includes/header-link', $data);
        $this->load->view('disclaimer');
    }

    public function refund()
    {
        $data['title'] = 'Refund Policy';
        $this->load->view('includes/header-link', $data);
        $this->load->view('refund');
    }
    // Updated by Shiv Web Developer on 04 July 2025
    public function management_panel()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data['title'] = 'Management Panel';

        // Search Filter 
        $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'transaction_status' => '1', 'status' => 'Active'], 'id', 'DESC');


        // $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('bricks', ['user_id' => sessionId('freelancer_id') ]);
        // $data['ActiveBricksFundReq'] = $this->CommonModal->getNumRows('fund_requests', ['funded_to' => sessionId('freelancer_id')]);
        // $data['ActiveBricksFundAll'] = $this->CommonModal->getRowByIdInOrder('fund_requests', ['funded_to' => sessionId('freelancer_id')], 'id', 'DESC');

        // Work Allotment
        // $data['workAllotmentRequestcount'] = $this->CommonModal->getNumRows('brick_work_allotment', ['allotment_to' => sessionId('freelancer_id')]);
        // $data['workAllotmentList'] = $this->CommonModal->getRowByIdInOrder('brick_work_allotment', ['allotment_to' => sessionId('freelancer_id')], 'id', 'DESC');

        // Consultancy Advisory
        // $data['BrickConsultacyCount'] = $this->CommonModal->getNumRows('bricks_cosultancy', ['consultancy_to' => sessionId('freelancer_id')]);
        // $data['BrickConsultancyList'] = $this->CommonModal->getRowByIdInOrder('bricks_cosultancy', ['consultancy_to' => sessionId('freelancer_id')], 'id', 'DESC');


        $this->load->view('includes/header-link', $data);
        $this->load->view('management_panel');
    }
    public function fundRequestProcess()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('fund_status', 'Fund Status', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/management_panel');
        } else {
            $fund_status = $this->input->post('fund_status');
            $id = $this->input->post('id');

            $updated = $this->CommonModal->updateRowById('fund_requests', 'id', $id, ['fund_status' => $fund_status]);

            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Fund Status Updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update Fund Status!']);
            }

            redirect('company/management_panel');
        }
    }

    public function workAllotmentRequestProcess()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/management_panel');
        } else {
            $status = $this->input->post('status');
            $id = $this->input->post('id');

            $updated = $this->CommonModal->updateRowById('brick_work_allotment', 'id', $id, ['status' => $status]);

            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Status Updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update Status!']);
            }

            redirect('company/management_panel');
        }
    }

    public function brickConsultancyRequestProcess()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');


        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }

            redirect('company/management_panel');
        } else {
            $status = $this->input->post('status');
            $id = $this->input->post('id');

            $updated = $this->CommonModal->updateRowById('bricks_cosultancy', 'id', $id, ['status' => $status]);

            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Status Updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update Status!']);
            }

            redirect('company/management_panel');
        }
    }

    public function version_delivered()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Version Delivered';
        $this->load->view('includes/header-link', $data);
        $this->load->view('version-delivered');
    }

    public function timestamps()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $brickId = $this->input->get('id');
        $data['timeStamp_bricks'] = $this->CommonModal->getSingleRowById('tbl_bricks', ['id' => $brickId]);

        $data['title'] = 'Time Stamps';
        $this->load->view('includes/header-link', $data);
        $this->load->view('timestamps');
    }

    public function post_task()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        // Set form validation rules
        $this->form_validation->set_rules('brick_privacy', 'Task Privacy', 'required');
        $this->form_validation->set_rules('brick_pass', 'Brick Pass', 'required');
        $this->form_validation->set_rules('brick_type', 'Brick Type', 'required');
        $this->form_validation->set_rules('brick_title', 'Brick Title', 'required');
        // $this->form_validation->set_rules('company_id', 'Company', 'required');
        // $this->form_validation->set_rules('project_id', 'Project', 'required');
        $this->form_validation->set_rules('brick_description', 'Task Description', 'required');
        $this->form_validation->set_rules('reward_disclosed', 'Reward', 'required');
        $this->form_validation->set_rules('estimated_work_delivery_time', 'Work Delivery', 'required');
        $this->form_validation->set_rules('filter_country', 'Country', 'required');
        $this->form_validation->set_rules('filter_state', 'State', 'required');
        // $this->form_validation->set_rules('filter_location', 'Location', 'required');
        // $this->form_validation->set_rules('filter_range', 'Range', 'required');
        $this->form_validation->set_rules('filter_industry', 'Industry', 'required');
        // $this->form_validation->set_rules('filter_industry_type', 'Industry Type', 'required');
        $this->form_validation->set_rules('filter_department', 'Department', 'required');
        // $this->form_validation->set_rules('filter_department_type', 'Department Type', 'required');
        $this->form_validation->set_rules('filter-work', 'Work', 'required');
        $this->form_validation->set_rules('filter_skills', 'Skills', 'required');
        $this->form_validation->set_rules('filter_education', 'Education', 'required');
        $this->form_validation->set_rules('filter_revenue_from', 'Revenue from', 'required');
        $this->form_validation->set_rules('filter_revenue_to', 'Revenue To', 'required');
        // $this->form_validation->set_rules('filter_revenue_type', 'Revenue Type', 'required');
        // $this->form_validation->set_rules('filter_monetization', 'Monetization', 'required');
        // $this->form_validation->set_rules('filter_execution', 'Execution', 'required');
        // $this->form_validation->set_rules('execution_unit', 'Execution Unit', 'required');

        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }
            $data['title'] = 'Create Brick';
            // $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'status' => 'Active'], 'id', 'DESC');
            $data['getCompanies'] = $this->HomeModal->getCompaniesWithTeam(sessionId('freelancer_id'));

            $this->load->view('includes/header-link', $data);
            $this->load->view('post_task', $data);
        } else {
            // Prepare main task data
            $workType = json_decode($_POST['filter-work'], true);
            $workType = array_map(function ($item) {
                return $item['value'];
            }, $workType);

            $filterSkills = json_decode($_POST['filter_skills'], true);
            $filterSkills = array_map(function ($item) {
                return $item['value'];
            }, $filterSkills);

            $filterCountry = json_decode($_POST['filter_country'], true);
            $filterCountry = array_map(function ($item) {
                return $item['value'];
            }, $filterCountry);

            $filterState = json_decode($_POST['filter_state'], true);
            $filterState = array_map(function ($item) {
                return $item['value'];
            }, $filterState);

            $filterIndustry = json_decode($_POST['filter_industry'], true);
            $filterIndustry = array_map(function ($item) {
                return $item['value'];
            }, $filterIndustry);

            $filterDepartment = json_decode($_POST['filter_department'], true);
            $filterDepartment = array_map(function ($item) {
                return $item['value'];
            }, $filterDepartment);


            date_default_timezone_set('Asia/Kolkata');
            $modified_date = date('Y-m-d H:i:s');


            // $task_unique_id = implode('', $this->input->post('task_unique_id'));
            $task_unique_id = 'NA';
            $task_data = [
                'create_date' => $modified_date,
                'brick_privacy' => $this->input->post('brick_privacy'),
                'brick_pass' => $this->input->post('brick_pass'),
                'brick_type' => $this->input->post('brick_type'),
                'brick_title' => $this->input->post('brick_title'),
                'currency_symbol' => $this->input->post('currency_symbol'),
                'company_id' => $this->input->post('company_id'),
                'project_id' => $this->input->post('project_id'),
                'user_id' => sessionId('freelancer_id'),
                'brick_description' =>  $this->security->xss_clean($this->input->post('brick_description', FALSE)),
                'reward_disclosed' => $this->input->post('reward_disclosed'),
                'estimated_work_delivery_time' => $this->input->post('estimated_work_delivery_time'),
                'project_consultancy' => $this->input->post('project_consultancy') ?: 'No',
                'task_unique_id' => $task_unique_id,
                'brick_live' => $this->input->post('brick_live') ?: 'private',
                'accept_investor' => $this->input->post('accept_investor') ?: 'private',
                'work_allotment' => $this->input->post('work_allotment') ?: 'private',
                'work_completion' => $this->input->post('work_completion') ?: 'private',
                'filter_country' => json_encode($filterCountry),
                'filter_state' => json_encode($filterState),
                'filter_location' => $this->input->post('filter_location'),
                'filter_range' => $this->input->post('filter_range'),
                'filter_industry' => json_encode($filterIndustry),
                'filter_industry_type' => $this->input->post('filter_industry_type'),
                'filter_department' => json_encode($filterDepartment),
                'filter_department_type' => $this->input->post('filter_department_type'),
                'filter_work' => json_encode($workType),
                'filter_skills' => json_encode($filterSkills),
                'filter_education' => $this->input->post('filter_education'),
                'filter_revenue_from' => $this->input->post('filter_revenue_from'),
                'filter_revenue_to' => $this->input->post('filter_revenue_to'),
                'filter_revenue_type' => $this->input->post('filter_revenue_type'),
                'filter_monetization' => $this->input->post('filter_monetization'),
                'filter_execution' => $this->input->post('filter_execution'),
                'execution_unit' => $this->input->post('execution_unit'),
                'forpercomp' => $this->input->post('forpercomp'),
                'perpro' => $this->input->post('perpro'),
                'taskdocument' => $this->input->post('taskdocument'),
                'taskvideo' => $this->input->post('taskvideo'),
                'taskaudio' => $this->input->post('taskaudio'),
                'funddocument' => $this->input->post('funddocument'),
                'fundvideo' => $this->input->post('fundvideo'),
                'fundaudio' => $this->input->post('fundaudio'),
                'brick_status' => $_POST['action'],
                'artificialdate' => $this->input->post('artificialdate'),
            ];

            $brick_id = isset($_GET['id']) ? $_GET['id'] : null;
            $is_update = !empty($brick_id);

            if ($is_update) {
                // Update existing task
                $this->CommonModal->updateRowById('tbl_bricks', 'id', $brick_id, $task_data);

                // Delete existing skills and funding to replace with new ones
                $this->CommonModal->deleteRowById('brick_skills', ['brick_id' => $brick_id]);
                $this->CommonModal->deleteRowById('brick_funding', ['brick_id' => $brick_id]);
                $this->CommonModal->deleteRowById('brick_voting', ['brick_id' => $brick_id]);
                $this->CommonModal->deleteRowById('brick_nonliving', ['brick_id' => $brick_id]);
            } else {
                // Insert new task
                $brick_id = $this->CommonModal->insertRowReturnId('tbl_bricks', $task_data);
            }

            if ($brick_id) {
                // Handle dynamic skills
                $skills = $this->input->post('required_skills');

                $skill_data = [
                    'brick_id' => $brick_id,
                    'required_skill' => $skills,
                    'optional_skill' => $this->input->post('skills_optional') ?? null,
                    'required_education' => $this->input->post('education') ?? null,
                    'optional_education' => $this->input->post('education_optional') ?? null,
                    'appeal_statement' => $this->input->post('appeal_statement') ?? null,
                    'experience' => $this->input->post('experience') ?? null
                ];
                $this->CommonModal->insertRow('brick_skills', $skill_data);

                // Handle dynamic funding
                $fund_required = $this->input->post('fund_required');

                $funding_data = [
                    'brick_id' => $brick_id,
                    'fund_required' => $fund_required,
                    'team_min' => $this->input->post('team_min') ?? null,
                    'team_max' => $this->input->post('team_max') ?? null,
                    'appeal_statement' => $this->input->post('appeal_statement') ?? null,
                    'funding_type' => $this->input->post('funding_type') ?? null,
                    'other_funding_type' => $this->input->post('other_funding_type') ?? null,
                    'pre_money_valuation' => $this->input->post('pre_money_valuation') ?? null,
                    'post_money_valuation' => $this->input->post('post_money_valuation') ?? null,
                    'loan_interest_rate' => $this->input->post('loan_interest_rate') ?? null,
                    'task_completion_proof' => $this->input->post('task_completion_proof') ?? null,
                    'barter_deal' => $this->input->post('barter_deal') ?? null
                ];
                $this->CommonModal->insertRow('brick_funding', $funding_data);

                // Shiv Web Developer 17 July 2025
                $investorvotingper = $this->input->post('investorvotingper');
                $votingdata = [
                    'brick_id' => $brick_id,
                    'investor' => $investorvotingper,
                    'owner' => $this->input->post('ownervotingper') ?? null,
                    'passers' => $this->input->post('passersvotingper') ?? null,
                    'executer' => $this->input->post('executervotingper') ?? null,
                    'other' => $this->input->post('othervotingper') ?? null,
                    'status' => 'New',
                ];
                $this->CommonModal->insertRow('brick_voting', $votingdata);


                // Brick Resources - Non Living - Shiv Web Developer 05 October 2025
                $resources_text = $this->input->post('resources_text');
                $brick_nonliving = [
                    'brick_id' => $brick_id,
                    'resources_text' => $resources_text,
                    'resources_financial' => $this->input->post('resources_financial') ?? null,
                    'resources_buyrent' => $this->input->post('resources_buyrent') ?? null,
                    'resourcesdocument' => $this->input->post('resourcesdocument') ?? null,
                    'resourcesvideo' => $this->input->post('resourcesvideo') ?? null,
                    'resourcesaudio' => $this->input->post('resourcesaudio') ?? null,
                    'status' => 'New',
                ];
                $this->CommonModal->insertRow('brick_nonliving', $brick_nonliving);


                // Handle file uploads from form
                $upload_path = 'Uploads/bricks/';
                $file_fields = [
                    'brick_description_files' => 'brick_description',
                    'appeal_statement_files' => 'appeal_statement',
                    'experience_files' => 'experience',
                    'task_completion_proof_files' => 'task_completion_proof',
                    'barter_deal_files' => 'barter_deal'
                ];

                foreach ($file_fields as $field_name => $target_field) {
                    if (!empty($_FILES[$field_name]['name'][0])) {
                        $file_count = count($_FILES[$field_name]['name']);
                        for ($i = 0; $i < $file_count; $i++) {
                            if ($_FILES[$field_name]['error'][$i] == UPLOAD_ERR_OK) {
                                $file = [
                                    'name' => $_FILES[$field_name]['name'][$i],
                                    'type' => $_FILES[$field_name]['type'][$i],
                                    'tmp_name' => $_FILES[$field_name]['tmp_name'][$i],
                                    'error' => $_FILES[$field_name]['error'][$i],
                                    'size' => $_FILES[$field_name]['size'][$i]
                                ];

                                $_FILES['temp_file'] = $file;
                                $filename = imageUpload('temp_file', $upload_path, '');
                                unset($_FILES['temp_file']);

                                if ($filename && file_exists(FCPATH . $upload_path . $filename)) {
                                    $file_data = [
                                        'brick_id' => $brick_id,
                                        'file_type' => $this->getFileType($filename),
                                        'file_path' => $upload_path . $filename,
                                        'target_field' => $target_field
                                    ];
                                    $this->CommonModal->insertRow('brick_files', $file_data);
                                } else {
                                    log_message('error', 'Form file upload failed for: ' . $file['name']);
                                }
                            } else {
                                log_message('error', 'Form file upload error for ' . $_FILES[$field_name]['name'][$i] . ': ' . $_FILES[$field_name]['error'][$i]);
                            }
                        }
                    }
                }

                // Handle temporary files from modal uploads
                $temp_files = $this->session->userdata('temp_files');
                if ($temp_files) {
                    foreach ($temp_files as $file) {
                        $file_data = [
                            'brick_id' => $brick_id,
                            'file_type' => $this->getFileType($file['filename']),
                            'file_path' => $upload_path . $file['filename'],
                            'target_field' => $file['target_field']
                        ];
                        if (file_exists(FCPATH . $file_data['file_path'])) {
                            $this->CommonModal->insertRow('brick_files', $file_data);
                        } else {
                            log_message('error', 'Temp file not found: ' . $file_data['file_path']);
                        }
                    }
                    $this->session->unset_userdata('temp_files');
                }

                $action = $_POST['action'];
                $success_message = $is_update ? 'Brick updated successfully' : 'Brick created successfully';
                $error_message = $is_update ? 'Failed to update Brick' : 'Failed to create Brick';
                $redirect_url = $is_update ? 'company/create-brick?id=' . $brick_id : 'company/create-brick';

                switch ($action) {
                    case 'draft':
                        $this->session->set_userdata('taskMsg', '<div class="alert alert-warning">Brick has been drafted successfully.</div>');
                        redirect(base_url($redirect_url));
                        break;

                    case 'build':
                        $this->session->set_userdata('taskMsg', '<div class="alert alert-success">' . $success_message . '</div>');
                        redirect(base_url($redirect_url));
                        break;

                    case 'preview':
                        $this->session->set_userdata('taskMsg', '<div class="alert alert-success">' . $success_message . '</div>');
                        redirect(base_url('company/preview_brick?id=' . $brick_id));
                        break;

                    default:
                        echo "Invalid action";
                        break;
                }
                exit();
            } else {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-danger">' . $error_message . '</div>');
                redirect(base_url($redirect_url));
            }
        }
    }

    public function uploadFile()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $response = ['success' => false, 'error' => ''];
        $upload_path = 'uploads/bricks';

        // Ensure upload directory exists
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $upload_type = $this->input->post('upload_type');
        $file_field = $upload_type . '_file';

        try {
            // Use the imageUpload function for file upload
            $file_path = imageUpload($file_field, $upload_path, '');

            if ($file_path) {
                $response['success'] = true;
                $response['file_path'] = $file_path;
            } else {
                $response['error'] = 'File upload failed. Please try again.';
            }
        } catch (Exception $e) {
            $response['error'] = 'Upload error: ' . $e->getMessage();
        }

        echo json_encode($response);
    }

    private function getFileType($file_path)
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        if ($ext === 'mp4')
            return 'video';
        if ($ext === 'mp3')
            return 'audio';
        return 'document';
    }

    public function greater_than_field($max_budget)
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $min_budget = $this->input->post('min_budget');

        if ($max_budget > $min_budget) {
            return TRUE;
        } else {
            $this->form_validation->set_message('greater_than_field', 'The Maximum Budget must be greater than the Minimum Budget.');
            return FALSE;
        }
    }


    public function send_company_otp()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $post = json_decode(file_get_contents('php://input'), true);

        if (isset($post['phone'])) {
            $phone = $post['phone'];
            // $user = $this->CommonModal->getRowById('employers', 'email', $email);
            $user = true;
            if ($user) {
                $otp = mt_rand(100000, 999999);
                $this->CommonModal->insertRow('temp_otp', ['contact_no' => $phone, 'otp' => $otp]);
                // $sendEmail = newmail($email, 'CBSPL Employer OTP', $otp . ' is your employer login otp');
                $sendSMS = true;
                if ($sendSMS) {
                    echo json_encode(['success' => true, 'message' => 'OTP has been sent to the phone: <b>' . $phone . '</b> Please check your inbox', 'otp' => $otp]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Something went wrong while sending OTP. Please try again', 'otp' => $otp]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'We couldn\'t find an account with the phone: <b>' . $phone . '</b> Please <a href="' . base_url('company/register') . '">create a new account</a> to proceed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phone not provided']);
        }
    }

    public function verify_company_otp()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['phone']) && isset($post['otp'])) {
            $phone = $post['phone'];
            $userOtp = +$post['otp'];

            $getOtp = $this->CommonModal->getSingleRowByIdInOrder('temp_otp', "contact_no = '$phone'", 'id', 'DESC');
            if ($getOtp && ($getOtp['otp'] == $userOtp)) {

                $get = $this->CommonModal->getSingleRowById('companies', "director_number = '$phone'");
                if ($get) {
                    $user_id = $get['id'];
                    $profile_completed = $get['profile_completed'];
                } else {
                    $companyData['director_number'] = $phone;
                    $user_id = $this->CommonModal->insertRowReturnId('companies', $companyData);
                    $profile_completed = 0; // Profile Incomplete
                }
                $this->CompanyModal->companyLogin($user_id);
                $this->CommonModal->deleteRowById('temp_otp', "contact_no = '$phone'");

                if ($profile_completed == 0) {
                    echo json_encode(['success' => true, 'message' => 'OTP verified successfully', 'redirect' => base_url('company/complete-profile')]);
                } else {
                    echo json_encode(['success' => true, 'message' => 'OTP verified successfully', 'redirect' => base_url('company/dashboard')]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid OTP. Please try again or request a resend OTP']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phone and OTP required']);
        }
    }
    public function company_logout()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $this->session->unset_userdata('freelancer_id');
        redirect(base_url('user/login'));
    }

    public function check_cin_avilability()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['cin_number']) && isset($post['cin_number'])) {
            $cin_number = $post['cin_number'];
            $get = $this->CommonModal->getSingleRowById('companies', "ciin_number = '$cin_number'");
            if ($get) {
                echo json_encode(['exists' => true, 'message' => 'CIN Number already exists. Please enter a different CIN Number.']);
            } else {
                echo json_encode(['exists' => false, 'message' => 'CIN Number is available.']);
            }
        } else {
            echo json_encode(['exists' => false, 'message' => 'CIN Number not provided']);
        }
    }

    public function companyLogin()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['company_type']) && !empty($data['ciin_number']) && !empty($data['country'])) {
            $company_type = $data['company_type'];
            $cin_number = $data['ciin_number'];
            $location = $data['country'];

            $checkCin = $this->CommonModal->getRowByMoreId('companies', ['ciin_number' => $cin_number, 'transaction_status' => '1']);
            if (!empty($checkCin)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Company with CIN <b>$cin_number</b> is already registered."
                ]);
                return;
            }

            $insertData = [
                'company_type' => $company_type,
                'ciin_number' => $cin_number,
                'location' => $location,
                'user_id' => sessionId('freelancer_id'),
                'status' => 'Active',
            ];

            $insert = $this->CommonModal->insertRowReturnId('companies', $insertData);

            $razorpayOrder = $this->create_razorpay_order('111');
            $saveRazorPayId = $this->CommonModal->updateRowById('companies', 'id', $insert, ['razorpay_order_id' => $razorpayOrder['order_id']]);


            // $this->CompanyModal->companyLogin($insert);

            if ($insert) {
                echo json_encode([
                    'status' => 'success',
                    'razorpay_order_id' => $razorpayOrder['order_id'],
                    'amount' => 500 * 100,
                    'currency' => 'INR',
                    'checkout_id' => $insert,
                    'st_razorpay_api_key' => RAZOR_KEY_ID
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Something went wrong during insertion.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'All fields are required.',
                'data' => $data
            ]);
        }
    }

    private function create_razorpay_order($amount)
    {
        try {
            // $api = new Api(RAZOR_KEY_ID, RAZOR_KEY_SECRET);
            $api = new Api(RAZOR_KEY_ID, RAZOR_SECRET_KEY); // ✅ FIXED HERE

            $orderData = [
                'receipt' => 'order_' . time(),
                'amount' => $amount * 100, // Amount in paise
                'currency' => 'INR',
                'payment_capture' => 1,
            ];

            $razorpayOrder = $api->order->create($orderData);

            return [
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount']
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function create_project()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        // Set validation rules for each field

        $this->form_validation->set_rules('selected_company_id', 'Company', 'required|trim');
        $this->form_validation->set_rules('project_name', 'Project Name', 'required|trim');
        // $this->form_validation->set_rules('project_document', 'Project Document', 'callback_file_check');
        // $this->form_validation->set_rules('project_pitch', 'Project Pitch Deck', 'callback_file_check');
        $this->form_validation->set_rules('project_leader', 'Project Leader', 'required');
        $this->form_validation->set_rules('layer_range_from', 'Layer', 'required');
        $this->form_validation->set_rules('layer_range_to', 'Layer', 'required');
        $this->form_validation->set_rules('team_range_from', 'Team', 'required');
        $this->form_validation->set_rules('team_range_to', 'Team', 'required');
        $this->form_validation->set_rules('face_value', 'Face Value', 'required');
        $this->form_validation->set_rules('current_price', 'Current Price', 'required');
        $this->form_validation->set_rules('project_valuation', 'Project Valuation', 'required|numeric');
        $this->form_validation->set_rules('issued_shares', 'Issued Shares', 'required|numeric');
        // $this->form_validation->set_rules('total_layers', 'Total Layers', 'required|numeric');
        $this->form_validation->set_rules('tam', 'Total Expected Collaborator (TAM)', 'required|numeric');
        $this->form_validation->set_rules('sam', 'Serviceable Available Market (SAM)', 'required|numeric');
        $this->form_validation->set_rules('som', 'Serviceable Obtainable Market (SOM)', 'required|numeric');
        $this->form_validation->set_rules('project_overview', 'Project Overview', 'required|min_length[20]|max_length[300]|callback_validate_input');
        $this->form_validation->set_rules('mission', 'Mission', 'required');
        $this->form_validation->set_rules('vision', 'Vision', 'required');

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            if (!sessionId('freelancer_id')) {
                redirect(base_url());
            }
            $data['title'] = 'Create Project';
            $this->load->view('includes/header-link', $data);
            $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'status' => 'Active'], 'id', 'DESC');
            $this->load->view('create-project', $data);
        } else {
            $project_document_url = imageUpload('project_document', 'uploads/project_docs', '');
            $project_pitch_url = imageUpload('project_pitch', 'uploads/project_docs', '');
            $project_data = [
                'company_id' => $this->input->post('selected_company_id'),
                'user_id' => sessionId('freelancer_id'),
                'face_value' => $this->input->post('face_value'),
                'current_price' => $this->input->post('current_price'),
                'project_name' => $this->input->post('project_name'),
                'project_leader' => $this->input->post('project_leader'),
                'project_valuation' => $this->input->post('project_valuation'),
                'issued_shares' => $this->input->post('issued_shares'),
                'tam' => $this->input->post('tam'),
                'sam' => $this->input->post('sam'),
                'som' => $this->input->post('som'),
                'physical_scale' => $this->input->post('physical_scale'),
                'project_overview' => $this->input->post('project_overview'),
                'mission' => $this->input->post('mission'),
                'vision' => $this->input->post('vision'),
                'layer_range_from' => $this->input->post('layer_range_from'),
                'layer_range_to' => $this->input->post('layer_range_to'),
                'team_range_from' => $this->input->post('team_range_from'),
                'team_range_to' => $this->input->post('team_range_to'),
                'project_document' => $project_document_url,
                'project_pitch' => $project_pitch_url,
                'project_status' => 'Active',
            ];

            // Insert project data into the database
            $insert = $this->CommonModal->insertRowReturnId('projects', $project_data);

            $razorpayOrder = $this->create_razorpay_order('51');
            $saveRazorPayId = $this->CommonModal->updateRowById('projects', 'id', $insert, ['razorpay_order_id' => $razorpayOrder['order_id']]);

            if ($razorpayOrder['success']) {
                $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Project Created successfully. Proceed to payment.</div>');
                // redirect('Home/razorpay_checkout?order_id=' . $razorpayOrder['order_id']);

                // Redirect to same controller's method
                redirect('razorpay_checkout?order_id=' . $razorpayOrder['order_id']);
            } else {
                $this->session->set_userdata('projectMsg', '<div class="alert alert-warning">Project created, but payment initialization failed: ' . $razorpayOrder['message'] . '</div>');
            }

            if ($insert) {
                $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Project Created successfully</div>');
            } else {
                $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to create Project</div>');
            }

            // Redirect to project creation page
            redirect('company/create-project');
        }
    }

    public function razorpay_checkout()
    {
        $order_id = $this->input->get('order_id');
        $data['order_id'] = $order_id;
        $data['razorpay_key'] = RAZOR_KEY_ID; // Your Razorpay Key ID
        $data['amount'] = 500; // Example amount in INR
        $this->load->view('razorpay_checkout', $data);
    }

    // Updated 24 July 2025
    public function handle_payment_response()
    {
        $data['title'] = 'Create Company Profile';
        $this->load->view('includes/header-link', $data);
        $this->load->view('create-company-profile');
    }

    // Market Place
    public function market_place()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Market Place';
        $this->load->view('includes/header-link', $data);
        $this->load->view('market_place');
    }

    public function TreeMaking()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $freelancer_id = sessionId('freelancer_id');

        $data['title'] = 'Tree Making';

        $data['trees'] = $this->CommonModal->getRowsWhere('tree', [
            'user_id' => $freelancer_id
        ]);

        $this->load->view('includes/header-link', $data);
        $this->load->view('tree_making');
    }


    public function tree_making_search_filter()
    {

        // Get all filters from GET
        $filters = $this->input->get();

        // Remove empty values
        $activeFilters = array_filter($filters, function ($val) {
            return is_array($val) ? !empty(array_filter($val)) : strlen(trim($val)) > 0;
        });

        if (!empty($activeFilters)) {
            // ✅ If filters are applied, use custom query
            $this->db->select('*');
            $this->db->from('tbl_bricks');
            $this->db->where('brick_privacy', 'public');
            $this->db->where('brick_status !=', 'draft');
            $this->db->where('brick_status !=', 'trash');

            // GLOBALLY SEARCH FILTER FOR BRICKS
            if (!empty($filters['globally_search_filter'])) {
                $keyword = $filters['globally_search_filter'];

                // Get table fields automatically
                $columns = $this->db->list_fields('tbl_bricks');

                $this->db->group_start();
                foreach ($columns as $col) {
                    $this->db->or_like($col, $keyword);
                }
                $this->db->group_end();
            }

            $this->db->order_by('id', 'ASC');
            $data['getBricks'] = $this->db->get()->result_array(); // ✅ arrays
            $data['brickfilterSetup'] = $filters;
        }

        // Return only HTML (for AJAX)
        $this->load->view('search_results', $data);
    }


    public function create_brick_tree()
    {
        $selectedBricks = $this->input->post('mybookbricks'); // array
        $modalBookId = $this->input->post('modalBookId');


        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');


        if (!empty($selectedBricks)) {
            foreach ($selectedBricks as $brickId) {
                // $data = [
                //     'book_id' => $modalBookId,
                //     'brick_id' => $brickId,
                //     'created_date' => $modified_date,
                //     'user_id' => sessionId('freelancer_id'),
                // ];

                // Avoid duplicates (optional)
                // Check for duplicate (book_id + brick_id)
                $exists = $this->db
                    ->where('book_id', $modalBookId)
                    ->where('brick_id', $brickId)
                    ->get('tbl_brick_tree')
                    ->num_rows();

                if ($exists == 0) {
                    $this->db->insert('tbl_brick_tree', [
                        'book_id' => $modalBookId,
                        'brick_id' => $brickId,
                        'created_date' => $modified_date,
                        'user_id' => sessionId('freelancer_id'),
                    ]);
                } else {
                    echo json_encode(['status' => 'success', 'message' => 'Bricks Already Added!']);
                }
            }

            echo json_encode(['status' => 'success', 'message' => 'Bricks saved successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No bricks selected!']);
        }
    }

    public function create_event_tree()
    {
        $selectedEvents = $this->input->post('mymovieevents'); // array
        $modalMovieId = $this->input->post('modalMovieId');


        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');


        if (!empty($selectedEvents)) {
            foreach ($selectedEvents as $eventId) {
                // $data = [
                //     'book_id' => $modalBookId,
                //     'brick_id' => $brickId,
                //     'created_date' => $modified_date,
                //     'user_id' => sessionId('freelancer_id'),
                // ];

                // Avoid duplicates (optional)
                // Check for duplicate (book_id + brick_id)
                $exists = $this->db
                    ->where('movie_id', $modalMovieId)
                    ->where('event_id', $eventId)
                    ->get('tbl_events_tree')
                    ->num_rows();

                if ($exists == 0) {
                    $this->db->insert('tbl_events_tree', [
                        'movie_id' => $modalMovieId,
                        'event_id' => $eventId,
                        'created_date' => $modified_date,
                        'user_id' => sessionId('freelancer_id'),
                    ]);
                } else {
                    echo json_encode(['status' => 'success', 'message' => 'Event Already Added!']);
                }
            }

            echo json_encode(['status' => 'success', 'message' => 'Events saved successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No Event selected!']);
        }
    }

    public function create_myBookName()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url());
            return;
        }

        $this->form_validation->set_rules('makemybookname', 'Make My Book Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('company/dashboard');
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $create_mybookname = [
            'makemybookname' => $this->input->post('makemybookname'),
            'user_id'        => sessionId('freelancer_id'),
            'created_date'   => $modified_date,
        ];

        $insert_id = $this->CommonModal->insertRowReturnId('tbl_makemybook', $create_mybookname);

        if ($insert_id) {

            // Get book with total brick count
            $this->db->select('m.*, COUNT(b.id) AS total_bricks');
            $this->db->from('tbl_makemybook m');
            $this->db->join('tbl_brick_tree b', 'b.book_id = m.id', 'left');
            $this->db->where('m.user_id', sessionId('freelancer_id'));
            $this->db->group_by('m.id');
            $getMakeMyBookName = $this->db->get()->result_array();

            // Also fetch already added bricks (if needed)
            $getAlreadyBricks = $this->CommonModal->getRowsWhere('tbl_brick_tree', [
                'user_id' => sessionId('freelancer_id'),
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'Make My Book Name Created Successfully.',
                'getmakemybookname' => $getMakeMyBookName,
                'getAlreadyBricks' => $getAlreadyBricks,
                'redirect_url' => base_url('company/tree_making'),
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create Make My Book Name!'
            ]);
        }
    }

    public function create_MyMovieName()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url());
            return;
        }

        $this->form_validation->set_rules('makemymoviename', 'Make My Movie Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('company/dashboard');
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $create_mymoviename = [
            'makemymoviename' => $this->input->post('makemymoviename'),
            'user_id'        => sessionId('freelancer_id'),
            'created_date'   => $modified_date,
        ];

        $insert_id = $this->CommonModal->insertRowReturnId('tbl_makemymovie', $create_mymoviename);

        if ($insert_id) {

            // Get book with total brick count
            $this->db->select('mmm.*, COUNT(et.id) AS total_events');
            $this->db->from('tbl_makemymovie mmm');
            $this->db->join('tbl_events_tree et', 'et.movie_id = mmm.id', 'left');
            $this->db->where('mmm.user_id', sessionId('freelancer_id'));
            $this->db->group_by('mmm.id');
            $getMakeMyMovieName = $this->db->get()->result_array();

            // Also fetch already added bricks (if needed)
            $getAlreadyEvents = $this->CommonModal->getRowsWhere('tbl_events_tree', [
                'user_id' => sessionId('freelancer_id'),
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'Make My Movie Created Successfully.',
                'getmakemymoviename' => $getMakeMyMovieName,
                'getAlreadyEvents' => $getAlreadyEvents,
                'redirect_url' => base_url('company/event-management'),
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create Make My Movie Name!'
            ]);
        }
    }

    public function getBricksByBookId()
    {
        $bookId = $this->input->post('book_id');

        if (!$bookId) {
            echo json_encode(['success' => false, 'message' => 'Missing book ID']);
            return;
        }

        // Fetch all brick IDs from tbl_brick_tree
        $brickTree = $this->CommonModal->getRowsWhere('tbl_brick_tree', ['book_id' => $bookId]);

        if (!$brickTree) {
            echo json_encode(['success' => true, 'html' => '<div class="alert alert-info my-5">No Bricks Found</div>']);
            return;
        }

        // Extract all brick IDs
        $brickIds = array_column($brickTree, 'brick_id');

        // Fetch full brick details from tbl_bricks
        $this->db->where_in('id', $brickIds);
        $this->db->where('brick_status !=', 'draft');
        $this->db->where('brick_status !=', 'trash');
        $bricks = $this->db->get('tbl_bricks')->result_array();

        $data['getBricks'] = $bricks;

        // Return ready HTML view (reusing your same design)
        $html = $this->load->view('makemybook_bricks_list', $data, true);

        echo json_encode(['success' => true, 'html' => $html]);
    }

    public function getEventsByMovieId()
    {
        $movieId = $this->input->post('movie_id');

        if (!$movieId) {
            echo json_encode(['success' => false, 'message' => 'Missing movie ID']);
            return;
        }

        // Fetch all brick IDs from tbl_brick_tree
        $eventsTree = $this->CommonModal->getRowsWhere('tbl_events_tree', ['movie_id' => $movieId]);

        if (!$eventsTree) {
            echo json_encode(['success' => true, 'html' => '<div class="alert alert-info my-5">No Events Found</div>']);
            return;
        }

        $eventIds = array_column($eventsTree, 'event_id');
        // print_r($movieIds); die;

        $this->db->where_in('id', $eventIds);
        $this->db->order_by('date', 'ASC');
        $events = $this->db->get('tbl_calendar_timeline_master')->result_array();

        $data['getEvents'] = $events;
        // print_r($data); die;
        // Return ready HTML view (reusing your same design)
        $html = $this->load->view('makemymovie_events_list', $data, true);

        echo json_encode(['success' => true, 'html' => $html]);
    }


    public function getAllMakeMyBooks()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode([
                'success' => false,
                'message' => 'User not logged in'
            ]);
            return;
        }

        $userId = sessionId('freelancer_id');

        // ✅ Fetch all books with total bricks count
        $this->db->select('m.*, COUNT(b.id) AS total_bricks');
        $this->db->from('tbl_makemybook m');
        $this->db->join('tbl_brick_tree b', 'b.book_id = m.id', 'left');
        $this->db->where('m.user_id', $userId);
        $this->db->group_by('m.id');
        $query = $this->db->get();
        $books = $query->result_array();

        if ($books) {
            echo json_encode([
                'success' => true,
                'data' => $books
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No books found'
            ]);
        }
    }

    public function getAllMakeMyMovies()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode([
                'success' => false,
                'message' => 'User not logged in'
            ]);
            return;
        }

        $userId = sessionId('freelancer_id');

        // ✅ Fetch all books with total bricks count
        $this->db->select('mmm.*, COUNT(et.id) AS total_events');
        $this->db->from('tbl_makemymovie mmm');
        $this->db->join('tbl_events_tree et', 'et.movie_id = mmm.id', 'left');
        $this->db->where('mmm.user_id', $userId);
        $this->db->group_by('mmm.id');
        $query = $this->db->get();
        $movies = $query->result_array();

        if ($movies) {
            echo json_encode([
                'success' => true,
                'data' => $movies
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No movies found'
            ]);
        }
    }

    public function marketTracing()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = "Market Tracing";
        $this->load->view('includes/header-link', $data);
        $this->load->view('market_tacing');
    }

    public function trash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        // My Deleted Bricks
        $data['getBricks'] = $this->CommonModal->getRowByMoreId('bricks', ['user_id' => sessionId('freelancer_id'), 'brick_status' => 'trash']);

        // My Deleted Projects
        $data['getProjects'] = $this->CommonModal->getRowByMoreId('tbl_projects', ['user_id' => sessionId('freelancer_id'), 'project_status' => 'trash']);

        // My Deleted Projects
        $data['getCompanies'] = $this->CommonModal->getRowByMoreId('tbl_companies', ['user_id' => sessionId('freelancer_id'), 'status' => 'trash']);


        // My Deleted TRL PHD POST DOC
        $data['gettrlphdpostdoc'] = $this->CommonModal->getRowByMoreId('tbl_trlphdpostdoc', ['user_id' => sessionId('freelancer_id'), 'status' => 'trash']);

        // My Deleted TRL LEVELS
        $data['gettrllevels'] = $this->CommonModal->getRowByMoreId('tbl_trllevels', ['user_id' => sessionId('freelancer_id'), 'status' => 'trash']);

        // My Deleted IP Tech Transfer
        $data['getipTechTransfer'] = $this->CommonModal->getRowByMoreId('tbl_iptech_transfer', ['user_id' => sessionId('freelancer_id'), 'iptech_status' => 'trash']);

        // My Deleted IP Tech Transfer
        $data['getIdeaPay'] = $this->CommonModal->getRowByMoreId('tbl_braindating', ['user_id' => sessionId('freelancer_id'), 'status' => 'trash']);


        $data['title'] = "My Trash";
        $this->load->view('includes/header-link', $data);
        $this->load->view('trash');
    }

    public function brick_trash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $brick_status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_bricks', 'id', $getid, ['brick_status' => $brick_status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function brick_restore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $brick_status = 'build';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_bricks', 'id', $getid, ['brick_status' => $brick_status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }


    // PROJECT TRASH AND RESTORE 
    public function Project_Trash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $project_status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_projects', 'id', $getid, ['project_status' => $project_status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function projectRestore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $project_status = 'Active';
        $project_trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_projects', 'id', $getid, ['project_status' => $project_status, 'trash_date' => $project_trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    // COMPANY TRASH AND RESTORE FUNCTIONALITY
    public function Company_Trash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_companies', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function CompanyRestore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'Active';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_companies', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }


    // trlphdpostdoc_trash TRASH AND RESTORE 
    public function trlphdpostdoc_trash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_trlphdpostdoc', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function trlphdpostdoc_restore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'Active';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_trlphdpostdoc', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function trlphdpostdocDelete()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $Id = $this->input->get('id');
        $deletetrlphdpostdoc = $this->CommonModal->deleteRowById('tbl_trlphdpostdoc', ['id' => $Id]);
        if ($deletetrlphdpostdoc) {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-success"> TRL/PHD Post  Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }



    public function trllevelsPost()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url());
            return;
        }

        $this->form_validation->set_rules('level', 'level', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('sublevel', 'sublevel', 'required');
        $this->form_validation->set_rules('subtitle', 'subtitle', 'required');
        $this->form_validation->set_rules('company_id', 'company_id', 'required');
        $this->form_validation->set_rules('project_id', 'project_id', 'required');
        $this->form_validation->set_rules('docslink', 'docslink', 'required');
        $this->form_validation->set_rules('excellink', 'excellink', 'required');
        $this->form_validation->set_rules('industry', 'industry', 'required');
        $this->form_validation->set_rules('sector', 'sector', 'required');
        $this->form_validation->set_rules('budgeted', 'budgeted', 'required');
        $this->form_validation->set_rules('budgetdtimeline', 'budgetdtimeline', 'required');
        $this->form_validation->set_rules('expenditure', 'expenditure', 'required');
        $this->form_validation->set_rules('expendituretimeline', 'expendituretimeline', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $user_id     = sessionId('freelancer_id');
        $level       = $this->input->post('level');
        $sublevel    = $this->input->post('sublevel');
        $company_id  = $this->input->post('company_id');
        $project_id  = $this->input->post('project_id');

        // 🔍 Step 1: Check if same combination already exists
        $existing = $this->CommonModal->getRowWhere('tbl_trllevels', [
            'user_id'     => $user_id,
            'level'       => $level,
            'sublevel'    => $sublevel,
            'company_id'  => $company_id,
            'project_id'  => $project_id
        ]);

        if ($existing) {
            echo json_encode([
                'success' => false,
                'message' => 'Duplicate entry! This Level and Sublevel combination already exists for this project.'
            ]);
            return;
        }

        // 🧩 Step 2: Insert data if unique
        $insertdata = [
            'user_id'        => $user_id,
            'level'          => $level,
            'title'          => $this->input->post('title'),
            'sublevel'       => $sublevel,
            'subtitle'       => $this->input->post('subtitle'),
            'company_id'     => $company_id,
            'project_id'     => $project_id,
            'docslink'       => $this->input->post('docslink'),
            'excellink'      => $this->input->post('excellink'),
            'industry'       => $this->input->post('industry'),
            'sector'       => $this->input->post('sector'),
            'budgeted'       => $this->input->post('budgeted'),
            'budgetdtimeline'       => $this->input->post('budgetdtimeline'),
            'expenditure'       => $this->input->post('expenditure'),
            'expendituretimeline'       => $this->input->post('expendituretimeline'),
            'description'       => $this->input->post('description'),
            'created_date'   => $modified_date,
            'status'         => 'Active',
            'updated_date'   => '',
        ];

        $insert_id = $this->CommonModal->insertRowReturnId('tbl_trllevels', $insertdata);

        if ($insert_id) {
            echo json_encode([
                'success' => true,
                'message' => 'Technology Readiness Level created successfully.',
                'redirect_url' => base_url('company/trlphdpostdoc'),
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create Technology Readiness Level.'
            ]);
        }
    }

    public function trllevelsTrash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_trllevels', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function trllevelsRestore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'Active';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_trllevels', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function trllevelsDelete()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $Id = $this->input->get('id');
        $deletettrllevels = $this->CommonModal->deleteRowById('tbl_trllevels', ['id' => $Id]);
        if ($deletettrllevels) {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-success"> TRL Levels  Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function trllevelEdit()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $Id = $this->input->get('edit_id');

        $data['title'] = "TRL Level Edit";
        $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'status' => 'Active'], 'id', 'DESC');
        $data['trlleveledit'] = $this->CommonModal->getRowWhere('tbl_trllevels', ['user_id' => sessionId('freelancer_id'), 'id' => $Id]);
        $this->load->view('includes/header-link', $data);
        $this->load->view('trlleveledit', $data);
    }

    public function trllevelsUpdate()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url());
            return;
        }

        $this->form_validation->set_rules('level', 'level', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('sublevel', 'sublevel', 'required');
        $this->form_validation->set_rules('subtitle', 'subtitle', 'required');
        $this->form_validation->set_rules('company_id', 'company_id', 'required');
        $this->form_validation->set_rules('project_id', 'project_id', 'required');
        $this->form_validation->set_rules('docslink', 'docslink', 'required');
        $this->form_validation->set_rules('excellink', 'excellink', 'required');
        $this->form_validation->set_rules('industry', 'industry', 'required');
        $this->form_validation->set_rules('sector', 'sector', 'required');
        $this->form_validation->set_rules('budgeted', 'budgeted', 'required');
        $this->form_validation->set_rules('budgetdtimeline', 'budgetdtimeline', 'required');
        $this->form_validation->set_rules('expenditure', 'expenditure', 'required');
        $this->form_validation->set_rules('expendituretimeline', 'expendituretimeline', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        // ✅ Handle POST
        if ($this->input->method() === 'post') {
            $Id = $this->input->post('id');


            date_default_timezone_set('Asia/Kolkata');
            $modified_date = date('Y-m-d H:i:s');

            $user_id     = sessionId('freelancer_id');
            $level       = $this->input->post('level');
            $sublevel    = $this->input->post('sublevel');
            $company_id  = $this->input->post('company_id');
            $project_id  = $this->input->post('project_id');

            // 🧩 Step 2: Insert data if unique
            $insertdata = [
                'user_id'        => $user_id,
                'level'          => $level,
                'title'          => $this->input->post('title'),
                'sublevel'       => $sublevel,
                'subtitle'       => $this->input->post('subtitle'),
                'company_id'     => $company_id,
                'project_id'     => $project_id,
                'docslink'       => $this->input->post('docslink'),
                'excellink'      => $this->input->post('excellink'),
                'industry'      => $this->input->post('industry'),
                'sector'      => $this->input->post('sector'),
                'budgeted'      => $this->input->post('budgeted'),
                'budgetdtimeline'      => $this->input->post('budgetdtimeline'),
                'expenditure'      => $this->input->post('expenditure'),
                'expendituretimeline'      => $this->input->post('expendituretimeline'),
                'description'      => $this->input->post('description'),
                'status'         => 'Active',
                'updated_date'   => $modified_date,
            ];

            if ($Id) {
                // --- UPDATE ---
                $update = $this->CommonModal->updateRowById('tbl_trllevels', 'id', $Id, $insertdata);
                $msg = $update ? 'Data Updated Successfully.' : 'Data Update Failed!';
            } else {
                $this->session->set_flashdata('taskMsg', '<div class="alert alert-danger">Please fill all required fields properly.</div>');
                redirect(base_url('/company/trllevel-edit?edit_id=' . $Id));
            }

            $this->session->set_flashdata('taskMsg', '<div class="alert alert-success">' . $msg . '</div>');
            redirect(base_url('/company/trlphdpostdoc'));
        };
    }




    public function IdeaPay()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $freelancer_id = sessionId('freelancer_id');

        // ✅ Handle POST
        if ($this->input->method() === 'post') {
            $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('industry', 'Industry is Required', 'required');
            $this->form_validation->set_rules('sector', 'Sector is Required', 'required');
            $this->form_validation->set_rules('moneymakingopportunity', 'Money Making Opportunity is required', 'required');
            $this->form_validation->set_rules('microseductivestatement', 'Microseduct Ivestatement', 'required');

            if ($this->form_validation->run() !== FALSE) {

                date_default_timezone_set('Asia/Kolkata');
                $modified_date = date('Y-m-d H:i:s');

                $IdeaPayData = [
                    'user_id' => $freelancer_id,
                    'industry' => $this->input->post('industry'),
                    'sector' => $this->input->post('sector'),
                    'moneymakingopportunity' => $this->input->post('moneymakingopportunity'),
                    'microseductivestatement' => $this->input->post('microseductivestatement'),
                    'created_date' => $modified_date,
                    'updated_date' => $modified_date,
                ];


                if ($edit_id) {
                    // --- UPDATE ---
                    $update = $this->CommonModal->updateRowById('tbl_braindating', 'id', $edit_id, $IdeaPayData);
                    $msg = $update ? 'Data Updated Successfully.' : 'Data Update Failed!';
                } else {
                    // --- INSERT ---
                    $IdeaPayData['created_date'] = $modified_date;
                    $IdeaPayData['status'] = 'Active';
                    $insert = $this->CommonModal->insertRowReturnId('tbl_braindating', $IdeaPayData);
                    $msg = $insert ? 'Data Added Successfully.' : 'Data Saving Failed!';
                }

                $this->session->set_flashdata('taskMsg', '<div class="alert alert-success">' . $msg . '</div>');
                redirect(base_url('/company/idea'));
            } else {
                $this->session->set_flashdata('taskMsg', '<div class="alert alert-danger">Please fill all required fields properly.</div>');
                redirect(base_url('/company/idea'));
            }
        }

        // ✅ Fetch data for list and edit
        $edit_id = $this->input->get('edit_id');

        $data['editData'] = '';

        if ($edit_id) {
            $data['editData'] = $this->CommonModal->getSingleRowById('tbl_braindating', ['id' => $edit_id]);
        }


        $data['getIdeaPayData'] = $this->CommonModal->getRowByMoreId('tbl_braindating', ['status' => 'Active'], 'id', 'ASC');

        $data['title'] = "Idea's Pay";
        $this->load->view('includes/header-link', $data);
        $this->load->view('idea_pay');
    }


    public function IdeaPayTrash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_braindating', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ideaPay_restore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'Active';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_braindating', 'id', $getid, ['status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ideaPay_Delete()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $Id = $this->input->get('id');
        $deleteIdeaPay = $this->CommonModal->deleteRowById('tbl_braindating', ['id' => $Id]);
        if ($deleteIdeaPay) {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-success"> Brain Dating Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function IpAndTechTransfer()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $edit_id = $this->input->get('edit_id'); // 👈 check if edit mode

        // -------------------------
        // ⭐ POST REQUEST - Add/Update
        // -------------------------
        if ($this->input->method() === 'post') {

            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('ipnumber', 'IP Number', 'required');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('fillingdate', 'Filling Date', 'required');
            $this->form_validation->set_rules('publisheddate', 'Published Date', 'required');
            $this->form_validation->set_rules('granteddate', 'Granted Date', 'required');
            $this->form_validation->set_rules('expirydate', 'Expiry Date', 'required');
            $this->form_validation->set_rules('humantoken', 'Human Token', 'required');
            $this->form_validation->set_rules('priceminrange', 'Price Min Range', 'required');
            $this->form_validation->set_rules('pricemaxrange', 'Price Max Range', 'required');
            $this->form_validation->set_rules('potentialmarket', 'Potential Market', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run()) {

                // FILE UPLOAD
                $upload_path = FCPATH . 'uploads/iptechagreement/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $agreement_file = $this->input->post('old_agreement'); // default = previous value

                if (!empty($_FILES['agreement']['name'])) {
                    $uploaded_name = resumeUpload('agreement', $upload_path);

                    if ($uploaded_name) {
                        $agreement_file = 'uploads/iptechagreement/' . $uploaded_name;
                    } else {
                        $this->session->set_flashdata(
                            'taskMsg',
                            '<div class="alert alert-danger">Agreement Upload Failed.</div>'
                        );
                        redirect(current_url());
                    }
                }

                date_default_timezone_set('Asia/Kolkata');
                $currentDate = date('Y-m-d H:i:s');

                $ipTechTransfer = [
                    'user_id'          => sessionId('freelancer_id'),
                    'country'          => $this->input->post('country'),
                    'ipnumber'         => $this->input->post('ipnumber'),
                    'title'            => $this->input->post('title'),
                    'status'           => $this->input->post('status'),
                    'fillingdate'      => $this->input->post('fillingdate'),
                    'publisheddate'    => $this->input->post('publisheddate'),
                    'granteddate'      => $this->input->post('granteddate'),
                    'expirydate'       => $this->input->post('expirydate'),
                    'humantoken'       => $this->input->post('humantoken'),
                    'priceminrange'    => $this->input->post('priceminrange'),
                    'pricemaxrange'    => $this->input->post('pricemaxrange'),
                    'potentialmarket'  => $this->input->post('potentialmarket'),
                    'agreement'        => $agreement_file,
                    'agreementlink'    => $this->input->post('agreementlink'),
                    'description'      => $this->input->post('description'),
                    'iptech_status'    => 'Active',
                ];

                // CHECK INSERT OR UPDATE
                if ($edit_id) {
                    // UPDATE
                    $ipTechTransfer['updated_date'] = $currentDate;

                    $this->CommonModal->updateRowById('tbl_iptech_transfer', 'id', $edit_id, $ipTechTransfer);

                    $this->session->set_flashdata(
                        'taskMsg',
                        '<div class="alert alert-success">Updated Successfully!</div>'
                    );
                } else {
                    // INSERT
                    $ipTechTransfer['created_date'] = $currentDate;
                    $ipTechTransfer['updated_date'] = '';

                    $this->CommonModal->insertRowReturnId('tbl_iptech_transfer', $ipTechTransfer);

                    $this->session->set_flashdata(
                        'taskMsg',
                        '<div class="alert alert-success">Created Successfully!</div>'
                    );
                }

                redirect(base_url('company/ip-and-tech-transfer'));
            } else {
                $this->session->set_flashdata(
                    'taskMsg',
                    '<div class="alert alert-danger">Please fill all fields.</div>'
                );
                redirect(current_url());
            }
        }

        // -------------------------
        // ⭐ PAGE LOAD (GET request)
        // -------------------------

        // If edit mode, load the row
        if ($edit_id) {
            $data['editData'] = $this->CommonModal->getSingleRowById('tbl_iptech_transfer', 'id = ' . $edit_id);
        } else {
            $data['editData'] = null;
        }

        $data['getCountries'] = $this->CommonModal->getAllRowsInOrder('countries', 'name', 'ASC');

        // Load all data list
        $data['getIpTechTransfer'] = $this->CommonModal->getRowByMoreId(
            'tbl_iptech_transfer',
            ['iptech_status' => 'Active'],
        );
        // print_r($data['getIpTechTransfer']); die;
        $data['getProfile'] = $this->CommonModal->getSingleRowById(
            'tbl_freelancer',
            'id = ' . sessionId('freelancer_id')
        );

        $data['title'] = "IP & Tech Transfer";

        $this->load->view('includes/header-link', $data);
        $this->load->view('ip_tech_transfer', $data);
    }

    public function ipTechTransfer_trash()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'trash';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_iptech_transfer', 'id', $getid, ['iptech_status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ipTechTransfer_restore()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $getid = $this->input->get('id');
        $status = 'Active';
        $trash_date = $modified_date;

        $update = $this->CommonModal->updateRowById('tbl_iptech_transfer', 'id', $getid, ['iptech_status' => $status, 'trash_date' => $trash_date]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ipTechTransfer_Delete()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $Id = $this->input->get('id');
        $deletettrllevels = $this->CommonModal->deleteRowById('tbl_iptech_transfer', ['id' => $Id]);
        if ($deletettrllevels) {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-success"> IP & Tech Transfer Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('taskMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function trlphdpostdoc()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $freelancer_id = sessionId('freelancer_id');
        $upload_path = FCPATH . 'uploads/trlphdpostdoc/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // ✅ Handle POST
        if ($this->input->method() === 'post') {
            $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('publishername', 'Publisher Name', 'required');
            $this->form_validation->set_rules('publisherrating', 'Publisher Rating', 'required');
            $this->form_validation->set_rules('publishedbyanyagencylink', 'Published by Any Agency Link', 'required');
            $this->form_validation->set_rules('executive_summary', 'Executive Summary', 'required');
            $this->form_validation->set_rules('core_documentslink', 'Core Documents Link', 'required');
            $this->form_validation->set_rules('custom_indexlink', 'Custom Index Link', 'required');
            $this->form_validation->set_rules('trl_levelslink', 'TRL Levels Link', 'required');
            $this->form_validation->set_rules('calendar_basis_brickslinks', 'Calendar Basis Bricks Links', 'required');
            $this->form_validation->set_rules('projectthesislinks', 'Project Thesis Links', 'required');
            $this->form_validation->set_rules('cititation', 'Citation', 'required');
            $this->form_validation->set_rules('biblography', 'Bibliography', 'required');

            if ($this->form_validation->run() !== FALSE) {
                // === File Upload Map ===
                $fileMap = [
                    'by_anyagency' => 'by_anyagency',
                    'project_component' => 'project_component',
                    'core_documents' => 'core_documents',
                    'custom_index' => 'custom_index',
                    'trl_levels' => 'trl_levels',
                    'calendar_basis_bricks' => 'calendar_basis_bricks',
                    'project_thesis' => 'project_thesis'
                ];

                $uploadedFiles = [];
                foreach ($fileMap as $inputName => $dbField) {
                    if (!empty($_FILES[$inputName]['name'])) {
                        $uploaded = resumeUpload($inputName, $upload_path);
                        if ($uploaded) {
                            $uploadedFiles[$dbField] = 'uploads/trlphdpostdoc/' . $uploaded;
                        } else {
                            $this->session->set_flashdata('taskMsg', '<div class="alert alert-danger">'
                                . ucfirst(str_replace('_', ' ', $inputName)) . ' Upload Failed: Invalid path or file type.</div>');
                            redirect(base_url('/company/trlphdpostdoc'));
                        }
                    }
                }

                date_default_timezone_set('Asia/Kolkata');
                $modified_date = date('Y-m-d H:i:s');

                $trlData = [
                    'user_id' => $freelancer_id,
                    'publishername' => $this->input->post('publishername'),
                    'publisherrating' => $this->input->post('publisherrating'),
                    'publishedbyanyagencylink' => $this->input->post('publishedbyanyagencylink'),
                    'executive_summary' => $this->input->post('executive_summary'),
                    'core_documentslink' => $this->input->post('core_documentslink'),
                    'custom_indexlink' => $this->input->post('custom_indexlink'),
                    'trl_levelslink' => $this->input->post('trl_levelslink'),
                    'calendar_basis_brickslinks' => $this->input->post('calendar_basis_brickslinks'),
                    'projectthesislinks' => $this->input->post('projectthesislinks'),
                    'cititation' => $this->input->post('cititation'),
                    'biblography' => $this->input->post('biblography'),
                    'updated_date' => $modified_date,
                ];

                // ✅ Merge uploaded files
                $trlData = array_merge($trlData, $uploadedFiles);

                if ($edit_id) {
                    // --- UPDATE ---
                    $update = $this->CommonModal->updateRowById('tbl_trlphdpostdoc', 'id', $edit_id, $trlData);
                    $msg = $update ? 'Data Updated Successfully.' : 'Data Update Failed!';
                } else {
                    // --- INSERT ---
                    $trlData['created_date'] = $modified_date;
                    $trlData['status'] = 'Active';
                    $insert = $this->CommonModal->insertRowReturnId('tbl_trlphdpostdoc', $trlData);
                    $msg = $insert ? 'Data Added Successfully.' : 'Data Saving Failed!';
                }

                $this->session->set_flashdata('taskMsg', '<div class="alert alert-success">' . $msg . '</div>');
                redirect(base_url('/company/trlphdpostdoc'));
            } else {
                $this->session->set_flashdata('taskMsg', '<div class="alert alert-danger">Please fill all required fields properly.</div>');
                redirect(base_url('/company/trlphdpostdoc'));
            }
        }

        // ✅ Fetch data for list and edit
        $edit_id = $this->input->get('edit_id');
        $data['editData'] = '';
        if ($edit_id) {
            $data['editData'] = $this->CommonModal->getSingleRowById('tbl_trlphdpostdoc', ['id' => $edit_id]);
        }


        $data['title'] = "PCT IPR / Translational Research Panel / PHD / POST DOC";
        $data['gettrlphdpostdocpost'] = $this->CommonModal->getRowByMoreId('tbl_trlphdpostdoc', ['user_id' => $freelancer_id, 'status' => 'Active'], 'id', 'ASC');
        $data['gettrllevels'] = $this->CommonModal->getRowByMoreId('tbl_trllevels', ['user_id' => $freelancer_id, 'status' => 'Active'], 'id', 'ASC');
        $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'status' => 'Active'], 'id', 'DESC');

        $this->load->view('includes/header-link', $data);
        $this->load->view('trlphdpostdoc', $data);
    }





    public function BuyRent()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = "Buy / Rent";
        $this->load->view('includes/header-link', $data);
        $this->load->view('buy_rent');
    }


    public function ArtificalFamily()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = "Artificial Family";
        $this->load->view('includes/header-link', $data);
        $this->load->view('artificialfamily');
    }


    public function participate_bricks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Participate Bricks';
        $this->load->view('includes/header-link', $data);
        $this->load->view('participate_bricks');
    }

    public function preview_project()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Preview Project';
        $this->load->view('includes/header-link', $data);
        $this->load->view('preview_project');
    }

    public function project_visualization()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Project Visualization';
        // $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id')], 'id', 'DESC');
        $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id'), 'transaction_status' => '1', 'status' => 'Active'], 'id', 'DESC');
        $this->load->view('includes/header-link', $data);
        $this->load->view('project_visualization');
    }

    public function project_history()
    {   
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }
        $data = [];
        
        $project_id = $this->input->get('id');
        
        $project_details = $this->CommonModal->getRowsWhere('projects', [
            'id' => $project_id,
        ]);

        $company_details = $this->CommonModal->getRowsWhere('companies', [
            'id' => $project_details[0]['company_id'],
        ]);

        $bricks_detail = $this->CommonModal->getRowsWhere('bricks', [
            'project_id' => $project_id,
            'brick_privacy' => 'public'
        ]);

        $data['getProject'] = $project_details[0];
        $data['getCompany'] = $company_details[0];
        $data['getBricks'] = $bricks_detail;

        // echo "<pre>";
        // print_r($data['getBricks']); die;
        
        $data['title'] = 'Project History';
        $this->load->view('includes/header-link', $data);
        $this->load->view('project_history');
    }

    public function board_room()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Board Room';
        $this->load->view('includes/header-link', $data);
        $this->load->view('board_room');
    }

    public function create_company()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['title'] = 'Company Login';
        $this->load->view('includes/header-link', $data);
        $this->load->view('create_company');
    }

    public function getState()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        // Get raw JSON input
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $countryId = isset($data['countryId']) ? $data['countryId'] : null;
        $stateId = $data['selectedState'];

        if ($countryId) {
            $data['selectedState'] = $stateId;
            $data['getStates'] = $this->CommonModal->getRowByIdInOrder('states', ['country_id' => $countryId], 'name', 'ASC');
            $this->load->view('getStates', $data);
        }
    }
    public function getCities()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $stateId = isset($data['stateId']) ? $data['stateId'] : null;

        if ($stateId) {
            $data['getCities'] = $this->CommonModal->getRowByIdInOrder('cities', ['state_id' => $stateId], 'name', 'ASC');
            $this->load->view('getCities', $data);
        }
    }

    public function update_profile_image()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        if (!empty($_FILES['user_image']['name'])) {
            $imagePath = imageUpload('user_image', 'uploads/user_profile', '');

            $freelancer_id = $this->session->userdata('freelancer_id');

            $update = $this->CommonModal->updateRowById('tbl_freelancer', 'id', $freelancer_id, ['user_image' => $imagePath]);

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
        }
    }
    public function testMail()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $message = email_template_OTP('998092');

        $sendMail = newmail('sagarthakur6947@gmail.com', 'My Digital Bricks', $message);
        if ($sendMail) {
            echo json_encode(['status' => 'success', 'message' => 'Mail sent successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send mail']);
        }
    }

    // public function insert_blocks()
    // {
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }

    //     date_default_timezone_set('Asia/Kolkata');
    //     $modified_date = date('Y-m-d H:i:s');

    //     $blocks = json_decode($this->input->raw_input_stream, true)[0];
    //     $blocks['user_id'] = sessionId('freelancer_id');
    //     $blocks['created_at'] = $modified_date;

    //     $getUser = $this->CommonModal->insertRow('tbl_age_blocks', $blocks);
    // }

    public function insert_blocks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d H:i:s');

        $blocks = json_decode($this->input->raw_input_stream, true)[0];

        $userId = sessionId('freelancer_id');

        $data = [
            'user_id'       => $userId,
            'year_range'    => $blocks['year_range'],
            'age_range'     => $blocks['age_range'],
            'description'   => $blocks['description'],
            'gap_type'      => $blocks['gap_type'],
            'artificialdate'=> $blocks['artificialdate'] ?? null,
            'created_at'    => $now
        ];

        // 🔍 Check duplicate (same user + gap_type + year_range)
        $existing = $this->db->get_where('tbl_age_blocks', [
            'user_id'    => $userId,
            'gap_type'   => $blocks['gap_type'],
            'year_range' => $blocks['year_range'],
        ])->row_array();

        if ($existing) {
            // ✅ Update instead of insert
            $this->db->where('id', $existing['id'])
                    ->update('tbl_age_blocks', $data);

            echo json_encode([
                'status' => "success",
                'message' => 'Block updated successfully'
            ]);
        } else {
            // ✅ Insert new row
            $this->db->insert('tbl_age_blocks', $data);

            echo json_encode([
                'status' => "success",
                'message' => 'Block inserted successfully'
            ]);
        }
    }

    
    public function get_blocks_by_gap()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $ageRange = $this->input->get('gap_type');
        $getAgeBlock = $this->CommonModal->getRowByMoreId('tbl_age_blocks', ['user_id' => sessionid('freelancer_id'), 'gap_type' => $ageRange]);
        echo json_encode($getAgeBlock);
    }

    public function upload_block_images()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->post('age_range');
        $gap_type = $this->input->post('gap_type');

        if (!empty($_FILES['images']['name'][0])) {
            $this->load->library('upload');

            $files = $_FILES;
            $count = count($_FILES['images']['name']);

            for ($i = 0; $i < $count; $i++) {
                $_FILES['image']['name'] = $files['images']['name'][$i];
                $_FILES['image']['type'] = $files['images']['type'][$i];
                $_FILES['image']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['image']['error'] = $files['images']['error'][$i];
                $_FILES['image']['size'] = $files['images']['size'][$i];

                $config['upload_path'] = 'uploads/age_block_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time() . '_' . $i;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $filePath = $uploadData['file_name'];

                    date_default_timezone_set('Asia/Kolkata');
                    $modified_date = date('Y-m-d H:i:s');


                    $data = [
                        'user_id' => $user_id,
                        'age_range' => $age_range,
                        'gap_type' => $gap_type,
                        'image_url' => $filePath,
                        'uploaded_at' => $modified_date,
                    ];

                    $this->CommonModal->insertRow('tbl_block_images', $data);
                }
            }

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No images selected']);
        }
    }

    public function get_uploaded_images()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->get('age_range');
        $gap_type = $this->input->get('gap_type');

        $images = $this->CommonModal->getRowByMoreId('tbl_block_images', [
            'user_id' => $user_id,
            'age_range' => $age_range,
            'gap_type' => $gap_type
        ]);

        echo json_encode($images);
    }

    // GET UPLOADED LINKS
    public function get_uploaded_links()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->get('age_range');
        $gap_type = $this->input->get('gap_type');

        $images = $this->CommonModal->getRowByMoreId('tbl_block_links', [
            'user_id' => $user_id,
            'age_range' => $age_range,
            'gap_type' => $gap_type
        ]);

        echo json_encode($images);
    }

    // Upload Links
    public function upload_block_link()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->post('age_range');
        $gap_type = $this->input->post('gap_type');
        $textLink = $this->input->post('text');
        $time = $this->input->post('time');
        $timeschedule = $this->input->post('timeschedule');
        $linkscategory = $this->input->post('linkscategory');

        if (empty($textLink)) {
            echo json_encode(['status' => 'error', 'message' => 'No link provided']);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $data = [
            'user_id' => $user_id,
            'age_range' => $age_range,
            'gap_type' => $gap_type,
            'links_url' => $textLink,
            'created_date' => $modified_date,
            'time' => $time,
            'timeschedule' => $timeschedule,
            'linkscategory' => $linkscategory,
        ];

        $insert = $this->CommonModal->insertRow('tbl_block_links', $data);

        echo json_encode([
            'status' => $insert ? 'success' : 'error',
            'message' => $insert ? 'Link uploaded successfully' : 'Failed to upload link'
        ]);
    }


    public function upload_block_documents()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->post('age_range');
        $gap_type = $this->input->post('gap_type');

        if (!empty($_FILES['documents']['name'][0])) {
            $files = $_FILES;
            $count = count($_FILES['documents']['name']);

            for ($i = 0; $i < $count; $i++) {
                $_FILES['document']['name'] = $files['documents']['name'][$i];
                $_FILES['document']['type'] = $files['documents']['type'][$i];
                $_FILES['document']['tmp_name'] = $files['documents']['tmp_name'][$i];
                $_FILES['document']['error'] = $files['documents']['error'][$i];
                $_FILES['document']['size'] = $files['documents']['size'][$i];

                $docPath = imageUpload('document', 'uploads/age_block_documents', '');

                if ($docPath) {

                    date_default_timezone_set('Asia/Kolkata');
                    $modified_date = date('Y-m-d H:i:s');


                    $data = [
                        'user_id' => $user_id,
                        'age_range' => $age_range,
                        'gap_type' => $gap_type,
                        'document_url' => $docPath,
                        'uploaded_at' => $modified_date,
                    ];
                    $this->CommonModal->insertRow('tbl_block_documents', $data);
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No documents selected']);
        }
    }

    public function get_uploaded_documents()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->get('age_range');
        $gap_type = $this->input->get('gap_type');

        $docs = $this->CommonModal->getRowByMoreId('tbl_block_documents', [
            'user_id' => $user_id,
            'age_range' => $age_range,
            'gap_type' => $gap_type
        ]);

        echo json_encode($docs);
    }

    public function upload_block_videos()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = $user_id = sessionId('freelancer_id');
        $age_range = $this->input->post('age_range');
        $gap_type = $this->input->post('gap_type');
        $artificialdate = $this->input->post('artificialdate');

        if (!empty($_FILES['videos']['name'][0])) {
            $files = $_FILES;
            $count = count($_FILES['videos']['name']);

            for ($i = 0; $i < $count; $i++) {
                $_FILES['video']['name'] = $files['videos']['name'][$i];
                $_FILES['video']['type'] = $files['videos']['type'][$i];
                $_FILES['video']['tmp_name'] = $files['videos']['tmp_name'][$i];
                $_FILES['video']['error'] = $files['videos']['error'][$i];
                $_FILES['video']['size'] = $files['videos']['size'][$i];

                $docPath = imageUpload('video', 'uploads/age_block_videos', '');


                if ($docPath) {

                    date_default_timezone_set('Asia/Kolkata');
                    $modified_date = date('Y-m-d H:i:s');

                    $data = [
                        'user_id' => $user_id,
                        'age_range' => $age_range,
                        'gap_type' => $gap_type,
                        'video_url' => $docPath,
                        'artificialdate' => $artificialdate,
                        'uploaded_at' => $modified_date,
                    ];

                    $this->CommonModal->insertRow('tbl_block_videos', $data);
                }
            }

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No videos selected']);
        }
    }

    public function get_uploaded_videos()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $age_range = $this->input->get('age_range');
        $gap_type = $this->input->get('gap_type');
        $videos = $this->CommonModal->getRowByMoreId('tbl_block_videos', [
            'user_id' => $user_id,
            'age_range' => $age_range,
            'gap_type' => $gap_type,
        ]);
        echo json_encode($videos);
    }

    public function update_user_summary()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $summary = isset($data['summary']) ? $data['summary'] : null;
        $saveSummary = $this->CommonModal->updateRowById('tbl_freelancer', 'id', sessionId('freelancer_id'), ['summary' => $summary]);
        if ($saveSummary) {
            echo json_encode(['status' => 'success', 'message' => 'Summary updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update summary']);
        }
    }
    public function update_user_skills_and_education()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $education = isset($data['education']) ? $data['education'] : null;
        $skills = isset($data['skills']) ? $data['skills'] : null;
        $experience = isset($data['experience']) ? $data['experience'] : null;
        $saveSummary = $this->CommonModal->updateRowById('tbl_freelancer', 'id', sessionId('freelancer_id'), ['education' => $education, 'skills' => $skills, 'experience' => $experience, 'education' => $education]);
        if ($saveSummary) {
            echo json_encode(['status' => 'success', 'message' => 'Skills and education updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update skills and education']);
        }
    }

    public function check_unique_cin($cin)
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('company_id');
        $getId = $this->input->get('id');
        if ($getId) {
            $user_id = $getId;
        }
        $existingUser = $this->CommonModal->getRowByConditions(
            'tbl_companies',
            ['ciin_number' => $cin, 'id !=' => $user_id]
        );

        if ($existingUser) {
            $this->form_validation->set_message('check_unique_cin', 'The cin number is already in use by another user.');
            return FALSE;
        }
        return TRUE;
    }

    public function validate_input($input)
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        if (preg_match('/<[^>]*script|on[a-z]+\s*=|javascript:/i', $input)) {
            $this->form_validation->set_message('validate_input', 'The {field} contains invalid or malicious content.');
            return FALSE;
        }
        return TRUE;
    }

    public function companyEdit()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        extract($this->input->post());

        $this->form_validation->set_rules('ciin_number', 'CIIN Number', 'required|callback_check_unique_cin');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('about_us', 'About Us', 'required');
        $this->form_validation->set_rules('mission', 'Mission', 'required');
        $this->form_validation->set_rules('vision', 'Vision', 'required');
        $this->form_validation->set_rules('valuation', 'Valuation', 'numeric');
        $this->form_validation->set_rules('equity_dilution', 'Equity Dilution', 'numeric');
        $this->form_validation->set_rules('founded_year', 'Founded Year', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Company Edit';
            // $data['profile_progress'] = $this->CompanyModal->get_profile_completion(sessionId('company_id'));
            // $getcompany_id = sessionId('company_id');
            $getCompanyId = $this->input->get('id');
            $data['getProfile'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $getCompanyId);
            $data['getDirectors'] = $this->CommonModal->getRowByIdInOrder('tbl_company_directory', ['company_id' => $getCompanyId], 'id', 'DESC');
            $data['getBanks'] = $this->CommonModal->getRowByIdInOrder('tbl_company_banks', ['company_id' => $getCompanyId], 'id', 'DESC');
            $this->load->view('includes/header-link', $data);
            $this->load->view('edit-company-profile');
        } else {
            $getCompanyId = $this->input->get('id');
            $user_id = $this->session->userdata('freelancer_id');
            $postData = [
                'user_id' => $user_id,
                'ciin_number' => $ciin_number,
                'dipp_number' => $dipp_number,
                'pan_number' => $pan_number,
                'tan_number' => $tan_number,
                'gst_number' => $gst_number,
                'company_name' => $company_name,
                'about_us' => $about_us,
                'mission' => $mission,
                'vision' => $vision,
                'valuation' => $valuation,
                'equity_dilution' => $equity_dilution,
                'founded_year' => $founded_year,
                'employercount' => $employercount,
                'currentemployercount' => $currentemployercount,
                'lifetimerevenue' => $lifetimerevenue,
                'currentlifetimerevenue' => $currentlifetimerevenue,
            ];
            $update = $this->CommonModal->updateRowById('companies', 'id', $getCompanyId, $postData);
            if (!empty($director_name)) {
                $this->CommonModal->deleteRowById('tbl_company_directory', ['company_id' => $getCompanyId]);
                foreach ($director_name as $key => $name) {
                    if (!empty($director_name)) {
                        $directorData = [
                            'company_id' => $getCompanyId,
                            'director_name' => $director_name[$key] ?? null,
                            'director_din_number' => $director_din_number[$key] ?? null,
                            'director_mobile_number' => $director_mobile_number[$key] ?? null,
                            'director_email' => $director_email[$key] ?? null,
                            'director_address' => $director_address[$key] ?? null,
                        ];
                        $this->CommonModal->insertRow('tbl_company_directory', $directorData);
                    }
                }
            }

            if (!empty($account_holder_name)) {
                $this->CommonModal->deleteRowById('tbl_company_banks', ['company_id' => $getCompanyId]);
                foreach ($account_holder_name as $key => $name) {
                    if (!empty($account_holder_name)) {
                        $accountData = [
                            'company_id' => $getCompanyId,
                            'account_holder_name' => $account_holder_name[$key] ?? null,
                            'account_number' => $account_number[$key] ?? null,
                            'bank_name' => $bank_name[$key] ?? null,
                            'ifsc_code' => $ifsc_code[$key] ?? null
                        ];
                        $this->CommonModal->insertRow('tbl_company_banks', $accountData);
                    }
                }
            }
            if ($update) {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-success">Company Created Successfully.</div>');
                $this->session->unset_userdata('company_id');
            } else {
                $this->session->set_userdata('taskMsg', '<div class="alert alert-success">Company is up-to-date</div>');
            }
            redirect(base_url('company/company-profile'));
        }
    }

    public function projectEdit()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        // Set validation rules for each field
        $this->form_validation->set_rules('selected_company_id', 'Company', 'required|trim');
        $this->form_validation->set_rules('project_name', 'Project Name', 'required|trim');
        $this->form_validation->set_rules('project_leader', 'Project Leader', 'required');
        $this->form_validation->set_rules('layer_range_from', 'Layer', 'required');
        $this->form_validation->set_rules('layer_range_to', 'Layer', 'required');
        $this->form_validation->set_rules('team_range_from', 'Team', 'required');
        $this->form_validation->set_rules('team_range_to', 'Team', 'required');
        $this->form_validation->set_rules('face_value', 'Face Value', 'required');
        $this->form_validation->set_rules('current_price', 'Current Price', 'required');
        $this->form_validation->set_rules('project_valuation', 'Project Valuation', 'required|numeric');
        $this->form_validation->set_rules('issued_shares', 'Issued Shares', 'required|numeric');
        $this->form_validation->set_rules('tam', 'Total Expected Collaborator (TAM)', 'required|numeric');
        $this->form_validation->set_rules('sam', 'Serviceable Available Market (SAM)', 'required|numeric');
        $this->form_validation->set_rules('som', 'Serviceable Obtainable Market (SOM)', 'required|numeric');
        $this->form_validation->set_rules('project_overview', 'Project Overview', 'required|min_length[20]|max_length[300]|callback_validate_input');
        $this->form_validation->set_rules('mission', 'Mission', 'required');
        $this->form_validation->set_rules('vision', 'Vision', 'required');

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            $projectId = $this->input->get('id');
            $data['title'] = 'Edit Project';
            $data['getProject'] = $this->CommonModal->getSingleRowById('projects', 'id = ' . $projectId);
            $data['getCompanies'] = $this->CommonModal->getRowByIdInOrder('companies', ['user_id' => sessionId('freelancer_id')], 'id', 'DESC');
            $data['getCompanyDetails'] = $this->CommonModal->getSingleRowById('companies', 'id = ' . $data['getProject']['company_id']);
            $this->load->view('includes/header-link', $data);
            $this->load->view('edit-project', $data);
        } else {
            // print_r($this->input->post()); die;
            $projectId = $this->input->get('id');
            $project_data = [
                'company_id' => $this->input->post('selected_company_id'),
                'user_id' => sessionId('freelancer_id'),
                'face_value' => $this->input->post('face_value'),
                'current_price' => $this->input->post('current_price'),
                'project_name' => $this->input->post('project_name'),
                'project_leader' => $this->input->post('project_leader'),
                'project_valuation' => $this->input->post('project_valuation'),
                'issued_shares' => $this->input->post('issued_shares'),
                'tam' => $this->input->post('tam'),
                'sam' => $this->input->post('sam'),
                'som' => $this->input->post('som'),
                'money_invested' => $this->input->post('money_invested'),
                'project_start_date' => $this->input->post('project_start_date'),
                'physical_scale' => $this->input->post('physical_scale') === 'NA' ? NULL : $this->input->post('physical_scale'),
                'project_overview' => $this->input->post('project_overview'),
                'mission' => $this->input->post('mission'),
                'vision' => $this->input->post('vision'),
                'layer_range_from' => $this->input->post('layer_range_from'),
                'layer_range_to' => $this->input->post('layer_range_to'),
                'team_range_from' => $this->input->post('team_range_from'),
                'team_range_to' => $this->input->post('team_range_to'),
                'project_status' =>  $this->input->post('project_status'),
            ];
            // print_r($project_data); die;

            // Handle file uploads
            $existing_project = $this->CommonModal->getSingleRowById('projects', 'id = ' . $projectId);

            // Project Document
            if (!empty($_FILES['project_document']['name'])) {
                $project_document_url = imageUpload('project_document', 'uploads/project_docs', '');
                if ($project_document_url) {
                    $project_data['project_document'] = $project_document_url;
                    // Optionally delete the old file
                    if (!empty($existing_project['project_document']) && file_exists($existing_project['project_document'])) {
                        unlink($existing_project['project_document']);
                    }
                }
            } else {
                $project_data['project_document'] = $existing_project['project_document']; // Retain existing document
            }

            // Project Pitch
            if (!empty($_FILES['project_pitch']['name'])) {
                $project_pitch_url = imageUpload('project_pitch', 'uploads/project_docs', '');
                if ($project_pitch_url) {
                    $project_data['project_pitch'] = $project_pitch_url;
                    // Optionally delete the old file
                    if (!empty($existing_project['project_pitch']) && file_exists($existing_project['project_pitch'])) {
                        unlink($existing_project['project_pitch']);
                    }
                }
            } else {
                $project_data['project_pitch'] = $existing_project['project_pitch']; // Retain existing pitch
            }

            // Update the project in the database
            $update = $this->CommonModal->updateRowById('projects', 'id', $projectId, $project_data);

            if ($update) {
                $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Project updated successfully</div>');
            } else {
                $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">Failed to update project</div>');
            }

            // Redirect to project creation page
            redirect('company/project-profile-preview?id=' . $projectId);
        }
    }

    // public function fetchProjectsForBricks()
    // {
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }

    //     $companyID = $this->input->post('company_id');
    //     $getProjects = $this->CommonModal->getRowByMoreId('tbl_projects', ['company_id' => $companyID, 'project_status' => 'Active']);
    //     echo json_encode(['success' => true, 'projects' => $getProjects]);
    // }

    public function fetchProjectsForBricks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id   = sessionId('freelancer_id');
        $companyID = $this->input->post('company_id');

        $projects = $this->HomeModal->getEditableProjectsForBrick($user_id, $companyID);

        echo json_encode([
            'success'  => true,
            'projects' => $projects
        ]);
    }

    public function userPaymentSuccess()
    {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['user'] = $this->CommonModal->getSingleRowById('freelancer', ['razorpay_order_id' => $_GET['id']]);
        $this->load->view('user-payment-success', $data);
    }
    public function companyPaymentSuccess()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['user'] = $this->CommonModal->getSingleRowById('companies', ['razorpay_order_id' => $_GET['id']]);
        $this->load->view('company-payment-success', $data);
    }
    public function projectPaymentSuccess()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data['user'] = $this->CommonModal->getSingleRowById('projects', ['razorpay_order_id' => $_GET['id']]);
        $this->load->view('project-payment-success', $data);
    }
    public function companyDeleteByUser()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getID = $this->input->get('id');
        $this->CommonModal->deleteRowById('tbl_companies', ['id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_projects', ['company_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_company_banks', ['company_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_company_directory', ['company_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_bricks', ['company_id' => $getID]);

        $this->session->set_userdata('deleteMsg', '<div class="alert alert-success">Company Deleted Successfully.</div>');
        redirect(base_url('company/company-profile'));
    }
    public function projectDeleteByUser()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getID = $this->input->get('id');
        $this->CommonModal->deleteRowById('tbl_projects', ['id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_bricks', ['project_id' => $getID]);

        $this->session->set_userdata('deleteMsg', '<div class="alert alert-success">Project Deleted Successfully.</div>');
        redirect(base_url('company/project-profile'));
    }
    public function brickDeleteByUser()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getID = $this->input->get('id');
        $this->CommonModal->deleteRowById('tbl_bricks', ['id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_brick_funding', ['brick_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_brick_skills', ['brick_id' => $getID]);
        $this->CommonModal->deleteRowById('tbl_brick_nonliving', ['brick_id' => $getID]);

        $this->session->set_userdata('deleteMsg', '<div class="alert alert-success">Brick Deleted Successfully.</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }




    public function teamupRequestUpdate()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $getid = $this->input->get('id');
        $status = $this->input->get('status');
        // dp($getid);
        // dp($status);
        // die;
        $update = $this->CommonModal->updateRowById('tbl_teamcompanymember', 'id', $getid, ['status' => $status]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function save_layers()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['layers'])) {
            foreach ($data['layers'] as $layer) {
                // $layer['id'], $layer['name'], $layer['collaboratorCount'], $layer['company_id']
                $layer['layer_id'] = $layer['id'];
                unset($layer['id']);
                $getExistingLayer = $this->CommonModal->getRowByMoreId('tbl_layers', ['layer_id' => $layer['layer_id'], 'company_id' => $layer['company_id']]);
                if (!empty($getExistingLayer)) {
                    $updateLayer = $this->CommonModal->updateRowByMoreId('tbl_layers', ['layer_id' => $layer['layer_id'], 'company_id' => $layer['company_id']], ['name' => $layer['name']]);
                } else {
                    $insertLayer = $this->CommonModal->insertRowReturnId('tbl_layers', $layer);
                }
            }
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No layers received']);
        }
    }

    public function get_layers()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $company_id = $data['company_id'];

        // Fetch layers based on company_id
        $layers = $this->CommonModal->getRowbyId('tbl_layers', 'company_id', $company_id);

        echo json_encode(['layers' => $layers]);
    }

    public function update_layers_collaborator_count()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['layers'])) {
            foreach ($data['layers'] as $layer) {
                $layer['layer_id'] = $layer['id'];
                unset($layer['id']);
                $updateLayer = $this->CommonModal->updateRowByMoreId('tbl_layers', ['layer_id' => $layer['layer_id'], 'company_id' => $layer['company_id']], ['collaboratorCount' => $layer['collaboratorCount']]);
            }
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No layers received']);
        }
    }

    // ENHANCED TEAM MANAGEMENT FUNCTIONS

    // Search users function for Tagify
    public function searchUsers()
    {
        if (!sessionId('freelancer_id')) {
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

        if (!sessionId('freelancer_id')) {
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

    public function searchCompany()
    {
        header('Content-Type: application/json');

        if (!sessionId('freelancer_id')) {
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
                'companies' => []
            ]);
            return;
        }

        try {
            $this->db->select('id, company_type, company_name, ciin_number');
            $this->db->from('tbl_companies');
            $this->db->group_start();
            $this->db->like('company_name', $search);
            $this->db->or_like('ciin_number', $search);
            $this->db->group_end();
            $this->db->limit(20); // ✅ VERY IMPORTANT

            $companies = $this->db->get()->result_array();

            $formatted_companies = array_map(function ($company) {
                return [
                    'value'  => $company['id'],   // ✅ REQUIRED BY TAGIFY
                    'company_name'   => $company['company_name'],
                    'ciin_number'  => $company['ciin_number'],
                ];
            }, $companies);

            echo json_encode([
                'success' => true,
                'companies' => $formatted_companies
            ]);

        } catch (Throwable $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Server error'
            ]);
        }
    }

    // Enhanced team member addition function that works with companies, projects, and bricks
    public function addTeamMember()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $team_members = isset($data['teamMember']) ? $data['teamMember'] : null;
        $company_id = isset($data['company_id']) ? $data['company_id'] : null;
        $project_id = isset($data['project_id']) ? $data['project_id'] : null;
        $brick_id = isset($data['brick_id']) ? $data['brick_id'] : null;
        $selection_type = isset($data['type']) ? $data['type'] : null;

        if (empty($team_members) || !is_array($team_members)) {
            echo json_encode(['status' => 'error', 'message' => 'Team members are required']);
            return;
        }

        // Validate that at least one ID is provided
        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Company, Project, or Brick ID is required']);
            return;
        }

        $this->db->trans_begin();

        try {
            $inserted_members = [];
            $existing_members = [];

            foreach ($team_members as $member) {
                $member_id = $member['value'];

                // Build conditions for checking existing members
                $conditions = ['member_id' => $member_id];

                if ($company_id)
                    $conditions['company_id'] = $company_id;
                if ($project_id)
                    $conditions['project_id'] = $project_id;
                if ($brick_id)
                    $conditions['brick_id'] = $brick_id;

                $existing = $this->CommonModal->getRowByMoreId('tbl_teamcompanymember', $conditions);

                if (empty($existing)) {
                    $post_data = [
                        'member_id' => $member_id,
                        'company_id' => $company_id,
                        'project_id' => $project_id,
                        'brick_id' => $brick_id,
                        'status' => 'Requested',
                        'create_date' => date('Y-m-d H:i:s')
                    ];

                    $insert_result = $this->CommonModal->insertRow('tbl_teamcompanymember', $post_data);
                    if ($insert_result) {
                        $inserted_members[] = [
                            'label' => $member['label'],
                            'value' => $member['value']
                        ];
                    }
                } else {
                    $existing_members[] = [
                        'label' => $member['label'],
                        'value' => $member['value']
                    ];
                }
            }

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Database transaction failed');
            }

            $this->db->trans_commit();

            echo json_encode([
                'status' => 'success',
                'message' => 'Request processed',
                'inserted' => $inserted_members,
                'alreadyExists' => $existing_members
            ]);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Keep the original addTeamMemberToCompany for backward compatibility
    public function addTeamMemberToCompany()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;

        if (!empty($data['teamMember']) && !empty($data['companyId'])) {
            $insertedMembers = [];
            $existingMembers = [];

            foreach ($data['teamMember'] as $member) {
                $conditions = [
                    'member_id' => $member['value'],
                    'company_id' => $data['companyId'],
                    'channel_id' => null,
                    'chid' => null
                ];
                if ($project_id)
                    $conditions['project_id'] = $project_id;
                if ($brick_id)
                    $conditions['brick_id'] = $brick_id;


                $existing = $this->CommonModal->getRowByMoreId('tbl_teamcompanymember', $conditions);

                if ($existing['status']  == 'Accepted') {
                    $msg = 'is already part of this team.';
                } else {
                    $msg = "is already requested for this team";
                }

                if (empty($existing)) {
                    $postData = [
                        'member_id' => $member['value'],
                        'company_id' => $data['companyId'],
                        'project_id' => $project_id,
                        'brick_id' => $brick_id,
                        'status' => 'Requested',
                        'create_date' => date('Y-m-d H:i:s')
                    ];
                    $this->CommonModal->insertRow('tbl_teamcompanymember', $postData);

                    // Keep label and value both in response
                    $insertedMembers[] = [
                        'label' => $member['label'],
                        'value' => $member['value']
                    ];
                } else {
                    $existingMembers[] = [
                        'label' => $member['label'],
                        'value' => $member['value'],
                        'reason' => $msg
                    ];
                }
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Request processed',
                'inserted' => $insertedMembers,
                'alreadyExists' => $existingMembers
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data received']);
        }
    }

    // public function deleteAddedMember()
    // {
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }

    //     $memberId = $this->input->get('id');
    //     $deleteMember = $this->CommonModal->deleteRowById('tbl_teamcompanymember', ['id' => $memberId]);
    //     if ($deleteMember) {
    //         $this->session->set_userdata('memberDelete', '<div class="alert alert-success">Member deleted successfully.</div>');
    //     } else {
    //         $this->session->set_userdata('memberDelete', '<div class="alert alert-danger">something went wrong.</div>');
    //     }
    //     redirect($_SERVER['HTTP_REFERER']);
    // }

    public function deleteAddedMember()
    {
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $memberId = $data['id'] ?? null;

        if (!$memberId) {
            echo json_encode(['status' => 'error', 'message' => 'Member ID required']);
            return;
        }

        $deleted = $this->CommonModal->deleteRowById('tbl_teamcompanymember', ['id' => $memberId]);

        if ($deleted) {
            echo json_encode(['status' => 'success', 'message' => 'Member deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Delete failed or record not found']);
        }
    }

    public function deletePressRelease()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $pressId = $this->input->get('id');
        $deletePress = $this->CommonModal->deleteRowById('tbl_project_press_release', ['id' => $pressId]);
        if ($deletePress) {
            $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deletePressReleaseCompany()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $pressId = $this->input->get('id');
        // echo $pressId; die;
        $deletePress = $this->CommonModal->deleteRowById('tbl_company_press_release', ['id' => $pressId]);
        if ($deletePress) {
            $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deletePressReleaseUser()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $pressId = $this->input->get('id');
        // echo $pressId; die;
        $deletePress = $this->CommonModal->deleteRowById('tbl_user_press_release', ['id' => $pressId]);
        if ($deletePress) {
            $this->session->set_userdata('projectMsg', '<div class="alert alert-success">Press Deleted Successfully.</div>');
        } else {
            $this->session->set_userdata('projectMsg', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function deleteNeworth()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $networthId = $this->input->get('id');
        $deleteNetworth = $this->CommonModal->deleteRowById('tbl_networth', ['id' => $networthId]);
        if ($deleteNetworth) {
            $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-success">Networth deleted successfully.</div>');
        } else {
            $this->session->set_userdata('bricksFundstatus', '<div class="alert alert-danger">something went wrong.</div>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function save_team_structure()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload: ' . json_last_error_msg()]);
            return;
        }

        $company_id = isset($data['company_id']) ? trim($data['company_id']) : null;
        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;
        $departments = isset($data['departments']) ? $data['departments'] : null;

        if (empty($departments) || !is_array($departments)) {
            echo json_encode(['status' => 'error', 'message' => 'Departments data is required and must be an array']);
            return;
        }

        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            echo json_encode(['status' => 'error', 'message' => 'At least one of Company, Project, or Brick ID is required']);
            return;
        }

        $this->db->trans_begin();

        try {
            // Build conditions for clearing existing departments
            $conditions = [];

            if ($company_id)
                $conditions['company_id'] = $company_id;
            if ($project_id)
                $conditions['project_id'] = $project_id;
            if ($brick_id)
                $conditions['brick_id'] = $brick_id;

            // Log conditions for debugging
            log_message('debug', 'Delete conditions: ' . print_r($conditions, true));

            // Clear existing departments and their team members
            $existing_depts = $this->CommonModal->getRowByMoreId('tbl_departments', $conditions);
            foreach ($existing_depts as $dept) {
                $this->CommonModal->deleteRowById('tbl_teamcompanymember', ['department_id' => $dept['id']]);
            }
            $this->CommonModal->deleteRowById('tbl_departments', $conditions);

            // Insert or update departments
            foreach ($departments as $dept) {
                if (empty($dept['id']) || empty($dept['name'])) {
                    throw new Exception('Department ID and name are required');
                }

                // Check if department ID already exists
                $existing_dept = $this->CommonModal->getRowById('tbl_departments', 'id', $dept['id']);

                $dept_data = [
                    'id' => $dept['id'],
                    'company_id' => $company_id,
                    'project_id' => $project_id,
                    'brick_id' => $brick_id,
                    'name' => $dept['name'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                log_message('debug', 'Processing department: ' . print_r($dept_data, true));

                if ($existing_dept) {
                    // Update existing department
                    $this->CommonModal->updateRowById('tbl_departments', 'id', $dept['id'], [
                        'company_id' => $company_id,
                        'project_id' => $project_id,
                        'brick_id' => $brick_id,
                        'name' => $dept['name']
                    ]);
                    log_message('debug', 'Updated department ID: ' . $dept['id']);
                } else {
                    // Insert new department
                    $this->CommonModal->insertRow('tbl_departments', $dept_data);
                    log_message('debug', 'Inserted department ID: ' . $dept['id']);
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $error = $this->db->error();
                throw new Exception('Database error: ' . $error['message']);
            }

            $this->db->trans_commit();
            echo json_encode(['status' => 'success', 'message' => 'Team structure saved successfully']);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Placeholder for addTeamMemberToDepartment (ensure it uses correct department_id)
    public function addTeamMemberToDepartment()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload: ' . json_last_error_msg()]);
            return;
        }

        $company_id = isset($data['company_id']) ? trim($data['company_id']) : null;
        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;
        $department_id = isset($data['departmentId']) ? trim($data['departmentId']) : null;
        $members = isset($data['members']) ? $data['members'] : null;

        if (empty($members) || !is_array($members)) {
            echo json_encode(['status' => 'error', 'message' => 'Members data is required and must be an array']);
            return;
        }

        if (empty($department_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Department ID is required']);
            return;
        }

        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            echo json_encode(['status' => 'error', 'message' => 'At least one of Company, Project, or Brick ID is required']);
            return;
        }

        $this->db->trans_begin();

        try {
            $inserted = [];
            $existing = [];
            $updated = [];

            foreach ($members as $member) {
                if (empty($member['id']) || empty($member['name'])) {
                    continue; // Skip invalid members
                }

                $conditions = [
                    'member_id' => $member['id'],
                    'company_id' => $company_id
                ];
                if ($project_id){
                    $conditions['project_id'] = $project_id;
                }
                if ($brick_id){
                    $conditions['brick_id'] = $brick_id;
                }

                $conditions['department_id'] = $department_id;

                $existing_member = $this->CommonModal->getRowByMoreId('tbl_teamcompanymember', $conditions);

                log_message('debug', 'query runs to check existing member: ' . $this->db->last_query());
                // print_r($existing_member);
                // print_r($conditions); die;

                if ($existing_member) {
                    // Update existing member
                    $this->CommonModal->updateRowByMoreId('tbl_teamcompanymember', $conditions, [
                        'nickname' => isset($member['nickname']) ? $member['nickname'] : null,
                    ]);
                    $updated[] = $member;
                    log_message('debug', 'Updated team member: ' . print_r($member, true));
                } else {
                    // Insert new member
                    $member_data = [
                        'member_id' => $member['id'],
                        'company_id' => $company_id,
                        'project_id' => $project_id,
                        'brick_id' => $brick_id,
                        'department_id' => $department_id,
                        'nickname' => isset($member['nickname']) ? $member['nickname'] : null,
                        'status' => 'Requested',
                        'create_date' => date('Y-m-d H:i:s')
                    ];
                    $this->CommonModal->insertRow('tbl_teamcompanymember', $member_data);
                    $inserted[] = $member;
                    log_message('debug', 'Inserted team member: ' . print_r($member_data, true));
                }

            }

            if ($this->db->trans_status() === FALSE) {
                $error = $this->db->error();
                // throw new Exception('Database error: ' . $error['message']);
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'db_error' => $this->db->error()
                ]);

            }

            $this->db->trans_commit();
            echo json_encode([
                'status' => 'success',
                'message' => 'Team members processed successfully',
                'inserted' => $inserted,
                'updated' => $updated,
                'existing' => $existing
            ]);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Enhanced team structure loading
    public function get_team_structure()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $company_id = isset($data['company_id']) ? trim($data['company_id']) : null;
        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;

        // Validate input
        if (empty($company_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Company ID is required']);
            return;
        }
        if ($brick_id && (empty($company_id) || empty($project_id))) {
            echo json_encode(['status' => 'error', 'message' => 'Company and Project IDs are required when Brick ID is provided']);
            return;
        }
        if ($project_id && empty($company_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Company ID is required when Project ID is provided']);
            return;
        }

        try {
            // Build conditions for fetching departments
            $conditions = ['company_id' => $company_id];
            if ($project_id)
                $conditions['project_id'] = $project_id;
            if ($brick_id)
                $conditions['brick_id'] = $brick_id;


            $team_conditions = array_filter([
                'company_id' => $company_id,
                'project_id' => $project_id,
                'brick_id'   => $brick_id,
                'status'     => 'Accepted'
            ]);

            // Fetch team members
            // $team_conditions = $conditions;
            // $team_members = $this->CommonModal->getRowByMoreId('tbl_teamcompanymember', $team_conditions);
            
            // Fetch departments
            // $departments = $this->CommonModal->getRowByMoreId('tbl_departments', $conditions);
            // dd($departments);
            // Fetch department agreements
            // $agreements = $this->CommonModal->getRowByMoreId('tbl_department_agreements', $conditions);

            // Fetch user details for team members
            // $team_members = is_array($team_members) ? $team_members : [];

            // Extract member_id and ensure unique values
            // $user_ids = array_unique(array_column($team_members, 'member_id')) ?: [];
            // dd($user_ids);
            // $users = [];
            // if (!empty($user_ids)) {
            //     $this->db->select('id, name, email, user_image as avatar');
            //     $this->db->where_in('id', $user_ids);
            //     $query = $this->db->get('tbl_freelancer');
            //     $users = $query->result_array();
            //     $users = array_map(function ($user) {
            //         return [
            //             'id' => $user['id'],
            //             'name' => !empty($user['name']) ? $user['name'] : 'No Name',
            //             'email' => $user['email'],
            //             'avatar' => !empty($user['avatar']) ? base_url() . 'uploads/user_profile/' . $user['avatar'] : base_url() . 'assets/user-icon.png'
            //         ];
            //     }, $users);
            // }

            // Structure the response
            // $structured_depts = [];
            // foreach ($departments as $dept) {
                // Filter members for this department
                // $dept_members = array_filter($team_members, function ($member) use ($dept) {
                //     return $member['department_id'] === $dept['id'];
                // });

                // Map members
                // $members = array_map(function ($member) use ($users) {
                //     $user = array_values(array_filter($users, function ($u) use ($member) {
                //         return $u['id'] === $member['member_id'];
                //     }))[0] ?? [];
                //     return [
                //         'team_row_id' => $member['id'] ?? '',
                //         'id' => $user['id'] ?? '',
                //         'name' => $user['name'] ?? 'Unknown',
                //         'email' => $user['email'] ?? '',
                //         'avatar' => $user['avatar'] ?? base_url() . 'assets/user-icon.png',
                //         'nickname' => $member['nickname'] ?? ''
                //     ];
                // }, $dept_members);

                // Filter agreements for this department
            //     $dept_agreements = is_array($agreements) ? array_filter($agreements, function ($agreement) use ($dept) {
            //         return $agreement['department_id'] === $dept['id'];
            //     }) : [];

            //     $agreements_array = array_map(function ($agreement) {
            //         $file_path = !empty($agreement['file_path']) ? base_url() . ltrim($agreement['file_path'], '/') : '';
            //         return [
            //             'id' => $agreement['id'],
            //             'file_name' => $agreement['file_name'] ?? 'Unnamed File',
            //             'file_path' => $file_path,
            //             'uploaded_at' => $agreement['uploaded_at'] ?? date('Y-m-d H:i:s')
            //         ];
            //     }, $dept_agreements);

            //     $structured_depts[] = [
            //         'id' => $dept['id'],
            //         'name' => $dept['name'],
            //         'members' => array_values($members), // Ensure members is an array
            //         'agreements' => array_values($agreements_array)
            //     ];
            // }
            $where = [
                'company_id' => $company_id,
                'project_id' => $project_id,
                'brick_id'   => $brick_id,
                'status'     => 'Accepted'
            ];

            $rows = $this->HomeModal->getTeamStructure($where);
            // dd($rows);
            $departments = [];

            foreach ($rows as $row) {

                $dept_id = $row['department_id'];

                if (!isset($departments[$dept_id])) {

                    $departments[$dept_id] = [
                        'id' => $dept_id,
                        'name' => $row['department_name'],
                        'members' => [],
                        'agreements' => []
                    ];
                }

                // Add member
                if (!empty($row['member_id'])) {

                    $departments[$dept_id]['members'][] = [
                        'team_row_id' => $row['team_row_id'],
                        'id' => $row['member_id'],
                        'name' => $row['name'] ?? 'No Name',
                        'email' => $row['email'],
                        'avatar' => !empty($row['user_image'])
                            ? base_url('uploads/user_profile/'.$row['user_image'])
                            : base_url('assets/user-icon.png'),
                        'nickname' => $row['nickname']
                    ];
                }

                // Add agreement
                if (!empty($row['agreement_id'])) {

                    $departments[$dept_id]['agreements'][] = [
                        'id' => $row['agreement_id'],
                        'file_name' => $row['file_name'],
                        'file_path' => base_url($row['file_path']),
                        'uploaded_at' => $row['uploaded_at']
                    ];
                }
            }

            $structured_depts = array_values($departments);

            echo json_encode([
                'status' => 'success',
                'departments' => $structured_depts,
                'message' => empty($structured_depts) ? 'No departments found for the given criteria' : 'Departments retrieved successfully'
            ]);
        } catch (Exception $e) {
            log_message('error', 'get_team_structure: Exception: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function getExistingTeamMembers()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $company_id = isset($data['company_id']) ? $data['company_id'] : null;
        $project_id = isset($data['project_id']) ? $data['project_id'] : null;
        $brick_id = isset($data['brick_id']) ? $data['brick_id'] : null;

        // Validate that at least one parent ID is provided
        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Company, Project, or Brick ID is required']);
            return;
        }

        try {
            // Get team members with user details and department info
            $this->db->select('
            tcm.id,
            tcm.member_id,
            tcm.nickname,
            tcm.status,
            tcm.create_date,
            tcm.department_id,
            tf.name,
            tf.email,
            tf.user_image,
            td.name as department_name
        ');
            $this->db->from('tbl_teamcompanymember tcm');
            $this->db->join('tbl_freelancer tf', 'tcm.member_id = tf.id', 'left');
            $this->db->join('tbl_departments td', 'tcm.department_id = td.id', 'left');

            // Build where conditions
            if ($company_id)
                $this->db->where('tcm.company_id', $company_id);
            if ($project_id)
                $this->db->where('tcm.project_id', $project_id);
            if ($brick_id)
                $this->db->where('tcm.brick_id', $brick_id);

            $this->db->order_by('tcm.create_date', 'DESC');

            $query = $this->db->get();
            $members = $query->result_array();

            // Format the response
            $formatted_members = array_map(function ($member) {
                return [
                    'id' => $member['id'],
                    'member_id' => $member['member_id'],
                    'name' => !empty($member['name']) ? $member['name'] : 'No Name',
                    'email' => $member['email'],
                    'nickname' => $member['nickname'],
                    'status' => $member['status'],
                    'department_name' => $member['department_name'],
                    'avatar' => !empty($member['user_image']) ?
                        base_url() . 'uploads/user_profile/' . $member['user_image'] :
                        base_url() . 'assets/user-icon.png',
                    'create_date' => $member['create_date']
                ];
            }, $members);

            echo json_encode([
                'status' => 'success',
                'members' => $formatted_members,
                'total' => count($formatted_members)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Enhanced agreement upload
    public function upload_department_agreement()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $response = ['success' => false, 'error' => ''];
        $upload_path = 'uploads/agreements';

        // Ensure upload directory exists
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $department_id = $this->input->post('department_id');
        $company_id = $this->input->post('company_id');
        $project_id = $this->input->post('project_id');
        $brick_id = $this->input->post('brick_id');
        $file_field = 'agreement_file';

        if (empty($department_id)) {
            $response['error'] = 'Department ID is required.';
            echo json_encode($response);
            return;
        }

        // Validate that at least one parent ID is provided
        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            $response['error'] = 'Company, Project, or Brick ID is required.';
            echo json_encode($response);
            return;
        }

        try {
            // Use the imageUpload function for file upload
            $file_path = imageUpload($file_field, $upload_path, '');

            if ($file_path) {
                // Save agreement info to database
                $agreement_data = [
                    'department_id' => $department_id,
                    'company_id' => $company_id,
                    'project_id' => $project_id,
                    'brick_id' => $brick_id,
                    'file_name' => basename($file_path),
                    'file_path' => $file_path,
                    'uploaded_at' => date('Y-m-d H:i:s')
                ];

                // Build conditions for checking existing agreement
                $conditions = ['department_id' => $department_id];
                if ($company_id)
                    $conditions['company_id'] = $company_id;
                if ($project_id)
                    $conditions['project_id'] = $project_id;
                if ($brick_id)
                    $conditions['brick_id'] = $brick_id;

                $existing = $this->CommonModal->getRowByMoreId('tbl_department_agreements', $conditions);

                if ($existing) {
                    // Update existing record
                    $this->CommonModal->updateRowById('tbl_department_agreements', 'id', $existing[0]['id'], $agreement_data);
                } else {
                    // Insert new record
                    $this->CommonModal->insertRow('tbl_department_agreements', $agreement_data);
                }

                $response['success'] = true;
                $response['file_path'] = $file_path;
                $response['file_name'] = basename($file_path);
                $response['message'] = 'Agreement uploaded successfully!';
            } else {
                $response['error'] = 'File upload failed. Please try again.';
            }
        } catch (Exception $e) {
            $response['error'] = 'Upload error: ' . $e->getMessage();
        }

        echo json_encode($response);
    }


    public function uploadAgreementFile()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $response = ['success' => false, 'error' => ''];
        $upload_path = 'uploads/agreements';

        // Ensure upload directory exists
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $department_id = $this->input->post('department_id');
        $company_id = $this->input->post('company_id');
        $project_id = $this->input->post('project_id');
        $brick_id = $this->input->post('brick_id');
        $file_field = 'agreement_file';

        if (empty($department_id)) {
            $response['error'] = 'Department ID is required.';
            echo json_encode($response);
            return;
        }

        // Validate that at least one parent ID is provided
        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            $response['error'] = 'Company, Project, or Brick ID is required.';
            echo json_encode($response);
            return;
        }

        try {
            // Use the imageUpload function for file upload
            $file_path = imageUpload($file_field, $upload_path, '');

            if ($file_path) {
                // Save agreement info to database
                $agreement_data = [
                    'department_id' => $department_id,
                    'company_id' => $company_id,
                    'project_id' => $project_id,
                    'brick_id' => $brick_id,
                    'file_name' => basename($file_path),
                    'file_path' => $file_path,
                    'uploaded_at' => date('Y-m-d H:i:s')
                ];

                // Build conditions for checking existing agreement
                $conditions = ['department_id' => $department_id];
                if ($company_id)
                    $conditions['company_id'] = $company_id;
                if ($project_id)
                    $conditions['project_id'] = $project_id;
                if ($brick_id)
                    $conditions['brick_id'] = $brick_id;

                $existing = $this->CommonModal->getRowByMoreId('tbl_department_agreements', $conditions);

                if ($existing) {
                    // Update existing record
                    $this->CommonModal->updateRowById('tbl_department_agreements', 'id', $existing[0]['id'], $agreement_data);
                } else {
                    // Insert new record
                    $this->CommonModal->insertRow('tbl_department_agreements', $agreement_data);
                }

                $response['success'] = true;
                $response['file_path'] = $file_path;
                $response['file_name'] = basename($file_path);
                $response['message'] = 'Agreement uploaded successfully!';
            } else {
                $response['error'] = 'File upload failed. Please try again.';
            }
        } catch (Exception $e) {
            $response['error'] = 'Upload error: ' . $e->getMessage();
        }

        echo json_encode($response);
    }

    public function fetch_projects()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $this->output->set_content_type('application/json');

        $company_id = $this->input->post('company_id', TRUE);
        if (!$company_id || !is_numeric($company_id)) {
            echo json_encode(['success' => FALSE, 'message' => 'Invalid company ID']);
            return;
        }

        $projects = $this->CommonModal->getRowByIdInOrder('projects', ['company_id' => $company_id, 'transaction_status' => '1', 'project_status' => 'Active'], 'id', 'DESC');
        if ($projects) {
            echo json_encode(['success' => TRUE, 'projects' => $projects]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No projects found']);
        }
    }

    public function fetch_bricks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $this->output->set_content_type('application/json');

        $company_id = $this->input->post('company_id', TRUE);
        $project_id = $this->input->post('project_id', TRUE);

        if (!$company_id || !is_numeric($company_id) || !$project_id) {
            echo json_encode(['success' => FALSE, 'message' => 'Invalid company or project ID']);
            return;
        }

        $bricks = $this->CommonModal->getSelectedBricks(['company_id' => $company_id, 'project_id' => $project_id]);

        if ($bricks) {
            echo json_encode(['success' => TRUE, 'bricks' => $bricks]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No bricks found']);
        }
    }

    // @Shiv Web Developer 07 July 2025

    public function fetchFundRequests()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);

        if (!$company_id || !is_numeric($company_id)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('fund_requests fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.funded_by', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', ['company_id' => $company_id, 'user_id' => sessionId('freelancer_id')]);
        $data['ActiveBricksFundReq'] = $this->CommonModal->getNumRows('fund_requests', ['company_id' => $company_id]);


        if ($query->num_rows() > 0) {
            $data['fund_requests'] = $query->result_array();
            $html = $this->load->view('search_filter_fund_request', $data); // Render view as string
            echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            echo json_encode(['success' => FALSE, 'html' => '<div>No fund requests found.</div>']);
        }
    }

    public function fetchFundRequestsproject()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        $currentProjectId = $this->input->post('currentProjectId', TRUE);

        // Validation
        if (!$company_id || !$currentProjectId || !is_numeric($company_id) || !is_numeric($currentProjectId)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company or project ID']);
            return;
        }

        // Main Query
        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('fund_requests fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.funded_by', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.id', 'left');  // Assuming this join is correct
        $this->db->where('fr.company_id', $company_id);
        $this->db->where('fr.project_id', $currentProjectId);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        // Count queries
        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'user_id' => sessionId('freelancer_id') // Make sure this function works as expected
        ]);

        $data['ActiveBricksFundReq'] = $this->CommonModal->getNumRows('fund_requests', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId
        ]);

        // Output
        if ($query->num_rows() > 0) {
            $data['fund_requests'] = $query->result_array();
            $html = $this->load->view('search_filter_fund_request', $data); // TRUE to render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            // echo json_encode(['success' => FALSE, 'html' => '<div>No fund requests found.</div>']);
            echo '<div>No fund requests found.</div>';
        }
    }

    public function fetchFundRequestsprojectbricks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        $currentProjectId = $this->input->post('currentProjectId', TRUE);
        $brick_id = $this->input->post('brick_id', TRUE);

        // Validation
        if (!$company_id || !$currentProjectId || !$brick_id || !is_numeric($company_id) || !is_numeric($currentProjectId) || !is_numeric($brick_id)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company or project ID']);
            return;
        }

        // Main Query
        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('fund_requests fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.funded_by', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.id', 'left');  // Assuming this join is correct
        $this->db->where('fr.company_id', $company_id);
        $this->db->where('fr.project_id', $currentProjectId);
        $this->db->where('fr.brick_id', $brick_id);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        // Count queries
        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'id' => $brick_id,
            'user_id' => sessionId('freelancer_id') // Make sure this function works as expected
        ]);

        $data['ActiveBricksFundReq'] = $this->CommonModal->getNumRows('fund_requests', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'brick_id' => $brick_id,
        ]);

        // Output
        if ($query->num_rows() > 0) {
            $data['fund_requests'] = $query->result_array();
            $html = $this->load->view('search_filter_fund_request', $data); // TRUE to render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            // echo json_encode(['success' => FALSE, 'html' => '<div>No fund requests found.</div>']);
            echo '<div>No fund requests found.</div>';
        }
    }



    public function fetchWorkAllotment()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        if (!$company_id || !is_numeric($company_id)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('brick_work_allotment fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.allotment_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', ['company_id' => $company_id, 'user_id' => sessionId('freelancer_id')]);
        $data['workAllotmentRequestcount'] = $this->CommonModal->getNumRows('brick_work_allotment', ['company_id' => $company_id]);


        if ($query->num_rows() > 0) {
            $data['brick_work_allotment'] = $query->result_array();
            $html = $this->load->view('search_filter_work_allotment', $data); // Render view as string
            echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            echo json_encode(['success' => FALSE, 'html' => '<div>No Work Allotment found.</div>']);
        }
    }

    public function fetchWorkallotmentproject()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }


        $company_id = $this->input->post('company_id', TRUE);
        $currentProjectId = $this->input->post('currentProjectId', TRUE);

        // Validation
        if (!$company_id || !$currentProjectId || !is_numeric($company_id) || !is_numeric($currentProjectId)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company or project ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('brick_work_allotment fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.allotment_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->where('fr.project_id', $currentProjectId);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        // Count queries
        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'user_id' => sessionId('freelancer_id') // Make sure this function works as expected
        ]);

        $data['workAllotmentRequestcount'] = $this->CommonModal->getNumRows('brick_work_allotment', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId
        ]);

        if ($query->num_rows() > 0) {
            $data['brick_work_allotment'] = $query->result_array();
            $html = $this->load->view('search_filter_work_allotment', $data); // Render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            echo '<div>No fund requests found.</div>';
            // echo json_encode(['success' => FALSE, 'html' => '<div>No Work Allotment found.</div>']);
        }
    }

    public function fetchWorkallotmentprojectbricks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        $currentProjectId = $this->input->post('currentProjectId', TRUE);
        $brick_id = $this->input->post('brick_id', TRUE);

        // Validation
        if (!$company_id || !$currentProjectId || !$brick_id || !is_numeric($company_id) || !is_numeric($currentProjectId) || !is_numeric($brick_id)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company or project ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('brick_work_allotment fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.allotment_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->where('fr.project_id', $currentProjectId);
        $this->db->where('fr.brick_id', $brick_id);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        // Count queries
        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'id' => $brick_id,
            'user_id' => sessionId('freelancer_id') // Make sure this function works as expected
        ]);

        $data['workAllotmentRequestcount'] = $this->CommonModal->getNumRows('brick_work_allotment', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'brick_id' => $brick_id,
        ]);

        if ($query->num_rows() > 0) {
            $data['brick_work_allotment'] = $query->result_array();
            $html = $this->load->view('search_filter_work_allotment', $data); // Render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            echo '<div>No fund requests found.</div>';
            // echo json_encode(['success' => FALSE, 'html' => '<div>No Work Allotment found.</div>']);
        }
    }

    // Bricks Consultancy

    public function fetchBrickConsultancy()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        if (!$company_id || !is_numeric($company_id)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('bricks_cosultancy fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.consultancy_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.brick_id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', ['company_id' => $company_id, 'user_id' => sessionId('freelancer_id')]);
        $data['BrickConsultacyCount'] = $this->CommonModal->getNumRows('bricks_cosultancy', ['company_id' => $company_id]);


        if ($query->num_rows() > 0) {
            $data['BrickConsultancyList'] = $query->result_array();
            $html = $this->load->view('search_filter_consultancy', $data); // Render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            // echo json_encode(['success' => FALSE, 'html' => '<div>No Consultancy found.</div>']);
            echo '<div>No fund requests found.</div>';
        }
    }
    public function fetchBrickConsultancyProject()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        $currentProjectId = $this->input->post('currentProjectId', TRUE);

        if (!$company_id || !$currentProjectId || !is_numeric($company_id) || !is_numeric($currentProjectId)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('bricks_cosultancy fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.consultancy_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.brick_id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->where('fr.project_id', $currentProjectId);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        // Count queries
        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'user_id' => sessionId('freelancer_id') // Make sure this function works as expected
        ]);

        $data['BrickConsultacyCount'] = $this->CommonModal->getNumRows('bricks_cosultancy', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId
        ]);

        if ($query->num_rows() > 0) {
            $data['BrickConsultancyList'] = $query->result_array();
            $html = $this->load->view('search_filter_consultancy', $data); // Render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            // echo json_encode(['success' => FALSE, 'html' => '<div>No Consultancy found.</div>']);
            echo '<div>No fund requests found.</div>';
        }
    }

    public function fetchBrickConsultancyProjectBricks()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $company_id = $this->input->post('company_id', TRUE);
        $currentProjectId = $this->input->post('currentProjectId', TRUE);
        $currentBrickId = $this->input->post('currentBrickId', TRUE);

        if (!$company_id || !$currentProjectId || !$currentBrickId || !is_numeric($company_id) || !is_numeric($currentProjectId) || !is_numeric($currentBrickId)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid company ID']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('bricks_cosultancy fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.consultancy_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.brick_id', 'left');  // new join
        $this->db->where('fr.company_id', $company_id);
        $this->db->where('fr.project_id', $currentProjectId);
        $this->db->where('fr.brick_id', $currentBrickId);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        // Count queries
        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'id' => $currentBrickId,
            'user_id' => sessionId('freelancer_id') // Make sure this function works as expected
        ]);

        $data['BrickConsultacyCount'] = $this->CommonModal->getNumRows('bricks_cosultancy', [
            'company_id' => $company_id,
            'project_id' => $currentProjectId,
            'brick_id' => $currentBrickId,
        ]);

        if ($query->num_rows() > 0) {
            $data['BrickConsultancyList'] = $query->result_array();
            $html = $this->load->view('search_filter_consultancy', $data); // Render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            // echo json_encode(['success' => FALSE, 'html' => '<div>No Consultancy found.</div>']);
            echo '<div>No fund requests found.</div>';
        }
    }


    // Consultancy Filter
    public function fetchConsultancyTypeFilter()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $consultancy_type = $this->input->post('consultancy_type', TRUE);
        if (!$consultancy_type || !is_string($consultancy_type)) {
            echo json_encode(['success' => FALSE, 'html' => 'Invalid Consultancy Type']);
            return;
        }

        $this->db->select('fr.*, f.name as freelancer_name, f.user_image, f.id as freelancer_id, b.brick_title');
        $this->db->from('bricks_cosultancy fr');
        $this->db->join('tbl_freelancer f', 'f.id = fr.consultancy_to', 'left');
        $this->db->join('tbl_bricks b', 'b.id = fr.brick_id', 'left');  // new join
        $this->db->where('fr.consultancy_type', $consultancy_type);
        $this->db->order_by('fr.id', 'DESC');
        $query = $this->db->get();

        $data['ActiveBricksCount'] = $this->CommonModal->getNumRows('tbl_bricks', ['user_id' => sessionId('freelancer_id')]);
        $data['BrickConsultacyCount'] = $this->CommonModal->getNumRows('bricks_cosultancy', ['consultancy_type' => $consultancy_type]);


        if ($query->num_rows() > 0) {
            $data['BrickConsultancyList'] = $query->result_array();
            $html = $this->load->view('search_filter_consultancy', $data); // Render view as string
            // echo json_encode(['success' => TRUE, 'html' => $html]);
        } else {
            // echo json_encode(['success' => FALSE, 'html' => '<div>No Consultancy found.</div>']);
            echo '<div>No requests found.</div>';
        }
    }



    // NEW EDIT FUNCTIONALITY METHODS

    // Update department name
    public function update_department_name()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $department_id = isset($data['department_id']) ? trim($data['department_id']) : null;
        $new_name = isset($data['name']) ? trim($data['name']) : null;

        if (empty($department_id) || empty($new_name)) {
            echo json_encode(['status' => 'error', 'message' => 'Department ID and name are required']);
            return;
        }

        try {
            $update_result = $this->CommonModal->updateRowById('tbl_departments', 'id', $department_id, ['name' => $new_name]);

            if ($update_result) {
                echo json_encode(['status' => 'success', 'message' => 'Department name updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update department name']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Add new department to existing structure
    public function add_new_department()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $company_id = isset($data['company_id']) ? trim($data['company_id']) : null;
        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;
        $department_name = isset($data['name']) ? trim($data['name']) : null;

        if (empty($department_name)) {
            echo json_encode(['status' => 'error', 'message' => 'Department name is required']);
            return;
        }

        if (empty($company_id) && empty($project_id) && empty($brick_id)) {
            echo json_encode(['status' => 'error', 'message' => 'At least one of Company, Project, or Brick ID is required']);
            return;
        }

        try {
            // Generate unique ID for new department
            $department_id = uniqid('dept_');

            $dept_data = [
                'id' => $department_id,
                'company_id' => $company_id,
                'project_id' => $project_id,
                'brick_id' => $brick_id,
                'name' => $department_name,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $insert_result = $this->CommonModal->insertRow('tbl_departments', $dept_data);

            if ($insert_result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Department added successfully',
                    'department' => [
                        'id' => $department_id,
                        'name' => $department_name,
                        'members' => [],
                        'agreements' => []
                    ]
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add department']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Delete department and its members
    public function delete_department()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $department_id = isset($data['department_id']) ? trim($data['department_id']) : null;

        if (empty($department_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Department ID is required']);
            return;
        }

        $this->db->trans_begin();

        try {
            // Delete team members in this department
            $this->CommonModal->deleteRowById('tbl_teamcompanymember', ['department_id' => $department_id]);

            // Delete department agreements
            $this->CommonModal->deleteRowById('tbl_department_agreements', ['department_id' => $department_id]);

            // Delete the department
            $delete_result = $this->CommonModal->deleteRowById('tbl_departments', ['id' => $department_id]);

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Database transaction failed');
            }

            $this->db->trans_commit();
            echo json_encode(['status' => 'success', 'message' => 'Department deleted successfully']);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Update team member details
    public function update_team_member()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $member_id = isset($data['member_id']) ? trim($data['member_id']) : null;
        $department_id = isset($data['department_id']) ? trim($data['department_id']) : null;
        $nickname = isset($data['nickname']) ? trim($data['nickname']) : null;
        $company_id = isset($data['company_id']) ? trim($data['company_id']) : null;
        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;

        if (empty($member_id) || empty($department_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Member ID and Department ID are required']);
            return;
        }

        try {
            $conditions = [
                'member_id' => $member_id,
                'department_id' => $department_id
            ];

            if ($company_id)
                $conditions['company_id'] = $company_id;
            if ($project_id)
                $conditions['project_id'] = $project_id;
            if ($brick_id)
                $conditions['brick_id'] = $brick_id;

            $update_data = ['nickname' => $nickname];

            $update_result = $this->CommonModal->updateRowByMoreId('tbl_teamcompanymember', $conditions, $update_data);

            if ($update_result) {
                echo json_encode(['status' => 'success', 'message' => 'Team member updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update team member']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Remove team member from department
    public function remove_team_member()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $raw_input = file_get_contents('php://input');
        $data = json_decode($raw_input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload']);
            return;
        }

        $member_id = isset($data['member_id']) ? trim($data['member_id']) : null;
        $department_id = isset($data['department_id']) ? trim($data['department_id']) : null;
        $company_id = isset($data['company_id']) ? trim($data['company_id']) : null;
        $project_id = isset($data['project_id']) ? trim($data['project_id']) : null;
        $brick_id = isset($data['brick_id']) ? trim($data['brick_id']) : null;

        if (empty($member_id) || empty($department_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Member ID and Department ID are required']);
            return;
        }

        try {
            $conditions = [
                'member_id' => $member_id,
                'department_id' => $department_id
            ];

            if ($company_id)
                $conditions['company_id'] = $company_id;
            if ($project_id)
                $conditions['project_id'] = $project_id;
            if ($brick_id)
                $conditions['brick_id'] = $brick_id;

            $delete_result = $this->CommonModal->deleteRowById('tbl_teamcompanymember', $conditions);

            if ($delete_result) {
                echo json_encode(['status' => 'success', 'message' => 'Team member removed successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to remove team member']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function create_tree(){
        // print_r($this->input->post()); die;

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $tree_data = [];
        $tree_data['tree_type'] = $this->input->post('tree_type');
        $tree_data['type_id'] = $this->input->post('type_id');
        $tree_data['user_id'] = sessionId('freelancer_id');
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

    public function medical_identity_trash() {
        $report_id = $this->input->get('id');
        
        $this->CommonModal->deleteRowById('medical_identity', [
            'id' => $report_id
        ]);

        $msg = 'Medical Report deleted.';

        $this->session->set_flashdata('taskMsg', '<div class="alert alert-danger">' . $msg . '</div>');

        redirect('company/medical-identity');
    }

    public function network_users(){
        $user_id = sessionId('freelancer_id');

        $users = $this->HomeModal->getUserConnections($user_id);

        echo json_encode($users);
        die;
    }
    // SAVE 

    public function send_connect_req()
    {
        // Read JSON safely
        $data = json_decode($this->input->raw_input_stream, true);

        if (!$data || empty($data['connect_user_id'])) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid request'
            ]);
            return;
        }

        $sender_id   = (int) sessionId('freelancer_id');
        $receiver_id = (int) $data['connect_user_id'];

        // Prevent self request
        if ($sender_id === $receiver_id) {
            echo json_encode([
                'status' => false,
                'message' => 'You cannot connect with yourself'
            ]);
            return;
        }

        // Check if connection already exists (both directions)
        $exists = $this->db
            ->where("(sender_id = {$sender_id} AND receiver_id = {$receiver_id}) 
                OR (sender_id = {$receiver_id} AND receiver_id = {$sender_id})")
            ->get('user_network_connections')
            ->row();

        if ($exists) {
            echo json_encode([
                'status' => false,
                'message' => 'Connection request already exists'
            ]);
            return;
        }

        // Insert request
        $insert = [
            'sender_id'   => $sender_id,
            'receiver_id' => $receiver_id,
            'status'      => 'pending',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $this->CommonModal->insertRow('user_network_connections', $insert);

        echo json_encode([
            'status'  => true,
            'message' => 'Connection request sent successfully'
        ]);
    }

    public function coordinates() {
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('coordinates');
        $this->load->view('includes/footer');
        $this->load->view('includes/footer-link');
    }

    public function event_management() {
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('includes/footer-link');
        $this->load->view('event_management');
        $this->load->view('includes/footer');
    }

    public function movie_pdf() {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $movie_id = $this->input->get('id');

        $movie = $this->CommonModal->getRowWhere('makemymovie', [
            'id' => $movie_id,
            'user_id' => sessionId('freelancer_id')
        ]);


        $timelines = $this->CommonModal->getRowsWhere('events_tree',[
            'movie_id' => $movie['id'],
            'user_id' => sessionId('freelancer_id')
        ]);

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
            'press_release' => 'calendar_press_release'
        ];
        
        foreach ($timelines as $timeline) {

            $timeline_id = $timeline['event_id'];

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

            $timeline_details['timeline_items'] = $timeline_items_final;

            $movie['events'][$timeline_id] = $timeline_details;
        }

        $data['movie'] = $movie;
    
        // Load library
        // $this->load->library('dompdf_gen');
        
        $html = $this->load->view('movie_pdf', $data, true);
        echo $html; die;
        
        // Setup dompdf
        // $this->dompdf_gen->loadHtml($html);
        // $this->dompdf_gen->setPaper('A4', 'portrait');
        // $this->dompdf_gen->render();

        // Output to browser
        // $this->dompdf_gen->stream("$movie[makemymoviename]'_movie_events.pdf", array("Attachment" => 0)); // 1 = download

    }

    public function get_calendar_timelines_view(){

        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id') ?? sessionId('admin_id');

        $data = [];
        $search_filter = $this->input->get('globally_search_filter');
        $searchType = $this->input->get('searchType');
        // var_dump($search_filter);
        // die;
        if($searchType == '1'){
            $master_timelines = $this->HomeModal->search_calender_events($search_filter,$user_id);
            // echo '<pre>';
            // var_dump($master_timelines);
            // die;
            $data['master_timelines'] = $master_timelines;
            $html = $this->load->view('calendar_timeline_table', $data, true);

        }else if($searchType == '2'){

            // ✅ If filters are applied, use custom query
            $this->db->select('*');
            $this->db->from('tbl_bricks');
            $this->db->where('brick_privacy', 'public');
            $this->db->where('brick_status !=', 'draft');
            $this->db->where('brick_status !=', 'trash');

            // GLOBALLY SEARCH FILTER FOR BRICKS
            if (!empty($search_filter)) {
                $keyword = $search_filter;

                // Get table fields automatically
                $columns = $this->db->list_fields('tbl_bricks');

                $this->db->group_start();
                foreach ($columns as $col) {
                    $this->db->or_like($col, $keyword);
                }
                $this->db->group_end();
            }

            $this->db->order_by('id', 'ASC');
            $data['getBricks'] = $this->db->get()->result_array(); // ✅ arrays
            $data['brickfilterSetup'] = $filters;

            // Return only HTML (for AJAX)
             $html = $this->load->view('search_results', $data, true);

        }else if($searchType == '3'){
            $press_releases = $this->HomeModal->search_press_release($search_filter);
            $data['press_releases'] = $press_releases;
            // print_r($press_release); die;
            $html = $this->load->view('press_release_results', $data, true);
        }else {
            echo 'invalid search type'; die;
        }
        
        echo $html;
    }

    public function save_political_data() {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $political_party_text = $this->input->post('political_party_text');

        $form_data = [
            'user_id' => sessionId('freelancer_id'),
            'political_party_text' => $political_party_text
        ];

        $data_id = $this->CommonModal->insertRowReturnId('police_court',$form_data);

        $res = [];

        if($data_id){

            $res = [
                'success' => true,
                'data_id' => $data_id
            ];

        }else {
            $res = [
                'success' => false,
                'data_id' => $data_id
            ];
        }
        echo json_encode($res);
    }

    public function get_political_data() {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $court_police_data = $this->CommonModal->getRowsWhere('police_court', [
            'user_id' => sessionId('freelancer_id')
        ]);

        echo json_encode($court_police_data);
    }

    public function update_political_data()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $id      = $this->input->post('id');
        $text    = $this->input->post('political_party_text');

        if (empty($id) || empty($text)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid data'
            ]);
            return;
        }

        // 🔒 Ownership check
        $exists = $this->CommonModal->getSingleRowById(
            'police_court',
            [
                'id' => $id,
                'user_id' => $user_id
            ]
        );

        if (!$exists) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $form_data = [
            'user_id' => sessionId('freelancer_id'),
            'political_party_text' => $text
        ];

        $updated = $this->CommonModal->updateRowById(
            'police_court',
            'id',
            $id,
            $form_data
            
        );

        echo json_encode([
            'success' => (bool) $updated
        ]);
    }

    public function delete_political_data()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $id      = $this->input->post('id');

        if (empty($id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid ID'
            ]);
            return;
        }

        // 🔒 Ownership check
        $exists = $this->CommonModal->getSingleRowById(
            'police_court',
            [
                'id' => $id,
                'user_id' => $user_id
            ]
        );

        if (!$exists) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $deleted = $this->CommonModal->deleteRowById(
            'police_court',
            [
                'id' => $id
            ]
        );

        echo json_encode([
            'success' => (bool) $deleted
        ]);
    }

    public function save_defence_data() {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $defence_text = $this->input->post('defence_text');

        $form_data = [
            'user_id' => sessionId('freelancer_id'),
            'defence_text' => $defence_text
        ];

        $data_id = $this->CommonModal->insertRowReturnId('defence_medical',$form_data);

        $res = [];

        if($data_id){

            $res = [
                'success' => true,
                'data_id' => $data_id
            ];

        }else {
            $res = [
                'success' => false,
                'data_id' => $data_id
            ];
        }
        echo json_encode($res);
    }

    public function get_defence_data() {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $defence_medical_data = $this->CommonModal->getRowsWhere('defence_medical', [
            'user_id' => sessionId('freelancer_id'),
            'medical_text' => null
        ]);

        echo json_encode($defence_medical_data);
    }

    public function update_defence_data()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $id      = $this->input->post('id');
        $text    = $this->input->post('defence_text');

        if (empty($id) || empty($text)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid data'
            ]);
            return;
        }

        // 🔒 Ownership check
        $exists = $this->CommonModal->getSingleRowById(
            'defence_medical',
            [
                'id' => $id,
                'user_id' => $user_id
            ]
        );

        if (!$exists) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $form_data = [
            'user_id' => sessionId('freelancer_id'),
            'defence_text' => $text
        ];

        $updated = $this->CommonModal->updateRowById(
            'defence_medical',
            'id',
            $id,
            $form_data
            
        );

        echo json_encode([
            'success' => (bool) $updated
        ]);
    }

    public function delete_defence_data()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $id      = $this->input->post('id');

        if (empty($id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid ID'
            ]);
            return;
        }

        // 🔒 Ownership check
        $exists = $this->CommonModal->getSingleRowById(
            'defence_medical',
            [
                'id' => $id,
                'user_id' => $user_id
            ]
        );

        if (!$exists) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $deleted = $this->CommonModal->deleteRowById(
            'defence_medical',
            [
                'id' => $id
            ]
        );

        echo json_encode([
            'success' => (bool) $deleted
        ]);
    }
    
    public function save_medical_data() {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $medical_text = $this->input->post('medical_text');

        $form_data = [
            'user_id' => sessionId('freelancer_id'),
            'medical_text' => $medical_text
        ];

        $data_id = $this->CommonModal->insertRowReturnId('defence_medical',$form_data);

        $res = [];

        if($data_id){

            $res = [
                'success' => true,
                'data_id' => $data_id
            ];

        }else {
            $res = [
                'success' => false,
                'data_id' => $data_id
            ];
        }
        echo json_encode($res);
    }

    public function get_medical_data() {

        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $defence_medical_data = $this->CommonModal->getRowsWhere('defence_medical', [
            'user_id' => sessionId('freelancer_id'),
            'defence_text' => null
        ]);

        echo json_encode($defence_medical_data);
    }

    public function update_medical_data()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $id      = $this->input->post('id');
        $text    = $this->input->post('medical_text');

        if (empty($id) || empty($text)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid data'
            ]);
            return;
        }

        // 🔒 Ownership check
        $exists = $this->CommonModal->getSingleRowById(
            'defence_medical',
            [
                'id' => $id,
                'user_id' => $user_id
            ]
        );

        if (!$exists) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $form_data = [
            'user_id' => sessionId('freelancer_id'),
            'medical_text' => $text
        ];

        $updated = $this->CommonModal->updateRowById(
            'defence_medical',
            'id',
            $id,
            $form_data
            
        );

        echo json_encode([
            'success' => (bool) $updated
        ]);
    }

    public function delete_medical_data()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        $id      = $this->input->post('id');

        if (empty($id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid ID'
            ]);
            return;
        }

        // 🔒 Ownership check
        $exists = $this->CommonModal->getSingleRowById(
            'defence_medical',
            [
                'id' => $id,
                'user_id' => $user_id
            ]
        );

        if (!$exists) {
            echo json_encode([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
            return;
        }

        $deleted = $this->CommonModal->deleteRowById(
            'defence_medical',
            [
                'id' => $id
            ]
        );

        echo json_encode([
            'success' => (bool) $deleted
        ]);
    }

    public function press_release_view(){
        $press_release_type = $this->uri->segment(1);
        $press_release_id = $this->uri->segment(3);

        $data = [];

        $press_release_details = $this->CommonModal->getRowWhere($press_release_type . '_press_release',[
            'id' => $press_release_id
        ]);

        if($press_release_type == 'user'){

            $author = $this->CommonModal->getRowWhere('freelancer',[
                'id' => $press_release_details['user_id']
            ]);

            $data['author'] = $author;

        }elseif($press_release_type == 'company'){
            $author = $this->CommonModal->getRowWhere('freelancer',[
                'id' => $press_release_details['user_id']
            ]);

            $company = $this->CommonModal->getRowWhere('companies',[
                'id' => $press_release_details['company_id']
            ]);

            $data['author'] = $author;
            $data['company'] = $company;

        }else if($press_release_type == 'project'){
            $author = $this->CommonModal->getRowWhere('freelancer',[
                'id' => $press_release_details['user_id']
            ]);
            
            $project = $this->CommonModal->getRowWhere('projects',[
                'id' => $press_release_details['project_id']
            ]);

            $company = $this->CommonModal->getRowWhere('companies',[
                'id' => $project['company_id']
            ]);

            $data['author'] = $author;
            $data['company'] = $company;
            $data['project'] = $project;

        }else {
            echo 'type is incorrect'; 
            redirect('/');
        }

        $data['press_release_details'] = $press_release_details;

        // echo '<pre>';
        // print_r($data); die;
        $this->load->view('press_release_view', $data);
    }

    public function project_added_valuation(){
        $getId = $this->input->get('id');

        if (empty($getId)) {
            redirect(base_url('company/project-profile'));
        }
        $data['getProject'] = $this->CommonModal->getSingleRowById('projects', 'id = ' . $getId);
        
        if ($data['getProject']['project_start_date']) {
            $financial_years = $this->getAllFinancialYearsTillDate($data['getProject']['project_start_date']);
            // print_r($financial_years); die;
            if (count($financial_years) > 0) {
                $data['getProject']['financial_years'] = $financial_years;
            }
        }

        $data['project_id'] = $getId;

        $financial_reports = $this->CommonModal->getRowsWhere('financial_reports', [
            'project_id' => $getId
        ]);

        $reportsByYear = [];

        foreach ($financial_reports as $row) {
            $reportsByYear[$row['financial_year']] = $row;
        }

        $data['reportsByYear'] = $reportsByYear;

        $this->load->view('projects/project_added_valuation', $data);
    }

    public function project_financial_year_reports() {

        $getId = $this->input->get('id');

        if (empty($getId)) {
            redirect(base_url('company/project-profile'));
        }
        $data['getProject'] = $this->CommonModal->getSingleRowById('projects', 'id = ' . $getId);
        
        if ($data['getProject']['project_start_date']) {
            $financial_years = $this->getAllFinancialYearsTillDate($data['getProject']['project_start_date']);
            // print_r($financial_years); die;
            if (count($financial_years) > 0) {
                $data['getProject']['financial_years'] = $financial_years;
            }
        }

        $data['project_id'] = $getId;

        $financial_reports = $this->CommonModal->getRowsWhere('financial_reports', [
            'project_id' => $getId
        ]);

        $reportsByYear = [];

        foreach ($financial_reports as $row) {
            $reportsByYear[$row['financial_year']] = $row;
        }

        $data['reportsByYear'] = $reportsByYear;
        // dd($data);
        $this->load->view('projects/project_financial_year_reports', $data);
    }

    public function project_cashflow_projection_booking() {

        $project_id = $this->input->get('id');

        $data = [];
        if(!empty($project_id)){
            $data['project_id'] = $project_id;

            $data['project_details'] = $this->CommonModal->getRowWhere('projects',[
                'id' => $project_id
            ]);

            $data['company_details'] = $this->CommonModal->getRowWhere('companies',[
                'id' => $data['project_details']['company_id']
            ]);
        }
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('projects/project_cashflow_projection_booking', $data);
        $this->load->view('includes/footer');
    }

    public function project_bid_over_booking() {

        $getId = $this->input->get('id');

        if (empty($getId)) {
            redirect(base_url('company/project-profile'));
        }
        $data['getProject'] = $this->CommonModal->getSingleRowById('projects', 'id = ' . $getId);
        
        if ($data['getProject']['project_start_date']) {
            $financial_years = $this->getAllFinancialYearsTillDate($data['getProject']['project_start_date']);
            // print_r($financial_years); die;
            if (count($financial_years) > 0) {
                $data['getProject']['financial_years'] = $financial_years;
            }
        }

        $data['project_id'] = $getId;

        $financial_reports = $this->CommonModal->getRowsWhere('financial_reports', [
            'project_id' => $getId
        ]);

        $reportsByYear = [];

        foreach ($financial_reports as $row) {
            $reportsByYear[$row['financial_year']] = $row;
        }

        $data['reportsByYear'] = $reportsByYear;

        $this->load->view('projects/project_bid_over_booking', $data);
    }

    // public function save_project_financial_report()
    // {
    //     // Auth
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //         return;
    //     }

    //     $project_id = $this->input->post('project_id');
    //     $year       = $this->input->post('year');
    //     $user_id    = sessionId('freelancer_id');

    //     // Validation
    //     if (empty($project_id) || empty($year)) {
    //         $this->session->set_flashdata('error', 'Invalid project or year');
    //         redirect($_SERVER['HTTP_REFERER']);
    //         return;
    //     }

    //     // File validation (correct key)
    //     if (empty($_FILES['financial_report_file']['name'])) {
    //         $this->session->set_flashdata('error', 'No file selected');
    //         redirect($_SERVER['HTTP_REFERER']);
    //         return;
    //     }

    //     // Build absolute upload path (NOT base_url)
    //     $upload_path = FCPATH . 'uploads/financial_reports/' . $project_id . '/' . $year . '/';

    //     if (!is_dir($upload_path)) {
    //         mkdir($upload_path, 0777, true);
    //     }

    //     // Upload config
    //     $config = [
    //         'upload_path'      => $upload_path,
    //         'allowed_types'    => 'pdf|xls|xlsx|doc|docx',
    //         'max_size'         => 10240, // KB = 10MB
    //         'encrypt_name'     => true,
    //         'file_ext_tolower' => true,
    //         'detect_mime'      => true,
    //     ];

    //     // $this->load->library('upload', $config);

    //     $this->upload->initialize($config, true);

    //     if (!$this->upload->do_upload('financial_report_file')) {
    //         $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
    //         redirect($_SERVER['HTTP_REFERER']);
    //         return;
    //     }

    //     $fileData = $this->upload->data();

    //     // Optional: Replace existing file for same project+year
    //     $existing = $this->db->get_where('tbl_financial_reports', [
    //         'project_id'     => $project_id,
    //         'financial_year' => $year
    //     ])->row_array();

    //     if ($existing) {
    //         // Delete old physical file
    //         if (!empty($existing['file_path']) && file_exists(FCPATH . $existing['file_path'])) {
    //             unlink(FCPATH . $existing['file_path']);
    //         }

    //         $this->db->where('id', $existing['id'])->update('tbl_financial_reports', [
    //             'file_name' => $fileData['file_name'],
    //             'file_path' => 'uploads/financial_reports/' . $project_id . '/' . $year . '/' . $fileData['file_name'],
    //             'user_id'   => $user_id,
    //             'created_at' => date('Y-m-d H:i:s'),
    //         ]);
    //     } else {
    //         // Insert new
    //         $this->CommonModal->insertRow('tbl_financial_reports', [
    //             'project_id'     => $project_id,
    //             'user_id'        => $user_id,
    //             'financial_year' => $year,
    //             'file_name'      => $fileData['file_name'],
    //             'file_path'      => 'uploads/financial_reports/' . $project_id . '/' . $year . '/' . $fileData['file_name'],
    //             'created_at'     => date('Y-m-d H:i:s'),
    //         ]);
    //     }

    //     $this->session->set_flashdata('success', 'Financial report uploaded successfully');
    //     redirect($_SERVER['HTTP_REFERER']);
    // }
    public function save_project_financial_report()
    {
        // Auth
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
            return;
        }

        $project_id = $this->input->post('project_id');
        $company_id = $this->input->post('company_id'); // NEW
        $year       = $this->input->post('year');
        $user_id    = sessionId('freelancer_id');

        // Validation: one of project_id or company_id must be present
        if (empty($year) || (empty($project_id) && empty($company_id))) {
            $this->session->set_flashdata('error', 'Invalid project/company or year');
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        // File validation
        if (empty($_FILES['financial_report_file']['name'])) {
            $this->session->set_flashdata('error', 'No file selected');
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        // Decide base folder + where clause based on target
        if (!empty($project_id)) {
            $targetType  = 'project';
            $targetId    = $project_id;
            $whereClause = ['project_id' => $project_id, 'financial_year' => $year];
            $dbDataBase  = ['project_id' => $project_id, 'company_id' => null];
        } else {
            $targetType  = 'company';
            $targetId    = $company_id;
            $whereClause = ['company_id' => $company_id, 'financial_year' => $year];
            $dbDataBase  = ['company_id' => $company_id, 'project_id' => null];
        }

        // Build upload path
        $upload_path = FCPATH . 'uploads/financial_reports/' . $targetType . '/' . $targetId . '/' . $year . '/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Upload config
        $config = [
            'upload_path'      => $upload_path,
            'allowed_types'    => 'pdf|xls|xlsx|doc|docx',
            'max_size'         => 10240,
            'encrypt_name'     => true,
            'file_ext_tolower' => true,
            'detect_mime'      => true,
        ];

        $this->load->library('upload');
        $this->upload->initialize($config, true);

        if (!$this->upload->do_upload('financial_report_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        $fileData = $this->upload->data();
        $relativePath = 'uploads/financial_reports/' . $targetType . '/' . $targetId . '/' . $year . '/' . $fileData['file_name'];

        // Replace existing for same target + year
        $existing = $this->db->get_where('tbl_financial_reports', $whereClause)->row_array();

        if ($existing) {
            if (!empty($existing['file_path']) && file_exists(FCPATH . $existing['file_path'])) {
                unlink(FCPATH . $existing['file_path']);
            }

            $this->db->where('id', $existing['id'])->update('tbl_financial_reports', array_merge($dbDataBase, [
                'file_name'   => $fileData['file_name'],
                'file_path'   => $relativePath,
                'user_id'     => $user_id,
                'created_at'  => date('Y-m-d H:i:s'),
            ]));
        } else {
            $this->CommonModal->insertRow('tbl_financial_reports', array_merge($dbDataBase, [
                'financial_year' => $year,
                'file_name'      => $fileData['file_name'],
                'file_path'      => $relativePath,
                'user_id'        => $user_id,
                'created_at'     => date('Y-m-d H:i:s'),
            ]));
        }

        $this->session->set_flashdata('success', ucfirst($targetType) . ' financial report uploaded successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function saveProjectPermission()
    {
        $this->savePermission();
    }

    public function saveBrickPermission()
    {
        $this->savePermission();
    }

    private function savePermission()
    {
        $entity_type = $this->input->post('entity_type');   // project / brick
        $entity_id   = $this->input->post('entity_id');
        $target_team = $this->input->post('target_team');   // company / project
        $enabled     = (int) $this->input->post('enabled');
        $permission  = $this->input->post('permission');    // viewer/editor/comment
        $created_by  = sessionId('freelancer_id');

        if (!$entity_type || !$entity_id || !$target_team) {
            echo json_encode(['success' => false, 'message' => 'Missing data']);
            return;
        }

        $where = [
            'entity_type' => $entity_type,
            'entity_id'   => $entity_id,
            'target_team' => $target_team
        ];

        if ($enabled) {
            $data = array_merge($where, [
                'permission' => $permission,
                'created_by' => $created_by
            ]);

            $exists = $this->db->get_where('tbl_permissions_new', $where)->row_array();

            if ($exists) {
                $this->db->where('id', $exists['id'])->update('tbl_permissions_new', [
                    'permission' => $permission
                ]);
            } else {
                $this->db->insert('tbl_permissions_new', $data);
            }
        } else {
            // Toggle OFF = remove permission
            $this->db->where($where)->delete('tbl_permissions_new');
        }

        echo json_encode(['success' => true]);
    }

    public function updateStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if (empty($id) || empty($status)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
            return;
        }

        // Allow only valid statuses
        if (!in_array($status, ['approved', 'cancelled'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid status value.'
            ]);
            return;
        }

        $updated = $this->HomeModal->updateAppointmentStatus($id, $status);

        if ($updated) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Database update failed.'
            ]);
        }
    }
}

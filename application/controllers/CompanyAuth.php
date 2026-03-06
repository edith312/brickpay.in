<?php
require_once APPPATH . '../vendor/autoload.php'; // Include Composer's autoloader

use Razorpay\Api\Api;

class CompanyAuth extends CI_Controller
{
    // Shiv Web Developer

    public function __construct()
    {
        parent::__construct();
        // echo sessionId('company_id');
        // if (sessionId('company_id')) {
        //     if(sessionId('profile_completed') == 0){
        //         redirect(base_url('company/profile'));
        //     }else{
        //         redirect(base_url('company/dashboard'));
        //     }
        // }
    }

    public function login()
    {
        $data['title'] = '';
        $this->load->view('includes/header-link', $data);
        $this->load->view('login');
    }

    public function send_company_otp()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['phone']) && !empty($post['phone'])) {
            $phone = $post['phone'];
            $get = $this->CommonModal->getSingleRowById('tbl_freelancer', "email = '$phone'");
            if ($get) {
                echo json_encode(['success' => false, 'message' => 'User already exists with this email']);
                return;
            }
            $user = true;
            if ($user) {
                $otp = mt_rand(100000, 999999);
                $this->CommonModal->insertRow('temp_otp', ['contact_no' => $phone, 'otp' => $otp]);
                $message = email_template_OTP($otp);
                $sendMail = newmail($phone, 'OTP | Brick Pay', $message);
                if ($sendMail) {
                    echo json_encode(['success' => true, 'message' => 'OTP has been sent to the email: <b>' . $phone . '</b> Please check your inbox']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Something went wrong while sending OTP. Please try again']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'We couldn\'t find an account with the email: <b>' . $phone . '</b> Please <a href="' . base_url('company/register') . '">create a new account</a> to proceed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Email not provided']);
        }
    }
    public function verify_company_otp()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['phone']) && isset($post['otp'])) {
            $phone = $post['phone'];
            $userOtp = +$post['otp'];

            $getOtp = $this->CommonModal->getSingleRowByIdInOrder('temp_otp', ['contact_no' => $phone], 'id', 'DESC');
            if ($getOtp && ($getOtp['otp'] == $userOtp)) {
                // Just verify OTP — don't insert yet
                echo json_encode(['success' => true, 'message' => 'OTP verified successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid OTP. Please try again or request a resend OTP']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phone and OTP required']);
        }
    }
    public function complete_registration()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if (empty($post['phone']) || empty($post['password']) || empty($post['confirm_password'])) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            exit();
        } else {
            if (isset($post['phone']) && isset($post['password']) && isset($post['confirm_password'])) {
                $phone = $post['phone'];
                $password = $post['password'];
                $confirmPassword = $post['confirm_password'];

                if ($password !== $confirmPassword) {
                    echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
                    return;
                }

                // Check if user already exists
                $get = $this->CommonModal->getSingleRowById('tbl_freelancer', "email = '$phone'");
                if ($get) {
                    echo json_encode(['success' => false, 'message' => 'User already exists']);
                    return;
                }

                // First User HumonToken BY00000000044
                $htoken = $this->CommonModal->getLastHumontoken(); // e.g. "BY0000000001"

                if ($htoken) {
                    // Remove prefix "BY" and convert to int
                    $num = (int)substr($htoken, 2); // "00000000001" -> 1
                    $num++;
                    // Pad number with leading zeros again
                    $humontoken = "BY" . str_pad($num, 11, "0", STR_PAD_LEFT);
                } else {
                    // First record
                    $humontoken = "BY00000000001";
                }


                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $companyData = [
                    'email' => $phone,
                    'password' => $hashedPassword,
                    'unhased_password' => $password,
                    'humontoken' => $humontoken,
                ];

                $user_id = $this->CommonModal->insertRowReturnId('tbl_freelancer', $companyData);
                // Create transaction record
                $transaction_data = array(
                    'user_id' => $user_id,
                    'type' => 'registration',
                    'reference_id' => $user_id,
                    'amount' => 1000.00
                );

                $this->FreelancerModal->freelancerLogin($user_id);
                $this->CommonModal->deleteRowById('temp_otp', "contact_no = '$phone'");

                echo json_encode(['success' => true, 'message' => 'Account created successfully', 'redirect' => base_url('company/dashboard')]);
            } else {
                echo json_encode(['success' => false, 'message' => 'All fields are required']);
            }
        }
    }
    public function userPayment()
    {
        $user_id = sessionId('freelancer_id');
        $razorpayOrder = $this->create_razorpay_order('11');
        $saveRazorPayId = $this->CommonModal->updateRowById('freelancer', 'id', $user_id, ['razorpay_order_id' => $razorpayOrder['order_id']]);
        echo json_encode([
            'success' => true,
            'razorpay_order_id' => $razorpayOrder['order_id'],
            'amount' => 500 * 100,
            'currency' => 'INR',
            'checkout_id' => $user_id,
            'st_razorpay_api_key' => RAZOR_KEY_ID
        ]);
    }

    public function user_Login()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if (isset($post['phone']) && isset($post['password'])) {
            $phone = $post['phone'];
            $password = $post['password'];

            $user = $this->CommonModal->getSingleRowById('tbl_freelancer', "email = '$phone'");

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Login success
                    $this->FreelancerModal->freelancerLogin($user['id']);
                    echo json_encode(['success' => true, 'message' => 'Login successful', 'redirect' => base_url('company/dashboard')]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid password']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'No account found with this email, Please <a href="' . base_url('company/login') . '">Create Account</a>']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phone and Password required']);
        }
    }

    private function create_razorpay_order($amount)
    {

        $api = new Api(RAZOR_KEY_ID, RAZOR_SECRET_KEY);

        try {
            $order = $api->order->create([
                'receipt' => 'order_rcptid_11',
                'amount' => $amount * 100, // Amount in paise
                'currency' => 'INR',
            ]);

            return ['success' => true, 'order_id' => $order->id];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function handle_payment_response()
    {
        $postData = json_decode(file_get_contents('php://input'), true);

        $razorpay_order_id = $postData['razorpay_order_id'];
        $razorpay_payment_id = $postData['razorpay_payment_id'];
        $razorpay_signature = $postData['razorpay_signature'];

        $api = new Api(RAZOR_KEY_ID, RAZOR_SECRET_KEY);

        try {
            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Update payment status in DB
            $this->CommonModal->updateRowById('freelancer', 'razorpay_order_id', $razorpay_order_id, ['transaction_status' => '1']);
            echo json_encode(['success' => true, 'message' => 'Payment successful']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()]);
        }
    }

    public function compnay_handle_payment_response()
    {
        $postData = json_decode(file_get_contents('php://input'), true);

        $razorpay_order_id = $postData['razorpay_order_id'];
        $razorpay_payment_id = $postData['razorpay_payment_id'];
        $razorpay_signature = $postData['razorpay_signature'];

        $api = new Api(RAZOR_KEY_ID, RAZOR_SECRET_KEY);

        try {
            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // 1. Get the company row using the order ID
            $company = $this->CommonModal->getRowById('companies', 'razorpay_order_id', $razorpay_order_id);
            if ($company) {
                $company_id = $company[0]['id']; // assuming getRowById returns an array of rows

                // 2. Update the payment status
                $this->CommonModal->updateRowById('companies', 'razorpay_order_id', $razorpay_order_id, [
                    'transaction_status' => '1'
                ]);

                // 3. Store company_id in session
                $this->session->set_userdata('company_id', $company_id);
            }


            echo json_encode(['success' => true, 'message' => 'Payment successful']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()]);
        }
    }

    public function project_handle_payment_response()
    {
        $postData = json_decode(file_get_contents('php://input'), true);

        $razorpay_order_id = $postData['razorpay_order_id'];
        $razorpay_payment_id = $postData['razorpay_payment_id'];
        $razorpay_signature = $postData['razorpay_signature'];

        $api = new Api(RAZOR_KEY_ID, RAZOR_SECRET_KEY);

        try {
            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // 1. Get the company row using the order ID
            $project = $this->CommonModal->getRowById('projects', 'razorpay_order_id', $razorpay_order_id);
            if ($project) {
                $project_id = $project[0]['id']; // assuming getRowById returns an array of rows

                // 2. Update the payment status
                $this->CommonModal->updateRowById('projects', 'razorpay_order_id', $razorpay_order_id, [
                    'transaction_status' => '1'
                ]);

                // 3. Store company_id in session
                $this->session->set_userdata('project_id', $project_id);
            }


            echo json_encode(['success' => true, 'message' => 'Payment successful']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()]);
        }
    }
}


// Shiv Web Developer
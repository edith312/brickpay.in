<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php'; // Include Composer's autoloader

use Razorpay\Api\Api;

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Project_model');
        require_once APPPATH . 'third_party/razorpay-php/Razorpay.php';
    }

    public function process($type, $transaction_id)
    {
        $transaction = $this->Payment_model->get_transaction($transaction_id);

        if (!$transaction || $transaction->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        $data['title'] = 'Process Payment';
        $data['transaction'] = $transaction;
        $data['key_id'] = RAZOR_KEY_ID;
        $data['callback_url'] = base_url('payment/callback/' . $transaction_id);
        $data['surl'] = base_url('payment/success/' . $transaction_id);
        $data['furl'] = base_url('payment/failed/' . $transaction_id);
        $data['currency_code'] = 'INR';

        $user = $this->User_model->get_user($transaction->user_id);
        $data['user'] = $user;

        $this->load->view('payment/process', $data);
    }

    public function callback($transaction_id)
    {
        $transaction = $this->Payment_model->get_transaction($transaction_id);

        if (!empty($this->input->post('razorpay_payment_id'))) {
            $payment_id = $this->input->post('razorpay_payment_id');

            // Verify payment
            $api = new Razorpay\Api\Api(RAZOR_KEY_ID, RAZOR_SECRET_KEY);
            try {
                $payment = $api->payment->fetch($payment_id);

                if ($payment->status == 'captured') {
                    $update_data = array(
                        'razorpay_payment_id' => $payment_id,
                        'razorpay_order_id' => $this->input->post('razorpay_order_id'),
                        'status' => 'success'
                    );

                    $this->Payment_model->update_transaction($transaction_id, $update_data);

                    // Update relevant records based on transaction type
                    switch ($transaction->type) {
                        case 'registration':
                            $this->User_model->update_user($transaction->reference_id, array('is_active' => 1));
                            break;
                        case 'company':
                            $this->Company_model->update_company($transaction->reference_id, array('status' => 'active'));
                            break;
                        case 'project':
                            $this->Project_model->update_project($transaction->reference_id, array('status' => 'active'));
                            break;
                    }

                    redirect('payment/success/' . $transaction_id);
                }
            } catch (Exception $e) {
                $this->Payment_model->update_transaction($transaction_id, array('status' => 'failed'));
                redirect('payment/failed/' . $transaction_id);
            }
        }
    }

    public function success()
    {
        $data['title'] = 'Payment Success';
        // $data['transaction'] = $this->Payment_model->get_transaction($transaction_id);
        $this->load->view('payment/success', $data);
    }

    public function failed($transaction_id)
    {
        $data['title'] = 'Payment Failed';
        $data['transaction'] = $this->Payment_model->get_transaction($transaction_id);
        $this->load->view('payment/failed', $data);
    }

    public function transactions()
    {
        $data['title'] = 'Transaction History';
        $data['transactions'] = $this->Payment_model->get_user_transactions($this->session->userdata('user_id'));
        $this->load->view('payment/transactions', $data);
    }
}

<?php

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('pagination');
    }

    public function index() {

        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('includes/footer-link');
        $this->load->view('products/index');
        $this->load->view('includes/footer');
    }

    public function ajax_list() {        
        $this->load->library('pagination');
        $page = $this->input->post('page');

        $products = $this->Product_model->getProducts($page);
        $data['products'] = $products;
        // dd($data['products']);
        $html = $this->load->view('products/list', $data, true);

        $res = [
            'success' => true,
            'html' => $html
        ];
        
        echo json_encode($res);
    }

    public function my_ajax_list() {
        $page = $this->input->post('page');
        $user_id = sessionId('freelancer_id');

        $products = $this->Product_model->getProducts($page, $user_id);
        $data['products'] = $products;
        // dd($data['products']);
        $html = $this->load->view('products/list', $data, true);

        $res = [
            'success' => true,
            'html' => $html
        ];
        
        echo json_encode($res);
    }

    public function add() {
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('includes/footer-link');
        $this->load->view('products/form');
        $this->load->view('includes/footer');
    }

    public function save()
    {
        $this->load->model('Product_model');
        $user_id = sessionId('freelancer_id');

        $data = $this->input->post();
        $data['user_id'] = $user_id;

        // Image Upload
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $data['image'] = $uploadData['file_name'];
            }
        }
        
        $this->db->insert('tbl_products', $data);

        redirect('products');
    }
}

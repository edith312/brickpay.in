<?php

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Cart_model');
    }

    public function index() {
        $cart_count = $this->Cart_model->cart_count($user_id);
        $data['cart_count'] = $cart_count;
        
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
            $config['upload_path'] = FCPATH . 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';

            $this->load->library('upload');

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $data['image'] = $uploadData['file_name'];
            }
        }
        
        $this->db->insert('tbl_products', $data);

        redirect('products');
    }

    public function product_view(){

        $slug = $this->uri->segment(3);

        $product = $this->CommonModal->getSingleRowById('products', [
            'slug' => $slug
        ]);
        $data['product'] = $product;
        // dd($product);
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('includes/footer-link');
        $this->load->view('products/view');
        $this->load->view('includes/footer');
    }
}

<?php

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Cart_model');
        $this->load->model('Wishlist_model');
        $this->load->model('Review_model');
    }

    public function index() {
        // ==========================
        // AUTH
        // ==========================
        if (!sessionId('freelancer_id') && !sessionId('admin_id')) {
            redirect(base_url(''));
        }
        $user_id = sessionId('freelancer_id');

        $cart_count = $this->Cart_model->cart_count($user_id);

        $wishlist_count = $this->CommonModal->countRowsByCondition('tbl_wishlist', [
            'user_id' => $user_id
        ]);

        $my_product_count = $this->CommonModal->countRowsByCondition('tbl_products', [
            'user_id' => $user_id
        ]);

        $data['cart_count'] = $cart_count;
        $data['wishlist_count'] = $wishlist_count;
        $data['my_product_count'] = $my_product_count;
        
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

        $products = $this->Product_model->getMyProducts($page, $user_id);
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
        $id = $this->uri->segment(3);
        $data = [];
        if($id){    
            $product = $this->CommonModal->getSingleRowById('products', ['id' => $id]);
            $data['product'] = $product;
        }
        // dd($data);
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
        $id = $this->input->post('id');

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

                // delete old image (only in edit)
                if ($id) {
                    $old = $this->db->get_where('tbl_products', [
                        'id' => $id,
                        'user_id' => $user_id
                    ])->row_array();

                    if (!empty($old['image'])) {
                        $oldPath = FCPATH . 'uploads/product_images/' . $old['image'];
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                }
            }
        }

        if ($id) {
            // 🔥 UPDATE
            unset($data['id']); // safety

            $this->db->where('id', $id);
            $this->db->where('user_id', $user_id);
            $this->db->update('tbl_products', $data);

        } else {
            // 🔥 INSERT
            $this->db->insert('tbl_products', $data);
        }

        redirect('products');
    }

    public function product_view(){

        $slug = $this->uri->segment(3);

        $product = $this->CommonModal->getSingleRowById('products', [
            'slug' => $slug
        ]);

        $user_id = sessionId('freelancer_id');

        $cart_count = $this->Cart_model->cart_count($user_id);

        $wishlist_count = $this->CommonModal->countRowsByCondition('tbl_wishlist', [
            'user_id' => $user_id
        ]);

        $my_product_count = $this->CommonModal->countRowsByCondition('tbl_products', [
            'user_id' => $user_id
        ]);

        $wishlist = $this->CommonModal->getSingleRowById('tbl_wishlist', [
            'product_id' => $product['id'],
            'user_id' => $user_id
        ]);
        
        $data['wishlist_status'] = !empty($wishlist) ? 1 : 0;

        $data['cart_count'] = $cart_count;
        $data['wishlist_count'] = $wishlist_count;
        $data['my_product_count'] = $my_product_count;
        $data['product'] = $product;

        $reviews = $this->Review_model->getByProduct($product['id']);
    
        $avg_rating = $this->Review_model->getAverage($product['id']);
        $data['avg_rating'] = round($avg_rating, 1);
        
        $review_count = count($reviews);
        $data['review_count'] = $review_count;

        $data['reviews'] = $reviews;
        $data['avg_rating'] = round($avg_rating, 1);

        // dd($product);
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('includes/footer-link');
        $this->load->view('products/view');
        $this->load->view('includes/footer');
    }

    public function edit()
    {
        $this->load->model('Product_model');

        $user_id = sessionId('freelancer_id');
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Invalid ID']);
            return;
        }

        $data = $this->input->post();
        unset($data['id']); // remove id from update array

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

        // IMPORTANT: WHERE condition
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id); // security
        $update = $this->db->update('tbl_products', $data);

        echo json_encode(['success' => $update]);
    }

    public function delete()
    {
        $user_id = sessionId('freelancer_id');
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['success' => false]);
            return;
        }

        // Optional: delete image also
        $product = $this->db->get_where('tbl_products', [
            'id' => $id,
            'user_id' => $user_id
        ])->row_array();

        if (!$product) {
            echo json_encode(['success' => false]);
            return;
        }

        // delete image file
        if (!empty($product['image'])) {
            $path = FCPATH . 'uploads/product_images/' . $product['image'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $delete = $this->db->delete('tbl_products');

        echo json_encode(['success' => $delete]);
    }

}

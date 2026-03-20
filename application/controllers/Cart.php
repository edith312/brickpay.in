<?php

class Cart extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Cart_model');
    }

    public function index()
    {
        $user_id = sessionId('freelancer_id');

        // Get cart items
        $cart_items = $this->Cart_model->get_cart($user_id);
        $cart_count = $this->Cart_model->cart_count($user_id);
        // Calculate total
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $data['cart']  = $cart_items;
        $data['total'] = $total;
        $data['cart_count'] = $cart_count;
        
        $this->load->view('includes/header');
        $this->load->view('includes/header-link', $data);
        $this->load->view('includes/footer-link');
        $this->load->view('cart/index');
        $this->load->view('includes/footer');
        
    }

    public function add()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode(['success' => false, 'message' => 'Login required']);
            return;
        }
       
        $user_id = sessionId('freelancer_id');
        $product_id = $this->input->post('product_id');

        $product = $this->db->get_where('tbl_products', ['id' => $product_id])->row();

        $data = [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'price' => $product->price,
            'quantity' => 1
        ];

        $this->Cart_model->add_to_cart($data);

        echo json_encode([
            'success' => true
        ]);
    }

    public function get_cart()
    {

        $user_id = $sessionId('freelancer_id');

        $cart = $this->Cart_model->get_cart($user_id);

        echo json_encode($cart);
    }

    public function update()
    {

        $id = $this->input->post('id');
        $qty = $this->input->post('qty');

        $this->Cart_model->update_qty($id, $qty);

        echo json_encode(['success' => true]);
    }

    public function remove()
    {

        $id = $this->input->post('id');

        $this->Cart_model->remove_item($id);

        echo json_encode(['success' => true]);
    }
}
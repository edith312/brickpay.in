<?php

class Wishlist extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Wishlist_model');
    }

    public function add_remove() {
        $data = [];
        $res = [];

        $product_id = $this->input->post('id');
        $user_id = sessionId('freelancer_id');

        $wishlist = $this->CommonModal->getSingleRowById('tbl_wishlist',[
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);

        if(!empty($wishlist)){
            $delete = $this->CommonModal->deleteRowById('tbl_wishlist',[
                'product_id' => $product_id,
                'user_id' => $user_id
            ]);
            if($delete){
                $res = [
                    'success' => true,
                    'msg' => 'removed from wishlist'
                ];
            }else{
                $res = [
                    'success' => false,
                    'msg' => 'failed remove from wishlist'
                ];
            }
        }else {

            $data = [
                'product_id' => $product_id,
                'user_id' => $user_id
            ];

            $insert = $this->CommonModal->insertRow('tbl_wishlist', $data);
            if($insert){
                $res = [
                    'success' => true,
                    'msg' => 'added in wishlist'
                ];
            }else{
                $res = [
                    'success' => false,
                    'msg' => 'failed to add in wishlist'
                ];
            }
        }

        echo json_encode($res);
    }

    public function get() {

        $user_id = sessionId('freelancer_id');

        $products = $this->Wishlist_model->get_wishlist($user_id); 

        $data['products'] = $products;

        $html = $this->load->view('products/list', $data, true);
        
        $res = [
            'success' => true,
            'html' => $html
        ];

        echo json_encode($res);
    }
}
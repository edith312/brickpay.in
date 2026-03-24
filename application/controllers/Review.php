<?php

class Review extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Review_model');
    }

    public function add_review()
    {
        $user_id = sessionId('freelancer_id');
        $product_id = $this->input->post('product_id');
        $rating = $this->input->post('rating');
        $comment = $this->input->post('comment');

        $this->load->model('Review_model');

        $result = $this->Review_model->addOrUpdate(
            $user_id,
            $product_id,
            $rating,
            $comment
        );

        // ✅ Fetch full review with user data
        $review = $this->Review_model->getSingleReview($user_id, $product_id);

        $html = $this->load->view('reviews/_single_review', ['review' => $review], true);

        echo json_encode([
            'success' => true,
            'msg' => $result['msg'],
            'html' => $html,
            'user_id' => $user_id
        ]);
    }
}
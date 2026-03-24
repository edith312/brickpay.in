<?php

class Review_model extends CI_Model
{
    public function addOrUpdate($user_id, $product_id, $rating, $comment)
    {
        $exists = $this->db->where([
            'product_id' => $product_id,
            'user_id' => $user_id
        ])->get('tbl_reviews')->row_array();

        if ($exists) {

            $this->db->where([
                'product_id' => $product_id,
                'user_id' => $user_id
            ])->update('tbl_reviews', [
                'rating' => $rating,
                'comment' => $comment
            ]);

            return [
                'success' => true,
                'status' => 'updated',
                'msg' => 'Review updated'
            ];
        } else {

            $this->db->insert('tbl_reviews', [
                'product_id' => $product_id,
                'user_id' => $user_id,
                'rating' => $rating,
                'comment' => $comment
            ]);

            return [
                'success' => true,
                'status' => 'added',
                'msg' => 'Review added'
            ];
        }
    }

    public function getSingleReview($user_id, $product_id)
    {
        return $this->db
            ->select('r.*, f.name as user_name, f.user_image as user_image')
            ->from('tbl_reviews r')
            ->join('freelancer f', 'f.id = r.user_id', 'left')
            ->where([
                'r.user_id' => $user_id,
                'r.product_id' => $product_id
            ])
            ->get()
            ->row_array();
    }

    public function getByProduct($product_id)
    {
        return $this->db
            ->select('r.*, f.name as user_name, f.user_image as user_image')
            ->from('tbl_reviews r')
            ->join('freelancer f', 'f.id = r.user_id', 'left')
            ->where('r.product_id', $product_id)
            ->order_by('r.id', 'DESC')
            ->get()
            ->result_array();
    }

    public function getAverage($product_id){
        return $this->db->select_avg('rating')
                        ->where('product_id', $product_id)
                        ->get('tbl_reviews')
                        ->row()->rating;
    }

}
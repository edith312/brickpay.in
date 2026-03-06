<?php

class FreelancerModal extends CI_Model
{

    // Shiv Web Developer
    public function freelancerLogin($user_id)
    {
        $get = $this->CommonModal->getSingleRowById('tbl_freelancer', "id = '$user_id'");

        setSession(array(
            'freelancer_id' => $user_id,
        ));
    }
}

// Shiv Web Developer
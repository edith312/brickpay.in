<?php

class CompanyModal extends CI_Model
{

    // Shiv Web Developer
    public function companyLogin($user_id)
    {
        $get = $this->CommonModal->getSingleRowById('companies', "id = '$user_id'");

        setSession(array(
            'company_id' => $user_id,
            'profile_completed' => $get['profile_completed'],
        ));
    }
    public function get_profile_completion($user_id)
    {
        $user = $this->CommonModal->getSingleRowById('companies', "id = '$user_id'");

        $required_fields = ['ciin_number', 'director_name', 'director_number', 'company_name', 'director_email', 'category', 'about_us', 'mission', 'vision', 'location'];
        $filled_fields = 0;

        foreach ($required_fields as $field) {
            if (!empty($user[$field])) {
                $filled_fields++;
            }
        }

        $progress = round(($filled_fields / count($required_fields)) * 100);

        return $progress;
    }


    // Shiv Web Developer

}

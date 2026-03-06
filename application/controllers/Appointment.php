<?php

class Appointment extends CI_Controller {

    public function store()
    {
        $this->load->model('Appointment_model');

        $company_id     =    $this->input->post('company_id');
        $project_id     =    $this->input->post('project_id');
        $start          =    $this->input->post('start_datetime');
        $end            =    $this->input->post('end_datetime');
        $notes          =    $this->input->post('notes');
        $bid_cur        =    $this->input->post('bid_cur');
        $bid_amount     =    $this->input->post('bid_amount');
        $barter_bid     =    $this->input->post('barter_bid');

        if (!$company_id || !$start || !$end) {
            echo json_encode([
                'success' => false,
                'message' => 'All fields required'
            ]);
            return;
        }

        // Validate start < end
        if (strtotime($start) >= strtotime($end)) {
            echo json_encode([
                'success' => false,
                'message' => 'End time must be greater than start time'
            ]);
            return;
        }

        // Check overlapping booking
        $conflict = $this->Appointment_model->check_conflict(
            $company_id,
            $start,
            $end
        );

        if ($conflict) {
            echo json_encode([
                'success' => false,
                'message' => 'This time slot is already booked!'
            ]);
            return;
        }

        $data = [
            'user_id'       => sessionId('freelancer_id'),
            'company_id'    => $company_id,
            'project_id'    => $project_id,
            'start_datetime'=> $start,
            'end_datetime'  => $end,
            'notes'         => $notes,
            'status'        => 'pending',
            'bid_curr'      => $bid_cur,
            'bid_amount'    => $bid_amount,
            'barter_bid'    => $barter_bid
        ];

        $this->Appointment_model->insert($data);

        echo json_encode(['success' => true]);
    }
}
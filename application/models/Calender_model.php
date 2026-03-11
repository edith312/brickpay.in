<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calender_model extends CI_Model
{
    public function getOrCreateTimeline(array $data)
    {
        // ==========================
        // REQUIRED KEYS (DEFENSIVE)
        // ==========================
        
        $required = [];

        if($data['schedule_type'] == 0){
            $required = [
                'user_id',
                'date',
                'opening_time',
                'closing_time',
                'schedule_type'
            ];
        }
        
        if($data['schedule_type'] == 1){
            $required = [
                'user_id',
                'schedule_type'
            ];
        }
        
        // dd($data);
        foreach ($required as $key) {
            if (!array_key_exists($key, $data)) {
                throw new Exception("Missing key: {$key}");
            }
        }

        // ==========================
        // CHECK IF TIMELINE EXISTS
        // ==========================
        if($data['schedule_type'] == 0){
            $this->db->where('user_id', $data['user_id'])
                 ->where('schedule_type', $data['schedule_type'])
                 ->where('date', $data['date']);


            // Fixed schedule → match time slot
            if ($data['schedule_type'] === 0) {
                $this->db->where('opening_time', $data['opening_time'])
                        ->where('closing_time', $data['closing_time']);
            }
            
            $query = $this->db->get('tbl_calendar_timeline_master');

            if ($query->num_rows() > 0) {

                $existingId = (int) $query->row()->id;

                $this->db->where('id', $existingId);
                $this->db->update('tbl_calendar_timeline_master', [
                    'timeline_type' => $data['timeline_type']
                ]);

                return $existingId;
            }
        }

        // ==========================
        // CREATE NEW TIMELINE
        // ==========================
        $insert = [
            'user_id'       => $data['user_id'],
            'date'          => $data['date'],
            'opening_time'  => $data['schedule_type'] == 0 ? $data['opening_time'] : null,
            'closing_time'  => $data['schedule_type'] == 0 ? $data['closing_time'] : null,
            'schedule_type' => $data['schedule_type'],
            'finaldatetime' => $data['finaldatetime'] ?? null,
            'timeline_type' => $data['timeline_type'],
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
        ];
        // dd($insert);
        if($data['company_id']){
            $insert['company_id'] = $data['company_id'];
        }elseif($data['project_id']){
            $insert['project_id'] = $data['project_id'];
        }
        // dd($insert);
        $this->db->insert('tbl_calendar_timeline_master', $insert);

        return (int) $this->db->insert_id();
    }

    public function getTimelineWithItems($params)
    {
        // 1️⃣ Get timeline master
        $this->db->where('user_id', $params['user_id'])
                ->where('date', $params['date'])
                ->where('schedule_type', $params['schedule_type']);

        if ($params['schedule_type'] === 0) {
            $this->db->where('opening_time', $params['opening_time'])
                    ->where('closing_time', $params['closing_time']);
        } else {
            $this->db->where('opening_time IS NULL', null, false)
                    ->where('closing_time IS NULL', null, false);
        }

        $timeline = $this->db->get('tbl_calendar_timeline_master')->row();

        if (!$timeline) {
            return null;
        }

        // 2️⃣ Get ordered timeline items
        $items = $this->db
            ->where('timeline_id', $timeline->id)
            ->order_by('position', 'ASC')
            ->get('tbl_calendar_timeline_items')
            ->result();

        return [
            'timeline' => $timeline,
            'items'    => $items
        ];
    }

    public function saveOrUpdateVideo($data, $edit_id = null)
    {
        if ($edit_id) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $data['user_id'])
                    ->update('tbl_calendar_video', $data);
            return $edit_id;
        } else {
            $this->db->insert('tbl_calendar_video', $data);
            return $this->db->insert_id();
        }
    }

    public function saveOrUpdateImage($data, $edit_id = null)
    {
        if ($edit_id) {
            $this->db->where('id', $edit_id)
                    ->where('user_id', $data['user_id'])
                    ->update('tbl_calendar_image', $data);
            return $edit_id;
        } else {
            $this->db->insert('tbl_calendar_image', $data);
            return $this->db->insert_id();
        }
    }

    public function syncTimelineItems($new_timeline_item, $user_id, $timeline_items, $insertId)
    {   
        // dp($new_timeline_item);
        // dp($user_id);
        // dp($timeline_items);
        // dp($insertId);
        // Re-insert with correct content_id
        $contentId = null;

        if(!empty($insertId)){
            $contentId = $insertId;
        }
        
        $this->db->update('tbl_calendar_timeline_items', [
            'content_id' => $contentId
        ], [
            'id' => $new_timeline_item
        ]);
    }

    // Calendar_model.php

    public function getTimelineItemsMap($timelineId, $user_id)
    {
        $rows = $this->db
            ->where('timeline_id', $timelineId)
            ->where('user_id', $user_id)
            ->get('tbl_calendar_timeline_items')
            ->result_array();

        $map = [];

        foreach ($rows as $row) {
            $key = $row['content_type'] . '_' . ($row['content_id'] ?? 'new_' . $row['id']);
            $map[$key] = $row;
        }

        return $map;
    }

    public function insertTimelineItemIfNotExists($timelineId, $user_id, $type, $content_id = null)
    {
        $this->db->insert('tbl_calendar_timeline_items', [
            'timeline_id'  => $timelineId,
            'user_id'      => $user_id,
            'content_type' => $type,
            'content_id'   => $content_id,
            // position removed 👈
        ]);

        return $this->db->insert_id();
    }

}

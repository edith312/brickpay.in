<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserReportModel extends CI_Model
{

    // @ Shiv Web Developer
    // List all possible user-related foreign key columns here
    private $user_columns = [
        'user_id',
        'consultancy_by',
        'created_by',
        'voting_by',
        'allotment_by',
        'funded_by',
        'shared_by',
        'member_id'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all tables and their user-related columns that exist in the database
     * @return array Format: [ 'table_name' => ['column1', 'column2', ...], ... ]
     */
    private function get_user_tables_and_columns()
    {
        $db_name = $this->db->database;

        // Prepare placeholders for IN clause
        $placeholders = implode(',', array_fill(0, count($this->user_columns), '?'));

        $sql = "SELECT TABLE_NAME, COLUMN_NAME 
                FROM information_schema.COLUMNS 
                WHERE TABLE_SCHEMA = ? 
                AND COLUMN_NAME IN ($placeholders)";

        $params = array_merge([$db_name], $this->user_columns);

        $query = $this->db->query($sql, $params);
        $result = $query->result();

        $tables = [];
        foreach ($result as $row) {
            $tables[$row->TABLE_NAME][] = $row->COLUMN_NAME;
        }

        return $tables;
    }

    /**
     * Get approximate database size (in bytes) used by user across all tables and user-related columns
     * @param int $user_id
     * @return int total bytes
     */
    public function get_user_db_size($user_id)
    {
        $total_size = 0;
        $tables = $this->get_user_tables_and_columns();

        foreach ($tables as $table => $user_cols) {
            // Get all columns of the table
            $cols_query = $this->db->query(
                "SELECT COLUMN_NAME, DATA_TYPE 
                 FROM information_schema.COLUMNS 
                 WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?",
                [$this->db->database, $table]
            );
            $columns = $cols_query->result();

            // Build list of columns excluding user-related columns (to sum their sizes)
            $data_columns = array_filter($columns, function ($col) use ($user_cols) {
                return !in_array($col->COLUMN_NAME, $user_cols);
            });

            if (empty($data_columns)) {
                continue; // no columns to sum
            }

            // Build SQL expressions to sum size of each data column
            $length_expressions = [];
            foreach ($data_columns as $col) {
                $col_name = $col->COLUMN_NAME;
                $data_type = strtolower($col->DATA_TYPE);

                if (in_array($data_type, ['char', 'varchar', 'text', 'tinytext', 'mediumtext', 'longtext'])) {
                    $length_expressions[] = "LENGTH(`$col_name`)";
                } elseif (in_array($data_type, ['int', 'tinyint', 'smallint', 'mediumint', 'bigint', 'float', 'double', 'decimal'])) {
                    $size_bytes = 4;
                    if (in_array($data_type, ['bigint'])) $size_bytes = 8;
                    if (in_array($data_type, ['float', 'double', 'decimal'])) $size_bytes = 8;
                    $length_expressions[] = "$size_bytes";
                } elseif (in_array($data_type, ['date', 'datetime', 'timestamp', 'time', 'year'])) {
                    $length_expressions[] = "8";
                } else {
                    $length_expressions[] = "0";
                }
            }

            if (empty($length_expressions)) continue;

            $length_sum_expr = implode(' + ', $length_expressions);

            // For each user-related column in this table, sum sizes of rows where column = $user_id
            foreach ($user_cols as $user_col) {
                $sql = "SELECT SUM($length_sum_expr) as total_size FROM `$table` WHERE `$user_col` = ?";
                $query = $this->db->query($sql, [$user_id]);
                $row = $query->row();
                if ($row && $row->total_size !== null) {
                    $total_size += (int)$row->total_size;
                }
            }
        }

        return $total_size;
    }

    /**
     * Get total file size (in bytes) used by user in uploads folder
     * @param int $user_id
     * @return int total bytes
     */
    // public function get_user_file_size($user_id)
    // {
    //     $upload_path = FCPATH . "uploads/user_profile/{$user_id}/";
    //     return $this->get_folder_size($upload_path);
    // }


    /**
     * Get total file size (in bytes) used by user in multiple upload folders
     * @param int $user_id
     * @return int total bytes
     */

    // public function get_user_file_size($user_id)
    // {
    //     $folders = [
    //         FCPATH . "uploads/user_profile/{$user_id}/",
    //         FCPATH . "uploads/age_block_documents/{$user_id}/",
    //         FCPATH . "uploads/age_block_images/{$user_id}/",
    //         FCPATH . "uploads/age_block_videos/{$user_id}/",
    //         FCPATH . "uploads/agreements/{$user_id}/",
    //         FCPATH . "uploads/brick_doc/{$user_id}/",
    //         FCPATH . "uploads/project_doc/{$user_id}/"
    //     ];
    //     $total_size = 0;
    //     foreach ($folders as $folder) {
    //         $total_size += $this->get_folder_size($folder);
    //     }
    //     return $total_size;
    // }


    /**
     * Recursively get folder size in bytes
     * @param string $folder
     * @return int
     */
    // private function get_folder_size($folder)
    // {
    //     $size = 0;
    //     if (!is_dir($folder)) {
    //         return 0;
    //     }
    //     foreach (scandir($folder) as $file) {
    //         if ($file === '.' || $file === '..') continue;
    //         $path = $folder . DIRECTORY_SEPARATOR . $file;
    //         if (is_file($path)) {
    //             $size += filesize($path);
    //         } elseif (is_dir($path)) {
    //             $size += $this->get_folder_size($path);
    //         }
    //     }
    //     return $size;
    // }

    // private function get_folder_size($folder)
    // {
    //     $size = 0;
    //     if (!is_dir($folder)) {
    //         return 0;
    //     }
    //     foreach (scandir($folder) as $file) {
    //         if ($file === '.' || $file === '..') continue;
    //         $path = $folder . DIRECTORY_SEPARATOR . $file;
    //         if (is_file($path)) {
    //             $size += filesize($path);
    //         } elseif (is_dir($path)) {
    //             $size += $this->get_folder_size($path);
    //         }
    //     }
    //     return $size;
    // }

    // NEW UPDATED CODE - @ Shiv Web Developer
    public function get_user_files_size_from_db($user_id)
    {
        $total_size = 0;

        // List of tables and their file path columns and user-related columns
        // Adjust according to your schema
        $file_tables = [
            ['table' => 'tbl_block_documents', 'file_column' => 'document_url', 'user_column' => 'user_id'],
            ['table' => 'tbl_block_images', 'file_column' => 'image_url', 'user_column' => 'user_id'],
            ['table' => 'tbl_block_videos', 'file_column' => 'video_url', 'user_column' => 'user_id'],
            // ['table' => 'tbl_department_agreements', 'file_column' => 'file_name', 'user_column' => 'user_id'],
            ['table' => 'tbl_freelancer', 'file_column' => 'user_image', 'user_column' => 'id'],
            ['table' => 'tbl_projects', 'file_column' => 'project_document', 'user_column' => 'user_id'],
            ['table' => 'tbl_task_completion_report', 'file_column' => 'document', 'file_column' => 'audio', 'file_column' => 'video', 'user_column' => 'user_id'],
            // ['table' => 'uploads/user_profile', 'file_column' => 'user_image', 'user_column' => 'user_id'],
            // Add other tables and columns as needed
        ];

        foreach ($file_tables as $entry) {
            $table = $entry['table'];
            $file_col = $entry['file_column'];
            $user_col = $entry['user_column'];

            // Get all file names for this user
            $this->db->select($file_col);
            $this->db->from($table);
            $this->db->where($user_col, $user_id);
            $query = $this->db->get();

            foreach ($query->result() as $row) {
                $filename = $row->$file_col;
                if (!$filename) continue;

                // Build full path - adjust base path if needed
                $base_path = FCPATH . $table . '/'; // assuming folder name = table name
                $full_path = $base_path . $filename;

                if (file_exists($full_path)) {
                    $total_size += filesize($full_path);
                }
            }
        }

        return $total_size;
    }
}
 // @ Shiv Web Developer
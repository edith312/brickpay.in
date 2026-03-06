<?php

// Shiv Web Developer
class CommonModal extends CI_Model
{
	public function insertRow($table, $post)
	{
		$clean_post = $this->security->xss_clean($post);
		return $this->db->insert($table, $clean_post);
	}

	function insertRowReturnId($table, $post)
	{
		$clean_post = $this->security->xss_clean($post);
		$this->db->insert($table, $clean_post);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function insertRowReturnIdWithClean($table, $post)
	{
		$this->db->insert($table, $post);
		return $this->db->insert_id();
	}

	function insertRowInBatch($table, $post)
	{
		$clean_post = $this->security->xss_clean($post);
		return $this->db->insert_batch($table, $clean_post);
	}

	function updateRowById($table, $column, $id, $data)
	{
		$clean_post = $this->security->xss_clean($data);
		$this->db->set($clean_post)
			->where($column, $id)
			->update($table);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getRowWhere($table, $where)
	{
		return $this->db->get_where($table, $where)->row_array();
	}


	function updateRowByIdwithoutxss($table, $column, $id, $data)
	{
		$clean_post = $data;
		$this->db->set($clean_post)
			->where($column, $id)
			->update($table);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getMakeMyBookName($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_makemybook');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();

		return $query->row_array(); // returns single record
	}

	public function getRowsWhere($table, $where = [], $orderBy = '')
	{
		$this->db->where($where);
		if ($orderBy) {
			$this->db->order_by($orderBy);
		}
		$query = $this->db->get($table);
		// echo $this->db->last_query();
		// die;
		return $query->result_array();
	}


	function updateRowByMoreId($table, $where, $data)
	{
		$clean_post = $this->security->xss_clean($data);
		$this->db->set($clean_post)
			->where($where)
			->update($table);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllRows($table)
	{
		$get = $this->db->select()
			->from($table)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	public function search($search)
	{
		$this->db->select('*');
		$this->db->from('website_subservice');
		$this->db->like('username', 'fname', 'lname', 'mname', $search);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllRowsWithLimit($table, $limit, $orderCol)
	{
		$get = $this->db->select()
			->from($table)
			->limit($limit)
			->order_by($orderCol, "asc")
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}
	public function getRowRandomly($table, $limit)
	{
		$get = $this->db->select()
			->from($table)
			->limit($limit)
			// ->order_by($orderCol, "desc")
			->order_by('rand()')
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	public function getAllRowsInOrder($table, $orderColumn, $orderType)
	{
		$get = $this->db->select()
			->from($table)
			->order_by($orderColumn, $orderType)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}
	public function getAllRowsInOrderWithLimit($table, $limit, $orderColumn, $orderType)
	{
		$get = $this->db->select()
			->from($table)
			->limit($limit)
			->order_by($orderColumn, $orderType)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	public function updateRowByIdbrick($table, $where, $data)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function getRowsByMultipleWhere($table, $where)
	{
		$get = $this->db->select()
			->from($table)
			->where($where)
			->get();
		return ($get->num_rows() > 0) ? $get->result_array() : false;
	}


	public function getLastHumontoken()
	{
		$this->db->select('humontoken');
		$this->db->from('tbl_freelancer');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row(); // single row object
		return $row ? $row->humontoken : null;
	}
	// Shiv Web Developer

	public function getRowById($table, $column, $id)
	{
		$get = $this->db->select()
			->from($table)
			->where($column, $id)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}
	public function getRowByOr($table, $where, $or_where)
	{
		$get = $this->db->select()
			->from($table)
			->group_start()
			->where($where)
			->or_where($or_where)
			->group_end()
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}
	public function getRowByIdWithLimit($table, $column, $id, $limit)
	{
		$get = $this->db->select()
			->from($table)
			->where($column, $id)
			->limit($limit)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	function getDataByIdInOrderLimit($table, $where, $orderColumn, $orderType, $start, $end)
	{
		$get = $this->db->select()
			->from($table)
			->where($where)
			->limit($start, $end)
			->order_by($orderColumn, $orderType)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}
	function getAllDataWithLimitInOrder($table, $orderColumn, $orderType, $start, $end)
	{
		$get = $this->db->select()
			->from($table)
			->limit($start, $end)
			->order_by($orderColumn, $orderType)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	public function getRowByIdInOrder($table, $where, $orderColumn, $orderType)
	{
		$get = $this->db->select()
			->from($table)
			->where($where)
			->order_by($orderColumn, $orderType)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}


	public function getVotingRightsSum($table, $where, $column)
	{
		$this->db->select_sum($column);
		$this->db->where($where);
		return $this->db->get($table)->row();
	}

	public function getRowByMoreId($table, $where)
	{
		$get = $this->db->select()
			->from($table)
			->where($where)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}
	public function getRowsbyIdForTeam($table, $where, $orderBy = null, $order = 'DESC')
	{
		$this->db->where($where);
		if ($orderBy) {
			$this->db->order_by($orderBy, $order);
		}
		return $this->db->get($table)->result_array();
	}


	public function getSingleRowById($table, $where)
	{
		$get = $this->db->select()
			->from($table)
			->where($where)
			->get();
		if ($get->num_rows() > 0) {
			return $get->row_array();
		} else {
			return false;
		}
	}

	public function getSingleRowByIdInOrder($table, $where, $orderColumn, $orderBy)
	{
		$get = $this->db->select()
			->from($table)
			->where($where)
			->order_by($orderColumn, $orderBy)
			->get();
		if ($get->num_rows() > 0) {
			return $get->row_array();
		} else {
			return false;
		}
	}

	public function deleteRowById($table, $where)
	{
		return $this->db->where($where)->delete($table);
	}

	public function getNumRow($table)
	{
		$ci = &get_instance();
		$get = $ci->db->select()
			->from($table)
			->get();
		return $get->num_rows();
	}
	public function getNumRows($table, $where)
	{
		$ci = &get_instance();
		$get = $ci->db->select()
			->from($table)
			->where($where)
			->get();
		return $get->num_rows();
	}

	public function getColumnById($selectColumn, $table, $where)
	{
		$get = $this->db->select($selectColumn)
			->from($table)
			->where($where)
			->get();
		if ($get->num_rows() > 0) {
			return $get->row_array();
		} else {
			return false;
		}
	}

	public function getSelectedBricks($where)
	{
		return $this->db->select('id, brick_title')
			->from('bricks')
			->where($where)
			->order_by('id', 'DESC')
			->get()
			->result_array();
	}

	public function getRowByLikeInOrder($table, $where, $like, $name, $orderBy, $orderType)
	{
		$ci = &get_instance();
		$get = $ci->db->select()
			->from($table)
			->where($where)
			->like($like, $name, 'both')
			->order_by($orderBy, $orderType)
			->get();
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	public function getRowByLikesInOrder($table, $where, $likes, $orderBy, $orderType)
	{
		$ci = &get_instance();

		$ci->db->from($table)
			->where($where);

		// ✅ Handle multiple LIKE conditions
		if (!empty($likes) && is_array($likes)) {
			$ci->db->group_start();
			foreach ($likes as $field => $value) {
				if (!empty($value)) {
					$ci->db->or_like($field, $value, 'both');
				}
			}
			$ci->db->group_end();
		}

		$ci->db->order_by($orderBy, $orderType);

		$get = $ci->db->get();

		return ($get->num_rows() > 0) ? $get->result_array() : false;
	}


	function runQuery($query)
	{
		$ci = &get_instance();
		$get = $ci->db->query($query);
		if ($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return false;
		}
	}

	public function getQuery($query)
	{
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			echo "N";
		} else {
			echo "Y";
		}
	}

	function SMSSend($phone, $msg, $template, $debug = false)
	{

		$user = "homo01";
		$password = "Homo@19";
		$senderid = "EKAUMS";
		$smsurl = "http://smpp.webtechsolution.co/http-api.php?";
		global $user, $password, $senderid, $smsurl;

		$url = 'http://smpp.webtechsolution.co/http-tokenkeyapi.php?authentic-key=3537686f6d6f30313137331655981948&senderid=EKAUMS&route=1&number=
    ' . urlencode($phone) . '&message=' . urlencode($msg) . '&templateid=' . $template;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//Open the URL to send the message
		// 	$response = httpRequest($urltouse);
		// echo $url;
		$response = curl_exec($ch);
		curl_close($ch);
		if ($debug) {
			$rc = "Response: <br><pre>" .
				str_replace(array("<", ">"), array("&lt;", "&gt;"), $response) .
				"</pre><br>";
		}

		return ($response);
	}

	public function getRowByConditions($table, $conditions = [])
	{
		if (!empty($conditions)) {
			$this->db->where($conditions);
		}

		$query = $this->db->get($table);

		if ($query->num_rows() > 0) {
			return $query->result_array(); // Return single row as an associative array
		}

		return false; // Return false if no matching row found
	}

	public function getChannelsByBrickAndCreator($brick_id, $created_by)
	{
		return $this->db->get_where('brick_pass_channel', [
			'brick_id' => $brick_id,
			'created_by' => $created_by
		])->result_array();
	}

	public function getUserById($user_id)
	{
		return $this->db
			->select('id, name, user_image')
			->from('freelancer')
			->where('id', $user_id)
			->get()
			->row_array(); // ✅ single row
	}

	public function countRowsByCondition($table, $where = [])
	{
		if (!empty($where)) {
			$this->db->where($where);
		}

		return $this->db->count_all_results($table);
	}
}


// Shiv Web Developer
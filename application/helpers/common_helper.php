<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function setDateTime()
{
	return date('Y-m-d H:i:s');
}

function setDateOnly()
{
	return date('Y-m-d');
}



function convertDatedmy($dt)
{
	return date("F d, Y", strtotime($dt));
}
function convertDatedmyhis($dt)
{
	return date("d-m-Y H:i s", strtotime($dt));
}
function dateDiffInDays($date1, $date2)
{
	$diff = strtotime($date2) - strtotime($date1);
	// 1 day = 24 hours
	// 24 * 60 * 60 = 86400 seconds
	return abs(round($diff / 86400));
}
function sessionId($id)
{
	$ci = &get_instance();
	return $ci->session->userdata($id);
}

function insertRow($table, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	return $ci->db->insert($table, $clean);
}

function returnId($table, $data)
{
	$ci = &get_instance();
	$ci->db->insert($table, $data);
	return $ci->db->insert_id();
}

function randomCode($length_of_string)
{
	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

function getRowById($table, $column, $id)
{
	$ci = &get_instance();
	$get = $ci->db->get_where($table, array($column => $id));
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}
function getRowByIdwithlimit($table, $column, $id, $limit)
{
	$ci = &get_instance();
	$get = $ci->db->select()
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

function valuesearch($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where_in($where)
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

function getSingleRowById($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}

function getAllRow($table)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function updateRowById($table, $column, $id, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	$query = $ci->db->where($column, $id)
		->update($table, $clean);
	return $ci->db->affected_rows();
}

function deleteRowById($table, $column, $id)
{
	$ci = &get_instance();
	$ci->db->where($column, $id);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function deleteRowMoreId($table, $where)
{
	$ci = &get_instance();
	$ci->db->where($where);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function getAllRowInOrder($table, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get($table);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getRowsByMoreIdWithOrder($table, $where, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getDataByIdInOrder($table, $column, $id, $orderColumn, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->get_where($table, array($column => $id));
	return $select->result_array();
}

function getAllDataWithLimitInOrder($table, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get($table);
	return $select->result_array();
}
function getDataByIdInOrderLimit($table, $column, $id, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get_where($table, array($column => $id));
	return $select->result_array();
}

function getRowByMoreId($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getNumRows($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	return $get->num_rows();
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

function getRowByLikeInOrder($table, $where, $like, $name, $orderBy, $orderType)
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
//testing


function encryptId($id)
{
	$ci = &get_instance();
	$key = $ci->encrypt->encode($id);
	return $key;
	return $id;
}

function decryptId($key)
{
	$ci = &get_instance();
	$id = $ci->encrypt->decode($key);
	return $id;
	return $key;
}

function lastReplace($search, $replace, $subject)
{
	$pos = strrpos($subject, $search);
	if ($pos !== false) {
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

function flashData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata($var, $message);
}

function sendOTP($contact_no, $message_content)
{

	$url = 'username=ekaumotp794454';
	$url .= '&password=6337';
	$url .= '&sender=EKAUMB';
	$url .= '&to=' . urlencode($contact_no);
	$url .= '&message=' . urlencode($message_content);
	$url .= '&priority=1';
	$url .= '&dnd=1';
	$url .= '&unicode=0';
	$url .= '&dlttemplateid=1707165470454229593';

	$surl = "https://kit19.com/ComposeSMS.aspx?" . $url;
	$res = curl_init();
	curl_setopt($res, CURLOPT_URL, $surl);
	curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
	$result1 = curl_exec($res);
}

function getUserId($token)
{
	$ci = &get_instance();
	$ip = $ci->input->ip_address();
	$get = $ci->db->select()
		->from('user_registration')
		->where("user_registration.user_id = '" . $token['data']->id . "' AND user_status = '1' AND unique_hash = '" . $token['data']->unique_hash . "'")
		->get();
	if ($get->num_rows() > 0) {
		return $token['data']->id;
	} else {
		return false;
	}
}


function orderIdGenerateUser()
{
	$number = 'ORD' . date('ydmhis');
	if (checkOrderIdExistUser($number)) {
		orderIdGenerateUser();
	}
	return $number;
}

function checkOrderIdExistUser($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('book_product')
		->where("order_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}


function imageUpload($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|txt|mp4';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = 380;
		$configi['height'] = 260;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
		// return $ci->upload->display_errors();
	}
}

function resumeUpload($imageName, $path)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'pdf|doc|docx|rtf|wp|txt';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = '500';
		$configi['height'] = '500';
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function imageUploadWithRatio($imageName, $path, $width, $height)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = $width;
		$configi['height'] = $height;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function fullImage($imageName, $path)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function sendNotificationUser($device_id, $title, $message)
{
	$url = 'https://fcm.googleapis.com/fcm/send';

	define('API_KEY', 'AAAA0k59dxI:APA91bGS22p4m1y4OUeTSAjMQv4YcKQjVaBNjgTiuScqtE_S2b813j-Nq_slYfD9zcGFFwsDMUxf17TPKp5L94MFhvvlbz8tITzKPNFzVHy9Hupm89pZevttM8U4EGWCBBwUHidjzybE');

	$data = array("to" => $device_id, "notification" => array("title" => $title, "body" => $message));
	$data_string = json_encode($data);
	$headers = array('Authorization: key=' . API_KEY, 'Content-Type: application/json');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	$results = curl_exec($ch);
	curl_close($ch);
	return $results;
}

function sendEmail($host, $username, $password, $fromName, $sendToEmail, $subject, $mail_body)
{

	// base_url = "http://bmcpmaybooking.com/"; 
	// host = 'mail.bmcpmaybooking.com'; 
	// username = 'bookingverification@bmcpmaybooking.com';  
	// password = "j(*0d%z@OKLR";
	require '././php/class/class.phpmailer.php';
	$base_url = base_url();
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = $host;
	$mail->Port = '587';
	$mail->SMTPAuth = true;
	$mail->Username = $username;
	$mail->Password = $password;
	$mail->SMTPSecure = '';
	$mail->From = $username;
	$mail->FromName = $fromName;
	$mail->AddAddress($sendToEmail);
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $mail_body;
	if ($mail->Send()) {
		return true;
	} else {
		return false;
	}
}

function SMSSend($phone, $msg, $template, $debug = false)
{
	global $user, $password, $senderid, $smsurl;

	$url = 'http://smpp.webtechsolution.co/http-tokenkeyapi.php?authentic-key=3537686f6d6f30313137331655981948&senderid=EKAUMS&route=1&number=' . urlencode($phone) . '&message=' . urlencode($msg) . '&templateid=' . $template;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Open the URL to send the message
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
	// echo $response;
}

function mailmsg($to, $subject, $message)
{
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$headers .= 'From:  test@hirbox.com' . "\r\n";
	$headers .= 'Cc: ' . $to . "\r\n";

	$send = mail($to, $subject, $message, $headers);
}

// 0 - new, 1 - Reviewed by Hirbox, 2 - Resume Screening, 3 - Screening Call, 4 - Assessment Test, 5 - In-Person Interview, 6 - Link candidate to another job, 7 - online Interview, 8 - Make and Offer, 9 - Background Check, 10 - Reference Check, 11 - Offer, 12 - Hired, 13 - Hold


function jobstatusname($statuss)
{
	switch ($statuss) {
		case '0':
			echo 'New';
			break;
		case '1':
			echo 'Reviewed by Hirbox';
			break;
		case '2':
			echo 'Resume Screening';
			break;
		case '3':
			echo 'Screening Call';
			break;
		case '4':
			echo 'Assessment Test';
			break;
		case '5':
			echo 'In-Person Interview';
			break;
		case '6':
			echo 'Link candidate to another job';
			break;
		case '7':
			echo 'online Interview';
			break;
		case '8':
			echo 'Make and Offer';
			break;
		case '9':
			echo 'Background Check';
			break;
		case '10':
			echo 'Reference Check';
			break;
		case '11':
			echo 'Offer';
			break;
		case '12':
			echo 'Hired';
			break;
		case '13':
			echo 'Hold';
		default:
			echo 'no status found';
			break;
	}
}

function setSession($data)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($data);
}

function printCategories($category)
{
	$categories = json_decode($category, true);
	return implode(", ", $categories);
}

function printSkills($skill)
{
	$skills = json_decode($skill, true);
	$skillHTML = '';
	foreach ($skills as $skill) {
		$skillHTML .= "<span class='badge p-1 px-2 text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-pill'>{$skill}</span> ";
	}
	return $skillHTML;
}

function getStateName($state_id)
{
	$getstate = getSingleRowById('tbl_states', ['id' => $state_id]);

	return $getstate['name'];
}

function getCountryName($country_id)
{
	$getCountry = getSingleRowById('tbl_countries', ['id' => $country_id]);

	return $getCountry['name'];
}

function newmail($to, $subject, $message)
{
	$config['protocol']    = 'smtp';
	$config['smtp_crypto'] = 'ssl'; // Use 'tls' with port 587
	$config['smtp_host']    = 'smtp.hostinger.com';
	$config['smtp_port']    = '465';
	$config['smtp_timeout'] = '8';
	$config['smtp_user']    = 'noreply@brickpay.in';
	$config['smtp_pass']    = 'Shubham@Brick333@!';
	$config['charset']    = 'utf-8';
	$config['newline']    = "\r\n"; // Use CRLF for SMTP
	$config['mailtype'] = 'html';

	$ci = &get_instance();
	$ci->load->library('email');
	$ci->email->initialize($config);
	$ci->email->from('noreply@brickpay.in', 'Brick Pay');
	$ci->email->to($to);
	$ci->email->subject($subject);
	$ci->email->message($message);

	$rtr = $ci->email->send();

	if (!$rtr) {
		// Debugging output if the email fails to send
		echo $ci->email->print_debugger();
	}

	return $rtr;
}


function email_template_OTP($otp)
{
	return '<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>OTP - MY Digital Bricks</title>
  </head>
  <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f2f2f2;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px;">
      <tr>
        <td align="center">
          <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <!-- Header -->
            <tr>
              <td style="background-color: #007BFF; padding: 20px; text-align: center;">
                <h2 style="color: #ffffff; margin: 0;">Your One-Time Password (OTP)</h2>
              </td>
            </tr>

            <!-- Message -->
            <tr>
              <td style="padding: 30px 40px; color: #333333; font-size: 16px; line-height: 1.6;">
			  <div style="text-align: center">
			    <h2>My Digital Bricks</h5>
			  </div>
                <p>Please use the following OTP to continue your process.</p>
                <p style="text-align: center; margin: 30px 0;">
                  <span style="display: inline-block; background-color: #f1f1f1; padding: 15px 30px; font-size: 24px; font-weight: bold; letter-spacing: 6px; border-radius: 6px; color: #007BFF;">
                    ' . $otp . '
                  </span>
                </p>
                <p>If you did not request this code, you can safely ignore this email.</p>
              </td>
            </tr>

            <!-- Footer -->
            <tr>
              <td style="background-color: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #888888;">
                &copy; 2025 My Digital Bricks. Need help? Contact us at 
                <a href="mailto:support@mydigitalbricks.com" style="color: #007BFF;">support@mydigitalbricks.com</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>';
}

function formatPriceShort($number, $precision = 1)
{
	if ($number < 900) {
		// 0 - 900
		$n_format = number_format($number, $precision);
		$suffix = '';
	} elseif ($number < 900000) {
		// 0.9k - 900k
		$n_format = number_format($number / 1000, $precision);
		$suffix = 'K';
	} elseif ($number < 900000000) {
		// 0.9m - 900m
		$n_format = number_format($number / 1000000, $precision);
		$suffix = 'M';
	} elseif ($number < 900000000000) {
		// 0.9b - 900b
		$n_format = number_format($number / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($number / 1000000000000, $precision);
		$suffix = 'T';
	}

	// Remove unnecessary trailing .0
	if ($precision > 0) {
		$dotzero = '.' . str_repeat('0', $precision);
		$n_format = str_replace($dotzero, '', $n_format);
	}

	return $n_format . $suffix;
}


function brickType($brickType)
{
	$brick = "";

	switch ($brickType) {
		case '0':
			$brick = "Silver Range (0 - 1000 )";
			break;
		case '1':
			$brick = "Golden Range (1000 to 10,000 )";
			break;
		case '2':
			$brick = "Platinum Range (10,000 to 1,00,000 )";
			break;
		case '3':
			$brick = "Titanium Range (1,00,000 to 10,00,000 )";
			break;
		case '4':
			$brick = "Vibranium Range (10,00,000 to 100,000,000 )";
			break;
		default:
			$brick = "Unknown";
			break;
	}

	return $brick;
}

function brickColor($brickType)
{
	$colors = [
		'0' => 'silver',        // Silver Task
		'1' => 'gold',          // Golden Task
		'2' => '#E5E4E2',      // Platinum Task
		'3' => '#878681',      // Titanium Task
		'4' => '#4B0082'       // Vibranium Task
	];

	return isset($colors[$brickType]) ? $colors[$brickType] : '#000000';
}

function projectName($projectId)
{
	$ci = &get_instance();
	$ci->db->select('project_name');
	$ci->db->from('projects');
	$ci->db->where('id', $projectId);
	$query = $ci->db->get();

	if ($query->num_rows() > 0) {
		return $query->row()->project_name;
	} else {
		return ' -- ';
	}
}

function companyName($companyId)
{
	$ci = &get_instance();
	$ci->db->select('company_name');
	$ci->db->from('companies');
	$ci->db->where('id', $companyId);
	$query = $ci->db->get();

	if ($query->num_rows() > 0) {
		return $query->row()->company_name;
	} else {
		return ' -- ';
	}
}

function generateBrickId($id)
{
	return '#BI' . str_pad($id, 12, '0', STR_PAD_LEFT);
}

function generateProjectId($id)
{
	return '#PI' . str_pad($id, 12, '0', STR_PAD_LEFT);
}

function generateCompanyId($id)
{
	return '#CI' . str_pad($id, 12, '0', STR_PAD_LEFT);
}


function videoUpload($field_name, $upload_path)
{
	$CI = &get_instance();

	// Create folder if not exists
	if (!is_dir($upload_path)) {
		mkdir($upload_path, 0777, true);
	}

	$config['upload_path']      = $upload_path;
	$config['allowed_types']    = 'mp4|mov|avi|mkv|webm';
	$config['max_size']         = 500000; // 500MB
	$config['encrypt_name']     = TRUE;  // random file name

	$CI->load->library('upload', $config);

	if (!$CI->upload->do_upload($field_name)) {
		return false; // upload error
	}

	$data = $CI->upload->data();

	return $data['file_name']; // return uploaded file name only
}

// function pageDepth($items){
// 	$reverse = array_reverse($items);
// 	$total = count($items);

// 	echo '<div class="page-depth">';

// 	// UP LINKS (PAGE NUMBERS)
// 	echo '<div class="depth-up">';
// 	foreach ($reverse as $k => $item) {
// 		if ($k === 0) continue; // current page skip

// 		$pageNo = $total - $k;
// 		echo '<a href="'.$item['url'].'">↑ Page '.$pageNo.'</a>';
// 	}
// 	echo '</div>';

// 	// CURRENT PAGE NUMBER
// 	echo '<div class="depth-current">';
// 	echo 'Page '.$total;
// 	echo '</div>';

// 	echo '</div>';
// }

function pageDepth_new($breadcrumbs){
	$last_index = count($breadcrumbs) - 1;
	echo '<nav aria-label="breadcrumb" class="mt-0 pt-0 ps-4">';
		echo '<ol class="breadcrumb">';
			foreach($breadcrumbs as $index => $breadcrumb){
				if($index == $last_index){
					$title = $breadcrumb['title'];
					$url = base_url() . $breadcrumb['url'];
					echo "<li class='breadcrumb-item active text-center' aria-current='page'>$title</li>";
				}else{
					$title = $breadcrumb['title'];
					$url = base_url() . $breadcrumb['url'];
					echo "<li class='breadcrumb-item text-center'><a href='$url'>$title</a></li>";
				}
				
			}
		echo '</ol>';
	echo '</nav>';
}

if (!function_exists('dd')) {
    function dd($data, $exit = true)
    {
        echo '<pre style="
            background:#111;
            color:#0f0;
            padding:12px;
            border-radius:6px;
            font-size:13px;
            line-height:1.4;
            max-height:400px;
            overflow:auto;
        ">';
        print_r($data);
        echo '</pre>';

        if ($exit) {
            die;
        }
    }
}

/**
 * Pretty echo string
 */
if (!function_exists('de')) {
    function de($text, $exit = false)
    {
        echo '<pre style="
            background:#222;
            color:#fff;
            padding:10px;
            border-radius:6px;
            font-size:13px;
        ">';
        echo htmlspecialchars($text);
        echo '</pre>';

        if ($exit) {
            die;
        }
    }
}

/**
 * Dump without exit
 */
if (!function_exists('dp')) {
    function dp($data)
    {
        echo '<pre style="
            background:#f5f5f5;
            color:#333;
            padding:10px;
            border:1px solid #ddd;
            border-radius:4px;
            font-size:13px;
        ">';
        print_r($data);
        echo '</pre>';
    }
}

if (!function_exists('limit_words')) {
    function limit_words($text, $limit = 30)
    {
        $words = explode(' ', strip_tags($text));
        if (count($words) <= $limit) {
            return $text;
        }
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }
}
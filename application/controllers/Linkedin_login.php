<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Linkedin_login extends CI_Controller
{
    private $client_id = '77w8qevd5egdu8';
    private $client_secret = 'WPL_AP1.GaF9GTTAkGFu3p2l.Z4nIJw==';
    private $redirect_uri = 'http://localhost/digital-bricks/company/dashboard';
    private $scope = 'r_liteprofile r_emailaddress';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['linkedin_login_url'] = "https://www.linkedin.com/oauth/v2/authorization?response_type=code" .
            "&client_id={$this->client_id}" .
            "&redirect_uri=" . urlencode($this->redirect_uri) .
            "&scope=" . urlencode($this->scope);
        $this->load->view('linkedin_login_view', $data);
    }

    public function callback()
    {
        $code = $this->input->get('code');
        if (!$code) {
            exit('Error: No code received.');
        }

        $token_url = "https://www.linkedin.com/oauth/v2/accessToken";
        $post_fields = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->redirect_uri,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret
        ];

        $token_response = $this->curl_request($token_url, $post_fields, true);
        $access_token = $token_response['access_token'] ?? null;

        if (!$access_token) {
            exit('Error: Unable to obtain access token.');
        }

        $profile_data = $this->fetch_linkedin_profile($access_token);

        if ($profile_data) {
            $this->session->set_userdata('linkedin_user', $profile_data);
            redirect('linkedin_login/success');
        } else {
            exit('Error: Unable to fetch user profile.');
        }
    }

    private function fetch_linkedin_profile($access_token)
    {
        $profile_url = "https://api.linkedin.com/v2/me";
        $email_url = "https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))";

        $profile_data = $this->curl_request($profile_url, [], false, $access_token);
        $email_data = $this->curl_request($email_url, [], false, $access_token);

        return [
            'id' => $profile_data['id'] ?? '',
            'first_name' => $profile_data['localizedFirstName'] ?? '',
            'last_name' => $profile_data['localizedLastName'] ?? '',
            'email' => $email_data['elements'][0]['handle~']['emailAddress'] ?? ''
        ];
    }

    private function curl_request($url, $post_fields = [], $is_post = false, $access_token = '')
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            $access_token ? "Authorization: Bearer $access_token" : ''
        ]);

        if ($is_post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function success()
    {
        $linkedin_user = $this->session->userdata('linkedin_user');
        if (!$linkedin_user) {
            redirect('linkedin_login');
        }
        echo "<h2>Welcome, " . $linkedin_user['first_name'] . " " . $linkedin_user['last_name'] . "</h2>";
        echo "<p>Email: " . $linkedin_user['email'] . "</p>";
        echo '<a href="' . site_url('linkedin_login/logout') . '">Logout</a>';
    }

    public function logout()
    {
        $this->session->unset_userdata('linkedin_user');
        redirect('linkedin_login');
    }
}

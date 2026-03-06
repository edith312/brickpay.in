<?php
defined('BASEPATH') or exit('No direct script access allowed');

// ✅ Load Composer autoload first
require_once FCPATH . 'vendor/autoload.php';

class GoogleCalendar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GoogleTokenModel'); // Load token model
    }

    // STEP 1: OAuth flow
    public function oauth()
    {
        $client = new Google_Client();
        $client->setClientId("1053580044564-n6rll6vv29knahec6gtuqrd33kfoo6o3.apps.googleusercontent.com");
        $client->setClientSecret("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");
        // Live Server API
        $client->setRedirectUri('https://brickpay.in/company/oauth');
        // Local Server API
        // $client->setRedirectUri('http://localhost/my-digital-bricks/company/oauth');

        // Scopes for profile, email, phone, and calendar
        $client->addScope([
            'email',
            'profile',
            'openid',
            'https://www.googleapis.com/auth/user.phonenumbers.read', // optional
            Google_Service_Calendar::CALENDAR
        ]);

        $client->setAccessType('offline');
        $client->setPrompt('consent');          // force showing consent screen
        $client->setApprovalPrompt('force');    // ensures refresh_token is returned

        if (!isset($_GET['code'])) {
            // Step 1: Redirect user to Google OAuth consent
            $authUrl = $client->createAuthUrl();
            redirect($authUrl);
        } else {
            // Step 2: Exchange code for access token
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (isset($token['error'])) {
                show_error("Google API error: " . $token['error_description']);
            }

            // Set token to client
            $client->setAccessToken($token['access_token']);

            // STEP 3: Fetch user info
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();

            $email = $userInfo->email;
            $name  = $userInfo->name;
            $google_id = $userInfo->id;
            $picture = $userInfo->picture ?? null;

            // Optional: fetch phone number if approved
            $phone = null;
            try {
                $peopleService = new Google_Service_PeopleService($client);
                $person = $peopleService->people->get('people/me', ['personFields' => 'phoneNumbers']);
                $phone = $person->getPhoneNumbers()[0]->getValue() ?? null;
            } catch (Exception $e) {
                $phone = null; // phone not available or not approved
            }

            // Save token to database
            $user_id = sessionId('freelancer_id'); // your app user id
            $access_token  = $token['access_token'];
            $refresh_token = $token['refresh_token'] ?? '';
            $expires_in    = $token['expires_in']; // seconds

            $this->GoogleTokenModel->saveTokenAndUserInfo($user_id, $google_id, $name, $email, $phone, $picture, $access_token, $refresh_token, $expires_in);

            echo "✅ Token and user info saved in database! You can now use the Calendar API.";
            redirect('company/my-calendar');
        }
    }

    // Main calendar page
    public function index()
    {

        $data['title'] = 'My Calendar';
        $this->load->view('includes/header-link', $data);
        $this->load->view('/my_calendar', $data);
    }

    // STEP 2: Create event after token exists in DB
    public function CreateCalendarBrick()
    {
        $this->load->library('googlecalendarlibrary'); // ✅ load only here

        $title     = $this->input->post('title');
        $startTime = $this->input->post('startTime'); // e.g. 2025-09-20T18:00:00+05:30
        $endTime   = $this->input->post('endTime');

        try {
            $link = $this->googlecalendarlibrary->createBrickEvent($title, $startTime, $endTime);
            $this->session->set_flashdata('success', "Brick created! <a href='$link' target='_blank'>View Event</a>");
        } catch (Exception $e) {
            $this->session->set_flashdata('error', "Error: " . $e->getMessage());
        }

        redirect('company/my-calendar');
    }
}

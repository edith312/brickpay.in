<?php
defined('BASEPATH') or exit('No direct script access allowed');

// @Shiv Web Developer 

// ✅ Correct path to vendor autoload
require_once __DIR__ . '/../../vendor/autoload.php';

class GoogleCalendarLibrary
{
    protected $client;
    protected $calendarService;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setClientId("1053580044564-n6rll6vv29knahec6gtuqrd33kfoo6o3.apps.googleusercontent.com");
        $client->setClientSecret("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");

        // Live Server API
        $client->setRedirectUri('https://brickpay.in/company/oauth');
        // Local Server API
        // $client->setRedirectUri('http://localhost/my-digital-bricks/company/oauth');


        $client->setAccessType('offline');
        $client->setScopes(Google_Service_Calendar::CALENDAR);

        $tokenPath = APPPATH . 'token.json';

        if (!file_exists($tokenPath)) {
            throw new Exception("No token found. Please run /googlecalendar/oauth first.");
        }

        $accessToken = json_decode(file_get_contents($tokenPath), true);

        // Refresh if expired
        if ($client->isAccessTokenExpired()) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($accessToken['refresh_token']);
            if (isset($newToken['error'])) {
                throw new Exception("Google API error: " . $newToken['error_description']);
            }
            $accessToken = array_merge($accessToken, $newToken);
            file_put_contents($tokenPath, json_encode($accessToken));
        }

        $client->setAccessToken($accessToken);

        $this->client = $client;
        $this->calendarService = new Google_Service_Calendar($client);
    }


    // 📅 Create a new calendar event
    public function createBrickEvent($title, $startTime, $endTime)
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => $title,
            'description' => 'Brick created from Brickpay',
            'start' => [
                'dateTime' => $startTime,
                'timeZone' => 'Asia/Kolkata',
            ],
            'end' => [
                'dateTime' => $endTime,
                'timeZone' => 'Asia/Kolkata',
            ],
            'colorId' => 11, // Optional: event color
        ]);

        $event = $this->calendarService->events->insert('primary', $event);
        return $event->htmlLink;
    }

    // 📌 List next 10 events
    public function listEvents($calendarId = 'primary')
    {
        $events = $this->calendarService->events->listEvents($calendarId, [
            'maxResults' => 10,
            'orderBy'   => 'startTime',
            'singleEvents' => true,
            'timeMin'   => date('c'),
        ]);

        return $events->getItems();
    }
}
// @Shiv Web Developer 
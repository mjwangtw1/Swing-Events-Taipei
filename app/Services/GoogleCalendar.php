<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class GoogleCalendar {

    protected $client;

    protected $service;

    function __construct() {
        /* Get config variables */
        $client_id = Config::get('google.client_id');
        $service_account_name = Config::get('google.service_account_name');
        $key_file_location = base_path() . Config::get('google.key_file_location');

        $this->client = new \Google_Client();
        $this->client->setApplicationName("Your Application Name");
        $this->service = new \Google_Service_Calendar($this->client);

        /* If we have an access token */
        if (Cache::has('service_token')) {
          $this->client->setAccessToken(Cache::get('service_token'));
        }

        $key = file_get_contents($key_file_location);
        /* Add the scopes you need */
        $scopes = array('https://www.googleapis.com/auth/calendar');
        $cred = new \Google_Auth_AssertionCredentials(
            $service_account_name,
            $scopes,
            $key
        );

        $this->client->setAssertionCredentials($cred);
        if ($this->client->getAuth()->isAccessTokenExpired())
        {
          $this->client->getAuth()->refreshTokenWithAssertion($cred);
        }

        Cache::forever('service_token', $this->client->getAccessToken());
    }

    //This one worked so far
    public function get($calendarId)
    {
        $results = $this->service->calendars->get($calendarId);
        return $results;
    }

    public function get_events($calendarId, $optParams)
    {
        $results = $this->service->events->listEvents($calendarId, $optParams);
        return $results;
    }

    public function get_unique_event($calendarId, $eventId)
    {
        $results = $this->service->events->get($calendarId, $eventId);
        return $results;
    }

    //Try to quick add
    public function quickadd($calendarId, $data)
    {
        
        $createdEvent = $this->service->events->insert($calendarId,$data);
        $event_id = $createdEvent->getId();

        return $event_id;
    }

    //Insert with specific details
    public function insert($calendarId, $event_detail)
    {
        //We need to new this Object.
        $event = new \Google_Service_Calendar_Event($event_detail);
        $event_result = $this->service->events->insert($calendarId, $event);
        
        return $event_result;
    }

    public function delete($calendarId, $eventId)
    {
        $results = $this->service->events->delete($calendarId, $eventId);

        return $results;
    }

}
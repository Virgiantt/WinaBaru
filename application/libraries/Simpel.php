<?php

use Google\Client;

class Simpel {
    private $serviceAccountFile;
    private $projectId;

    public function __construct() {
        $this->serviceAccountFile = FCPATH . "scripts/sistempelanggan2024-27f19af01409.json";
        $this->projectId = 'sistempelanggan2024';
    }

    private function getAccessToken() {
        $client = new Client();
        $client->setAuthConfig($this->serviceAccountFile);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $accessToken = $client->fetchAccessTokenWithAssertion();

        if (!empty($accessToken['access_token'])) {
            return $accessToken['access_token'];
        }

        throw new Exception('Unable to fetch access token.');
    }

    function sendNotification($token, $title, $body) {
        $accessToken = $this->getAccessToken();
        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $message = [
            'message' => [
                'token' => $token,
                'notification' => [
                    'title' => $title,
                    'body'  => $body
                ]
            ]
        ];

        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus == 200) {
            return json_decode($response, true);
        }

        throw new Exception('Error sending notification: ' . $response);
    }
}

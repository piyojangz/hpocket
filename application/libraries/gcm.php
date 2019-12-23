<?php


/**
 * Extends the BaseFacebook class with the intent of using
 * PHP sessions to store user ids and access tokens.
 */
class GCM
{

    //put your code here
    // constructor
    function __construct()
    {

    }

    /**
     * Sending Push Notification
     */
    public function send_notification($registrationIDs, $message)
    {


        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';


        $fields = array(
            'to' => $registrationIDs,
            'notification' => array('title' => 'FoodHall Message', 'body' => $message, 'sound' => 'mySound'),
            'data' => array('message' => $message)
        );

        $headers = array(
            'Authorization:key=' . SERVER_KEY,
            'Content-Type:application/json'
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}
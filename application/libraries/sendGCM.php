<?php
/**
 * Created by PhpStorm.
 * User: Breeshy
 * Date: 9/5/2016 AD
 * Time: 2:52 AM
 */
class sendGCM
{
    function __construct()
    {

    }
    public function send_notification($registrationIds,$message )
    {
// prep the bundle
//        $msg = array
//        (
//            'message' 	=> 'here is a message. message',
//            'title'		=> 'This is a title. title',
//            'subtitle'	=> 'This is a subtitle. subtitle',
//            'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
//            'vibrate'	=> 1,
//            'sound'		=> 1,
//            'largeIcon'	=> 'large_icon',
//            'smallIcon'	=> 'small_icon'
//        );
        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $message
        );

        $headers = array
        (
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }
}

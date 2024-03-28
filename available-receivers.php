<?php

    require __DIR__ . '/vendor/autoload.php';

    use Twilio\Rest\Client;

    include('include/credentials.php');
    include('path_evn.php');

    $client = new Client($account_sid, $auth_token);

    // Fetching verified number list...
    $outgoingCallerIds = $client->outgoingCallerIds->read([], 50);
    // foreach ($outgoingCallerIds as $record) {
    //     echo ($record->friendlyName)."<br>";
    // }
    // echo "<br><br>";
    // foreach ($outgoingCallerIds as $record) {
    //     echo ($record->phoneNumber)."<br>";
    // }    
    $receiverList=array();
    foreach ( $outgoingCallerIds as $receiver ) {
        array_push($receiverList,([$receiver->friendlyName,$receiver->phoneNumber]));
    }
    echo json_encode($receiverList);

?>
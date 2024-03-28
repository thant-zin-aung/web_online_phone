<?php
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;

    include('include/credentials.php');
    include('path_evn.php');
    $client = new Client($account_sid, $auth_token);


    // Sending sms codes...
    $message = $client->messages->create(
        // receiver number
        $_POST['receiverPhone'],
        [
            // Outbound number
            'from' => $outbound_number,
            // text message
            'body' => $_POST['smsMessage']
        ]
    );

    echo $message->status;
?>
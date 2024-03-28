<?php
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;
    include('include/credentials.php');
    include('path_evn.php');

    $client = new Client($account_sid, $auth_token);
    function sendVoiceMessage($client,$outbound_number,$receiver_number,$voice_message_url) {

        echo "outbound_number - $outbound_number\nreceiver_number - $receiver_number\nvoice_message_url - $voice_message_url\n";
        // Phone calling codes...    
        $call = $client->calls
        ->create("$receiver_number", // to
                "$outbound_number", // from
                ["twiml" => "<Response><Play>$voice_message_url</Play></Response>"]
        );

        echo $call;
    }

    if (isset($_POST['receiver_number'],$_POST['voiceMessageUrl'])) {
        $receiver_number = $_POST['receiver_number'];
        $publicVoiceMessageUrl = $_POST['voiceMessageUrl'];
        // Execute sending voice message script...
        sendVoiceMessage($client,$outbound_number,$receiver_number,$publicVoiceMessageUrl);
    }
?>
    
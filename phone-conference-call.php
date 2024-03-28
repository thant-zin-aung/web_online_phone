<?php
    // Twilio codes are start from here....
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;
    use Twilio\TwiML\VoiceResponse;

    include('include/credentials.php');
    include('path_evn.php');
    
    $client = new Client($account_sid, $auth_token);

    $callerName = $_POST['callerName'];
    $callerPhone = $_POST['callerPhoneNumber'];

    $receiverName = $_POST['receiverName'];
    $receiverPhone = $_POST['receiverPhone'];

    try {
        $participant1 = $client->conferences($conference_room_name)
        ->participants
        ->create($outbound_number, // from
                 $callerPhone, // to
                 [
                     "label" => $callerName,
                     "beep" => "true",
                     "record" => False,
                     "EndConferenceOnExit" => True
                 ]
        );

        $participant2 = $client->conferences($conference_room_name)
                ->participants
                ->create($outbound_number, // from
                        $receiverPhone, // to
                        [
                            "label" => $receiverName,
                            "beep" => "true",
                            "record" => False
                        ]
                );
        echo "success";

    } catch ( Exception $e ) {
        echo "failed...";
    }
// $participant = $client->conferences("CFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
//                       ->participants
//                       ->create("+18593500813", // from
//                                "+959679821062", // to
//                                [
//                                    "label" => "txel",
//                                    "beep" => "true",
//                                    "record" => False,
//                                    "EndConferenceOnExit" => True
//                                ]
//                       );

// print($participant->callSid);

// $participant2 = $client->conferences("CFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
//                       ->participants
//                       ->create("+18593500813", // from
//                                "+959679821063", // to
//                                [
//                                    "label" => "koko",
//                                    "beep" => "true",
//                                    "record" => False,
//                                    "EndConferenceOnExit" => True
//                                ]
//                       );

// print($participant2->callSid);

// $participant3 = $client->conferences("CFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
//                       ->participants
//                       ->create("+18593500813", // from
//                                "+959679821064", // to
//                                [
//                                    "label" => "kyaw_than_san",
//                                    "beep" => "true",
//                                    "record" => False
//                                ]
//                       );

// print($participant3->callSid);




?>
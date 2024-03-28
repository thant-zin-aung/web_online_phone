<?php
    // Twilio codes are start from here....
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;

    include('include/credentials.php');
    include('path_evn.php');
    include('delete_file.php');
    
    $client = new Client($account_sid, $auth_token);

    // Sending sms codes...
    // $client->messages->create(
    //     // receiver number
    //     '+959679821063',
    //     [
    //         // Outbound number
    //         'from' => $outbound_number,
    //         // text message
    //         'body' => "Hi! TZA"
    //     ]
    // );

    // Fetching verified number list...
    // $outgoingCallerIds = $client->outgoingCallerIds->read([], 20);
    // foreach ($outgoingCallerIds as $record) {
    //     echo ($record->friendlyName)."<br>";
    // }
    // echo "<br><br>";
    // foreach ($outgoingCallerIds as $record) {
    //     echo ($record->phoneNumber)."<br>";
        
    // }

    // Phone calling codes...
    // $call = $client->calls
    //            ->create("+959679821064", // to
    //                     "$outbound_number", // from
    //                     ["twiml" => "<Response><Play>$voice_message_url</Play></Response>"]
    //            );
    // print($call->sid);

?>

<!DOCTYPE html>
    <?php include('include/header.php') ?>



    <?php
        // Executing fetching balance script...
        // include('balance.php');
        // echo $balanceWithCurrencyCode;
    ?>

    <!-- Send sms section -->
    <section id="send-sms" class="container">
        <div class="title-wrapper">
            <div class="title">Send A SMS Message Using Our Amazing Online Feature</div>
            <div class="send-sms-title-icon-wrapper">
                <div class="curly-bracket">{</div>
                <div class="icon-one icon-wrapper"><i class="fa-solid fa-comment-sms"></i></div>
                <div class="plus-sign">+</div>
                <div class="icon-two icon-wrapper"><i class="fa-solid fa-voicemail"></i></div>
                <div class="plus-sign">+</div>
                <div class="icon-three icon-wrapper"><i class="fa-solid fa-phone"></i></i></div>
                <div class="plus-sign">+</div>
                <div class="icon-four icon-wrapper"><i class="fa-solid fa-earth-asia"></i></div>
                <div class="curly-bracket">}</div>
            </div>
        </div>

        <div class="send-sms-intro-wrapper">
            <img src="assets/img/devices-frame.png" alt="phone-frame-icon" loading="lazy" class="img-fluid devices-frame-img">
            <div class="intro-text-wrapper">
                <div class="intro-text-title">Compatible with all devices</div>
                <div class="intro-text">
                    Able to communicate all over the world using any device is our top level of consideration. We made our best in developing this application so our value customer be able use without having any platform dependant issues.
                </div>
                <div class="intro-device-list-wrapper">
                    <div class="device-wrapper">
                        <img src="assets/img/android.png" alt="android-icon" class="img-fluid">
                        <i class="fa-solid fa-check-double img-fluid"></i>
                    </div>
                    <div class="device-wrapper">
                        <img src="assets/img/ios.png" alt="android-icon" class="img-fluid">
                        <i class="fa-solid fa-check-double img-fluid"></i>
                    </div>
                    <div class="device-wrapper">
                        <img src="assets/img/mac.png" alt="android-icon" class="img-fluid">
                        <i class="fa-solid fa-check-double img-fluid"></i>
                    </div>
                    <div class="device-wrapper">
                        <img src="assets/img/windows.png" alt="android-icon" class="img-fluid">
                        <i class="fa-solid fa-check-double img-fluid"></i>
                    </div>
                    <div class="device-wrapper">
                        <img src="assets/img/linux.png" alt="android-icon" class="img-fluid">
                        <i class="fa-solid fa-check-double img-fluid"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available receiver section -->
        <section id="available-receiver" class="container">
            <div class="title-wrapper">
                <div>
                    <i class="fa-solid fa-list"></i>Available receivers list
                </div>
                <i class="fa-solid fa-user-plus make-shadow-box add-user"></i>
            </div>
            <div class="available-receiver-list-wrapper">
                <!-- <div class="available-number-wrapper col-md-3 col-sm-4">
                    <div class="name">Blacksky</div>
                    <div class="phone">09679821063</div>
                </div> -->    
            </div>
            <div class="choice-section-wrapper">
                <div class="sms-section selectable-section"><a href="#play-ground-area">SMS</a></div>
                <div class="voice-message-section selectable-section"><a href="#play-ground-area">Voice Message</a></div>
                <div class="phone-call-section selectable-section"><a href="#play-ground-area">Phone Call</a></div>
            </div>
        </section>

        <div class="play-ground-wrapper row">
            <div class="col-md-6 col-sm-12 mt-3 card section-box make-shadow-box sms-receiver-info-wrapper">
                <img src="assets/img/phone-horizonal-frame.png" class="card-img-top" alt="...">
                <div class="card-body make-margin-top-bottom-10">
                    <div class="title"><i class="fa-solid fa-circle-info"></i>Receiver information</div>
                    <div class="name">Name - <span>Unknown</span></div>
                    <div class="phone">Phone number - <span>N/A</span></div>
                </div>
            </div>


            <!-- For send sms playground area -->
            <div class="play-ground-area sms-play-ground-area section-box mt-3 col-md-6 col-sm-12 ps-md-3 ps-sm-0" id="play-ground-area">
                <textarea class="message-box make-shadow-box" placeholder="Please type your messages here..." spellcheck="false"></textarea>
                <div class="send-sms-button-wrapper">
                    <div class="send-sms-button">Send sms message<i class="fa-solid fa-paper-plane"></i></div>
                </div>
            </div>

            <!-- For send voice message playground area -->
            <div class="play-ground-area voice-message-play-ground-area section-box mt-3 col-md-6 col-sm-12 ps-md-3 ps-sm-0" id="play-ground-area">
                <input type="file" id="voiceMessageFile" accept="audio/*">
                <label for="voiceMessageFile" class="upload-voice-message-wrapper">
                    <div class="upload-voice-message-button">
                        <i class="fa-solid fa-microphone"></i>
                        <div class="text">Upload your voice here</div>
                        <div class="voice-message-file-path">No file uploaded</div>
                    </div>
                </label>
                <audio class="audio-tag" src="" controls></audio>
                <div class="send-voice-message-button make-shadow-box">
                    Send voice message<i class="fa-solid fa-voicemail"></i>
                </div>
            </div>




            <!-- For make a call playground area -->
            <div class="play-ground-area make-a-call-play-ground-area section-box mt-3 col-md-6 col-sm-12 ps-md-3 ps-sm-0" id="play-ground-area">
                <div class="make-a-call-button">
                    <i class="fa-solid fa-phone-volume"></i>
                    <div class="text">Make a real time voice call over internet</div>
                    <p>Phone call over internet service might not available for all time. Please contant 'Thant Zin Aung' ( blackskyand1666@gmail.com ) for 24/7 phone call service.</p>
                </div>
            </div>
        </div>
    </section>

    


    <?php include('include/footer.php') ?>
</html>
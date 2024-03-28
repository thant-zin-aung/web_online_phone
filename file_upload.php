<?php
    include('path_evn.php');
    // include('delete_file.php');

    if ( 0 < $_FILES['voiceMessageFile']['error'] ) {
        $error = $_FILES['voiceMessageFile']['error'];
        echo "<script>console.log('voiceMessageFile error - $error');</script>";
    }
    else {

        // echo "$fileUploadName\n";
        $fileName = $_FILES['voiceMessageFile']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        

        // create folder if not exists...
        if ( !is_dir($voice_message_path) ) {
            mkdir($voice_message_path);
        }

        $publicVoiceMessageUrl .= ".".$fileExtension;
        // rename original to custom filename and upload to server...
        if ( move_uploaded_file($_FILES['voiceMessageFile']['tmp_name'], $fileUploadName.".".$fileExtension) ) {
            echo $publicVoiceMessageUrl;
            // echo "File uploaded to the server successfully...";
        } else {
            echo "upload_failed";
        }  
    }

    // echo "<script>window.location=history.go(-1)</script>";
    
?>
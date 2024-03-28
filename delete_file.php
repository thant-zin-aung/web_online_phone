<?php
    include('path_evn.php');
    if ( file_exists($fileUploadName) ) {
        unlink($fileUploadName);
    }
?>
<?php
    require 'vendor/autoload.php';

    use GuzzleHttp\Client;

    include('include/credentials.php');

    $endpoint = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Balance.json";
    
    $errorMessage = "error";

    try {
        $balanceClient = new Client();
        $response = $balanceClient->get($endpoint, [
        'auth' => [
            $account_sid,
            $auth_token
        ]
        ]);
    
        // echo $response->getBody();
    
        $balanceJson = json_decode($response->getBody());
        $balance = $balanceJson->balance;
        echo $balance;
        // $balanceCurrency = $balanceJson->currency;
        // $balanceWithCurrencyCode = "$".$balance;
        // echo $balanceWithCurrencyCode;
        // echo $balance;
    } catch ( Exception $e ) {
        echo $errorMessage;
    }

?>
<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Dinar
 * Date: 6/23/2016
 * Time: 4:45 PM
 */


$postData = array(
    'lat' => '23.2532',
    'long' => '23.2532',
    'bus_id' => '23.2532',
    'apikey' => 'verysecretapikeythisis'
);


$ch = curl_init('http://localhost/jbt/api/coordinate/update');

curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}

echo 'errrr<br>';

// Decode the response
$responseData = json_decode($response, TRUE);

// Print the date from the response
var_dump($responseData);
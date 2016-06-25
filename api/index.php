<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Dinar
 * Date: 6/23/2016
 * Time: 12:15 AM
 */


require 'vendor/autoload.php';


$app = new Slim\App();


$app->get('/coordinate/all',  function ($request, $response, $args){


    $newResponse = null;

    
    require_once 'model/Bus.php';

    $_bus = new Bus();
    $_bus = $_bus->getAll();

    if($_bus->hssError()){
        $newResponse = $response->withJson(array("err" => 'db'));
    }else{
        $newResponse = $response->withJson($_bus->results());
    }


    return $newResponse;
});



$app->post('/coordinate/update', function ( $request, $response) {


    $newResponse = null;

    $data = $request->getParsedBody();

    $bus_data = [];
    array_push($bus_data , filter_var($data ['latitude'], FILTER_SANITIZE_STRING));
    array_push($bus_data , filter_var($data ['longitude'], FILTER_SANITIZE_STRING));
    array_push($bus_data , filter_var($data ['busId'], FILTER_SANITIZE_STRING));


    require_once 'model/Bus.php';
    $_bus = new Bus();

    $_bus->update($bus_data);

    if($_bus->hssError()){
        $newResponse = $response->withJson(array(
            "status" => '210',
            "message" => 'databse error '.$_bus->getError()
        ));
    }else{

        $newResponse = $response->withJson(array(
            "status" => '200',
            "message" => 'updated dude!'
        ));

    }


    return $newResponse;
});



function validApi($apikey){
    return $apikey === "omgverysecretapikeythisiswhysolamestop";
}

$app->run();
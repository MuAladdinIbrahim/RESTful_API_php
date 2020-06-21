<?php
require 'dbclass.php';
require 'RequestHandler.php';
require 'ResponseHandler.php';


$db = new DbLab();
$requestHandler = new RequestHandler();
$responseHandler = new ResponseHandler($db);

$checkedValue = $requestHandler->get__resource();

$validate = $requestHandler->validate($checkedValue);
$id = $requestHandler->get__resource_id();
$name = $requestHandler->get__resource_name();
$email = $requestHandler->get__resource_email();
$gender = $requestHandler->get__resource_gender();
$recieve = $requestHandler->get__resource_recieve();


if ($validate) {
    switch ($requestHandler->get__method()) {
        case "GET":
            $responseHandler->handle_get($id);
            break;

        case "DELETE":
            $responseHandler->handle_delete($id);
            break;
        case "POST":
            $responseHandler->handle_post($name,$email,$gender,$recieve);
        break;
        case "PUT":
            $responseHandler->handle_put($id,$name,$email,$gender,$recieve);



    }
}

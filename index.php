<?php

include_once 'api.php';

/**
 * Basic index.php router that checks the incoming REQUEST_URI and decides what response to send.
 *
 * Simple API response functions used here are located in api.php.
 *
 * Most of your snake implementation will need to happen in the "/move" command.
 */

// Get the requested URI without any query parameters on the end
$requestUri = strtok($_SERVER['REQUEST_URI'], '?');
if ($requestUri == '/')  
{   //Index Section
    $apiversion = "1";
    $author     = "Hurrpadurr";           // TODO: Your Battlesnake Username
    $color      = "#888888";    // TODO: Personalize
    $head       = "default";    // TODO: Personalize
    $tail       = "default";    // TODO: Personalize

    indexResponse($apiversion,$author,$color,$head, $tail);
}
elseif ($requestUri == '/start')
{
    // read the incoming request body stream and decode the JSON
    $data = json_decode(file_get_contents('php://input'));

    // TODO - if you have a stateful snake, you could do initialization work here
    startResponse();
}
elseif ($requestUri == '/move')
{   //Move Section
    // read the incoming request body stream and decode the JSON
    $data = json_decode(file_get_contents('php://input'));

    error_log('Received move data: '.print_r($data, true));

    // TODO - Implement your Battlesnake here!
    $possibleMove = ['up', 'down', 'left', 'right'];
//    moveResponse($possibleMove[array_rand($possibleMove)]);
    moveResponse('up');
}
elseif ($requestUri == '/end')
{
     // read the incoming request body stream and decode the JSON
     $data = json_decode(file_get_contents('php://input'));

     // TODO - if you have a stateful snake, you could do finalize work here
    endResponse();
}
else
{
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
}

<?php

require '../vendor/autoload.php';
require 'config.php';

use PremiumFastNetwork\WSGateway;

$wa = new WSGateway();
$wa->token($token);
$wa->deviceid($deviceid);

// send message for single number
$send = $wa->sendmessage($number, 'test send message by api');

// send message for multiple number
$send = $wa->sendmessage($multiplenumber, 'test send message by api');

// return output
var_dump(json_decode($send));

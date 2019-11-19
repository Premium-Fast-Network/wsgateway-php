<?php

require "../vendor/autoload.php";
require "config.php";

use PremiumFastNetwork\WSGateway;

$wa = new WSGateway();
$wa->token($token);
$wa->deviceid($deviceid);
$send = $wa->sendmessage($number, 'test send message by api');
var_dump(json_decode($send));
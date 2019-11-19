<?php

require '../vendor/autoload.php';
require 'config.php';

use PremiumFastNetwork\WSGateway;

$wa = new WSGateway();
$wa->token($token);
$wa->deviceid($deviceid);
$send = $wa->sendgroup('xxxxx', 'test send message by api');

// return output
var_dump(json_decode($send));

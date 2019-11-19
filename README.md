# PFN PHP Library WSGateway

[![StyleCI](https://github.styleci.io/repos/222653815/shield?branch=master)](https://github.styleci.io/repos/222653815)

This library for easy to use in PHP with composer installation. Please referer to our [REST API Documentation](https://docs.premiumfast.net/tutorials/whatsapp-gateway/rest-api) if you want to build in you're own programing langguage.

## Installation
```
composer require premiumfastnet/wsgateway
```

# How to Use

## Example
You can check on folder example for easy to use. keep in mind, you need change `config.php.example` to `config.php` and fill variable on that files to work or you can make you're own combination.

## Send Message Example

- Request
```php
<?php

require "vendor/autoload.php";

use PremiumFastNetwork\WSGateway;

$wa = new WSGateway();
$wa->token('YOUR-TOKEN-HERE');
$wa->deviceid('YOUR-DEVICE-ID');
$send = $wa->sendmessage('0812xxxxxxxx', 'test send message by api');
var_dump(json_decode($send));
```

- Response
```
class stdClass#29 (2) {
  public $code =>
  int(200)
  public $message =>
  string(44) "success, message will be send in background."
}
```

## Send Bulk Message Example

- Request
```php
<?php

require "vendor/autoload.php";

use PremiumFastNetwork\WSGateway;

$wa = new WSGateway();
$wa->token('YOUR-TOKEN-HERE');
$wa->deviceid('YOUR-DEVICE-ID');

$multiplenumber = array(
    '08xxxx', '08xxxxx'
);
$send = $wa->sendmessage($multiplenumber, 'test send message by api');
var_dump(json_decode($send));
```
- Response
```
class stdClass#29 (2) {
  public $code =>
  int(200)
  public $message =>
  string(37) "success, all message in waiting list."
}
```

## Send Bulk Message to Contact Group

- Request
```php
<?php

require "vendor/autoload.php";

use PremiumFastNetwork\WSGateway;

$wa = new WSGateway();
$wa->token('YOUR-TOKEN-HERE');
$wa->deviceid('YOUR-DEVICE-ID');
$send = $wa->sendgroup('xxxxx', 'test send message by api');
var_dump(json_decode($send));
```

- Response
```
class stdClass#29 (2) {
  public $code =>
  int(200)
  public $message =>
  string(37) "success, all message in waiting list."
}
```
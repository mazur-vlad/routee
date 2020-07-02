<?php

require __DIR__.'/../vendor/autoload.php';

$weatherSender= new App\Facades\WeatherSender('Thessaloniki');
$weatherSender->send();
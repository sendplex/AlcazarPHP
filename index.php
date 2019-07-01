<?php

$loader = require __DIR__ . '/vendor/autoload.php';

$tester = new AlcazarPHP(14846642800);

/**
 * in case require to update the query params,
 * chain querySetup and then add an associative array with key as the param key and value as the param value
 */
// echo $tester->querySetup([])->response(true);

echo $tester->ArrayResponse();
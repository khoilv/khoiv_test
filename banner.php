<?php

require 'vendor/autoload.php';

use App\Repositories\HitsCounts;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $repos = new HitsCounts();

    // get IP
    $ip = $_SERVER['REMOTE_ADDR'];

    // get domain name
    $domain = $_SERVER['SERVER_NAME']; // $_SERVER['HTTP_HOST']

    // check and update the count value
    $hitCount = $repos->checkHitRequest($domain, $ip);

    if ($hitCount) {
        $repos->updateHitRequest($hitCount->id);
    } else {
        $repos->createHitRequest($domain, $ip);
    }

    exit('OK');
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // open the banner file in a binary mode
    $filename = './assets/img/banner.jpg';
    $size = getimagesize($filename);
    $fp = fopen($filename, 'rb');

    // send the right headers
    header("Content-Type: {$size['mime']}");
    header("Content-Length: " . filesize($filename));

    // dump the picture and stop the script
    fpassthru($fp);
    exit;
}
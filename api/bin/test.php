#!/usr/bin/env php
<?php
declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

$minutes = $argv[1] ?? exit('Please, provide minutes as arg!' . PHP_EOL);
$threshold = $argv[2] ?? 0.5;
$seconds = $minutes * 60;
$startTime = time();

$timeToEnd = (int)($startTime + $seconds);

$client = new Client();

$totalReqs = 0;
$thresholdedReqs = 0;

while (time() != $timeToEnd) {
    $id = random_int(10001, 20000);
    $response = $client->get('http://nginx:80/disease/' . $id, [
        'on_stats' => function (TransferStats $stats) use ($threshold, &$totalReqs, &$thresholdedReqs) {
            $totalReqs++;
            if ($stats->getTransferTime() > $threshold) {
                $thresholdedReqs++;
            }
        }
    ]);
}

dump($totalReqs, $thresholdedReqs, calculatePercentage($totalReqs, $thresholdedReqs));

function calculatePercentage(int $total, int $thresholded): float {
    return ($thresholded / $total) * 100;
}

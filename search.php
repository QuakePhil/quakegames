<?php

function recordSearch($playerName, $playerIP) {
    $h = fopen('searches/'.$playerIP, 'w');
    fwrite($h, $playerName . "\n");
    fclose($h);
}

$playerName = trim($_POST['playerName']);
$playerIP = trim($_SERVER['REMOTE_ADDR']);

$out = array();

if (trim($playerName) == '') {
    $out['error'] = 'Enter your in-game nick first';
} else if (trim($playerIP) == '') {
    $out['error'] = 'Could not detect your IP';
} else {
    recordSearch($playerName, $playerIP);
}

echo json_encode($out);
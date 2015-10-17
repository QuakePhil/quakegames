<?php

$out = array();

$dh = opendir('searches');

while (($file = readdir($dh)) !== false) if ($file != '.' && $file != '..') {
    $h = fopen("searches/$file", 'r'); // mongoize this slowfest
    $playerName = trim(fgets($h));
    $out[$file] = $playerName;
}

echo json_encode($out);
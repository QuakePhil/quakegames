<?php

function locationByIp($ip)
{
    $ip = trim($ip);
    if ($ip == '') return;

    $location = "";

    if (file_exists("locations/$ip")) {
        $location = file_get_contents("locations/$ip");
    }

    if (trim($location) == "") {
        $location = file_get_contents("http://freegeoip.net/json/$ip");
        $h = fopen("locations/$ip", "w");
        fwrite($h, $location);
        fclose($h);
    }
    $location = json_decode($location);
    $lat = doubleval($location->latitude);
    $lon = doubleval($location->longitude);
    return array($lat, $lon);
}

if (file_exists('serverlist.json')) {
    include('serverlist.json');
} else {
    $feed = 'http://www.quakeservers.net/shambler_servers.php';
    
    $xml = new SimpleXmlElement(file_get_contents($feed));
    $servers = array();
    
    foreach ($xml->channel->item as $server) {
        list($lat, $lon) = locationByIp((string) $server->ip);
        $server_snippet = array(
            'gametype1' => (string) $server->gametype1,
            'gametype2' => (string) $server->gametype2,
            'gametype3' => (string) $server->gametype3,
            'port' => (string) $server->port,
            'hostname' => (string) $server->hostname,
            'description' => (string) $server->description,
            'title' => (string) $server->title,
            'ip' => (string) $server->ip,
            'country' => (string) $server->country,
            'latitude' => $lat,
            'longitude' => $lon
            );
        $servers[] = $server_snippet;
    }
    
    echo json_encode($servers);

    $h = fopen('serverlist.json', 'w');
    fwrite($h, json_encode($servers));
    fclose($h);
}
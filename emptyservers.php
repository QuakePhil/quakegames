<?php

$ttl = 5 * 60;

if (file_exists('emptyservers.json')) {
    if (time() - filemtime('emptyservers.json') > $ttl)
        unlink('emptyservers.json');
}

if (file_exists('emptyservers.json')) {
    include('emptyservers.json');
} else {
    $feed = 'http://www.quakeservers.net/shambler_servers.php';
    
    $xml = new SimpleXmlElement(file_get_contents($feed));
    $servers = array();
    
    foreach ($xml->channel->item as $server) {
        $players = intval($server->players);
        if ($players > 0) continue;

        $server_snippet = array(
            'port' => (string) $server->port,
            'hostname' => (string) $server->hostname,
            'description' => (string) $server->description,
            'title' => (string) $server->title,
            'ip' => (string) $server->ip,
            'maxplayers'=> intval($server->maxplayers),
            );
        $servers[] = $server_snippet;
    }
    
    echo json_encode($servers);

    $h = fopen('emptyservers.json', 'w');
    fwrite($h, json_encode($servers));
    fclose($h);
}
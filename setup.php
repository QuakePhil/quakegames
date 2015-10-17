<?php

if (!file_exists('searches')) mkdir('searches');
if (!file_exists('locations')) {
    mkdir('locations');
    `cp  sessions/index.php searches && cp sessions/index.php locations`;
}
require('serverlist.php'); // build the initial serverlist.json with latitude/longitude as that takes a while
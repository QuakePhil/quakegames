<?php

$_SERVER['REMOTE_ADDR'] = '10.240.25.150';

/*
todo: implement sessions
if (!file_exists('sessions')) {
    mkdir('sessions');
    `cp views/index.php sessions`;
}
*/

include('views/header.php');

/*
$user = $_SESSION['user'];
var_dump($user);
if (!$user) {
    include('views/login.php');
    die();
}
*/

include('views/main.php');

include('views/footer.php');
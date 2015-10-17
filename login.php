<?php

if ($_POST['login']) {
    $_SESSION['user'] = $_POST['login'];
}

var_dump($_SESSION);
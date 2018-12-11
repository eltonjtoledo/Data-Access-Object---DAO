<?php

require_once './config.php';
$user = new Usuario();
$user->loadById('5');
echo $user;

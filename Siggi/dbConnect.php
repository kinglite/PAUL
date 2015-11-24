<?php

$username = 'guest';
$passwort = '';
$db = new PDO('mysql:host=localhost;
       dbname=PAUL;
       charset=utf8', 'guest', '', 
       array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

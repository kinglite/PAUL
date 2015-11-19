<?php

$username = 'guest';
$passwort = '';
$db = new PDO('mysql:host=localhost;
       dbname=PAUL;
       charset=utf8', 'guest', '', 
       array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

function orgaDeactivate($id){
    
    global $db;
    
    $statement = "UPDATE organisation_offer "
            . "SET startDate = '0000-00-00', endDate = '0000-00-00' "
            . "WHERE id = $id";
    
    $db->query($statement);
    
    
}

function deliverDeactivate($id){
    
    global $db;
    
    $statement = "UPDATE deliverer_offer "
            . "SET startDate = '0000-00-00', endDate = '0000-00-00' "
            . "WHERE id = $id";
    
    $db->query($statement);
    
    
}
<?php

function orgaDeactivate($id){
    
    global $db;
    
    $statement = 'UPDATE organisation_offer '
            . 'SET startDate = 00-00-0000, endDate = 00-00-0000'
            . 'WHERE id = $id';
    
    $db->query($statement);
    
    
}


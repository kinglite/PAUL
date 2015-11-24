<?php

include '../dbConnect.php';

function create_Organisation_Offer( $table, $orga_name, $startCountry, $startVillage,
                        $destinationCountry, $destinationVillage, $startDate, $endDate, $products)
{
    global $db;
    
    $tableName1 = $table;
    if($tableName1 == 'organisation_offer'){
        $tableName2 = 'productsorgajoin';
    }
    else{
        $tableName2 = 'productsdelivererjoin';
    }
    $tableName3 = 'countries';
    //Colums for the table organisation_offer:
    if($tableName1 == 'organisation_offer'){
        $cName = 'organisation';
    }
    else{
        $cName = 'name';
    }
    $cStartC = 'startCountry';
    $cstartV = 'startVillage';
    $cdestC = 'destinationCountry';
    $cdestV = 'destinationVillage';
    $cdateStart = 'startDate';
    $cdateEnd = 'endDate';
    $crespAcc = 'responsibleAcc';
    
    try{
        $statement00 = $db->prepare("SELECT ID FROM $tableName3 WHERE countryName LIKE '$startCountry'");
        $statement00->execute();
        $startCountry1 = $statement00->fetchColumn();
        
        $statement01 = $db->prepare("SELECT ID FROM $tableName3 WHERE countryName LIKE '$destinationCountry'");
        $statement01->execute();
        $destinationCountry1 = $statement01->fetchColumn();
        
        $statement1 = $db->prepare("INSERT INTO $tableName1 "
                . "                 ($cName, $cStartC, $cstartV, $cdestC, $cdestV, $cdateStart, $cdateEnd, $crespAcc) VALUES(?,?,?,?,?,?,?,?)");
        $statement1->execute(array($orga_name, $startCountry1, $startVillage,
                            $destinationCountry1, $destinationVillage, $startDate, $endDate, /*$_SESSION["accountID"]*/ 1 ));
        $lastInsertID = $db->lastInsertId();

        foreach ($products as $p){
            $statement2 = $db->prepare("INSERT INTO $tableName2 values( (SELECT products.ID FROM products WHERE products.productname LIKE '$p'), $lastInsertID)");
            $statement2->execute();
        }
    }
    catch(Exception $e){
        
        echo "Fehler beim Datenbankzugriff. Kontaktieren Sie den Administrator:". $e;        
    }
}
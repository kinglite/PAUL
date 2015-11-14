<?php

function create_Organisation_Offer( $orga_name, $startCountry, $startVillage,
                        $destinationCountry, $destinationVillage, $startDate, $endDate, $products)
{
    START_SESSION();
    
    //$_SESSION["accountID"];
    
    $username = 'guest';
    $passwort = '';
    $db = new PDO('mysql:host=localhost;
                    dbname=PAUL;
                    charset=utf8', $username, $passwort, 
                    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
    $tableName1 = 'organisation_offer';
    $tableName2 = 'productsorgajoin';
    //Colums for the table organisation_offer:
    $cOrga = 'organisation';
    $cStartC = 'startCountry';
    $cstartV = 'startVillage';
    $cdestC = 'destinationCountry';
    $cdestV = 'destinationVillage';
    $cdate = 'startDate';
    $cproduct = 'product';
    $crespAcc = 'responsibleAcc';
    
    try{
        $statement1 = $db->prepare("INSERT INTO $tableName1 t "
                . "                 ($cOrga, $cStartC, $cstartV, $cdestC, $cdestV, $cdate, $cproduct, $crespAcc) VALUES(?,?,?,?,?,?,?,?)");
        $statement1->execute(array($orga_name, $startCountry, $startVillage,
                            $destinationCountry, $destinationVillage, $startDate, $endDate, $_SESSION["accountID"] ));
        $lastInsertID = $db->lastInsertId();

        foreach ($products as $p){
            $statement2 = $db->prepare("INSERT INTO $tableName2 values( (SELECT products.ID FROM products WHERE products.productname LIKE $p), $lastInsertID)");
            $statement2->execute();
        }
    }
    catch(Exceptio $e){
        
        echo "Fehler beim Datenbankzugriff. Kontaktieren Sie den Administrator.";
        
    }
}
?>

<html>

    <body>
        
        
        
        
    </body>
    
    
</html>
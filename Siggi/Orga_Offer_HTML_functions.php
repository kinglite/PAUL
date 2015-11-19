<?php

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function checkInput(){
    
    if(!DateTime::createFromFormat('d.m.Y', $_POST['startDate'])
            && getdate() > $_POST['startDate']){
        return false;
    }
    if(!DateTime::createFromFormat('d.m.Y', $_POST['endDate'])
            && getdate() < $_POST['endDate']){
        return false;
    }
    
    echo "Alles in Ordnung";
    return true;
}

//function must be placed between <select><\select>
function selectCountryDropbox(){

    try{
        global $db;
        
        $statementStartC = "Select countryname from countries";

        foreach ( $db->query($statementStartC) as $row){

            echo "<option value=$row[countryname]>$row[countryname]</option>\n";
        }

        } catch (Exception $ex) {

        }


}

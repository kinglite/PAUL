<?php

        $postOK = true;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                
                //ORGANAME---------------------------------
                if(empty($_POST["name"])){
                    $postOK = false;
                    $nameErr = "Bitte Namen eingeben";
                }
                else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
                    $postOK = false;
                    $nameErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                }
                $name = test_input($_POST["name"]);
                
            
                //STARTCOUNTRY---------------------------------
                if(!empty($_POST["newStartCountry"])){
                    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["newStartCountry"])) {
                        $startCErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                    }
                    
                    $startCountry = test_input($_POST["newStartCountry"]);
                    
                }
                else{
                    if( $_POST["startCountry"] == ""){
                
                    $startCErr = "Bitte Land auswählen oder eigenes Land eingeben"; 
                    $postOK = false;    
                    }
                    
                    $startCountry = test_input($_POST["startCountry"]);
                }
                
                //STARTVILLAGE---------------------------------
                if(empty($_POST["startVillage"])){
                   $startVErr = "Bitte Dorf eingeben"; 
                   $postOK = false; 
                }
                else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["startVillage"])) {
                        $startVErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                    }
                
                $startVillage = test_input($_POST["startVillage"]);
                

                //DESTINATIONCOUNTRY---------------------------------
                if(!empty($_POST["newDestCountry"])){
                    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["newDestCountry"])) {
                        $destCErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                    }
                    
                    $destCountry = test_input($_POST["newDestCountry"]);
                    
                }
                else{
                    if( $_POST["destCountry"] == ""){
                      $destCErr = "Bitte Land auswählen oder eigenes Land eingeben"; 
                      $postOK = false;
                    }
                    
                    $destCountry = test_input($_POST["destCountry"]);
                    
                }

                //DESTINATIONVILLAGE---------------------------------
                if(empty($_POST["destVillage"])){
                   $destVErr = "Bitte Dorf eingeben"; 
                   $postOK = false;
                }
                else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["destVillage"])) {
                        $postOK = false;
                        $destVErr = "Bitte nur Buchstaben und Leerzeichen eingeben";
                }
                
                $destVillage = test_input($_POST["destVillage"]);
                

                //STARTDATE---------------------------------
                if(empty($_POST["startDate"])){
                   $startDateErr = "Bitte Datum eingeben"; 
                   $postOK = false; 
                }
                else if(validateDate($_POST["startDate"])){
                    $startDate = (new DateTime($_POST["startDate"]))->format('d.m.Y');
                }
                else{
                    $startDateErr = "Bitte gültiges Datum eingeben (T.M.Y)";
                    $postOK = false;
                    $startDate = test_input($_POST["startDate"]);
                }        

                //ENDDATE---------------------------------
                if(empty($_POST["endDate"])){
                     $endDateErr = "Bitte Datum eingeben"; 
                     $postOK = false;
                }
                else if(validateDate($_POST["endDate"])){
                    $endDate = (new DateTime($_POST["endDate"]))->format('d.m.Y');
                }
                else{
                    $endDateErr = "Bitte gültiges Datum eingeben (T.M.J)";
                    $postOK = false;
                    $endDate = test_input($_POST["endDate"]);
                }

                //PRODUCTS---------------------------------
                if(empty($_POST["productChoice"])){
                    $productErr = "Bitte mind. ein Produkt auswählen"; 
                     $postOK = false;
                }
                else
                    $products = $_POST["productChoice"];
                
                if($postOK){
                    create_Organisation_Offer($table, $name, $startCountry, $startVillage, $destCountry, $destVillage, reformDate($startDate), reformDate($endDate), $products);
                    
                    //TO DO leere.php ersetzen mit Auflistung der eingegebenen Daten
                    header('Location: leere.php');
                }
            }
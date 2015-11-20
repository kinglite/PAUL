<?php
$username = 'guest';
$passwort = '';
$db = new PDO('mysql:host=localhost;
       dbname=PAUL;
       charset=utf8', 'guest', '', 
       array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

include 'Angebot_erstellen.php';
include './Orga_Offer_HTML_functions.php';

$orgaErr = $startCErr = $startVErr = $destCErr = $destVErr = $startDateErr = $endDateErr = $productErr = "";

function checkBoxProducts(){
    
    global $db;
    
    try{
     $statementProd = "Select productname from products";

     foreach ( $db->query($statementProd) as $row){

         echo "<p><input type=\"checkbox\" name=\"productChoice[]\" value=$row[productname] id=\"check1\" checked> $row[productname]</p>\n";
      
     }

    } catch (Exception $ex) {

    }
    
}
?>


<!Doctype HTML>
<html>
    
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    
    <body> 
        <?php 
        $postOK = true;
        
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty($_POST["orga"])){
                    $postOK = false;
                    $orgaErr = "Bitte Namen eingeben";
                }
                else
                    $name = test_input($_POST["orga"]);
                
               if(!empty($_POST["newstartCountry"]))
                   $startCountry = test_input($_POST["newstartCountry"]);
               else{
                   if( $_POST["StartCountry"] == "--"){
                     $startCErr = "Bitte Land auswählen oder eigenes Land eingeben"; 
                     $postOK = false;
                   }
                   else
                     $startCountry = test_input($_POST["StartCountry"]);
               }
               
               if(empty($_POST["startVillage"])){
                  $startVErr = "Bitte Dorf eingeben"; 
                  $postOK = false; 
               }
               else
                    $startVillage = test_input($_POST["startVillage"]);
               
               if(!empty($_POST["newdestCountry"]))
                    $destCountry = test_input($_POST["newdestCountry"]);
               else{
                   if( $_POST["EndCountry"] == "--"){
                     $destCErr = "Bitte Land auswählen oder eigenes Land eingeben"; 
                     $postOK = false;
                   }
                    $destCountry = test_input($_POST["EndCountry"]);
               }
               
               if(empty($_POST["destVillage"])){
                  $destVErr = "Bitte Dorf eingeben"; 
                  $postOK = false;
               }
               else
                    $destVillage = test_input($_POST["destVillage"]);
               
               if(empty($_POST["startDate"])){
                  $startDateErr = "Bitte Datum eingeben"; 
                  $postOK = false; 
               }
               else
                    $startDate = test_input($_POST["startDate"]);
               
               if(empty($_POST["endDate"])){
                    $endDateErr = "Bitte Dorf eingeben"; 
                    $postOK = false;
               }
               else
                    $endDate = test_input($_POST["endDate"]);
               
               if(empty($_POST["productChoice"])){
                   $productErr = "Bitte mind. ein Produkt auswählen"; 
                    $postOK = false;
               }
               else
                   $products = ($_POST["productChoice"]);
               
               if($postOK)
                    create_Organisation_Offer($name, $startCountry, $startVillage, $destCountry, $destVillage, $startDate, $endDate, $products);
            }
        ?>
    
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <p>Ihr Organame*: <input type="text" name="orga" />
                <span class="error"> <?php echo $orgaErr;?></span>
            </p>
            <p>Das Startland*: 
            
                <select name="StartCountry">
                    <option value="--">--</option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $startCErr;?></span>
            </p>  
                
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newstartCountry" /></p>
            <p>Das Startdorf*: <input type="text" name="startVillage" />
                <span class="error"> <?php echo $startVErr;?></span>
            </p>
            <p>Das Zielland*:  
            
                <select name="EndCountry">
                    <option value="--">--</option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $destCErr;?></span>
            </p>
            
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newdestCountry" /></p>
            <p>Das Zieldorf*: <input type="text" name="destVillage" />
                <span class="error"> <?php echo $destVErr;?></span>
            </p>
            <p>Das Startdatum*: <input type="date" name="startDate" />
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>
            <p>Das Enddatum*: <input type="date" name="endDate" />
                <span class="error"> <?php echo $endDateErr;?></span>
            </p>
            <p>Welches Produkt: 
                    
                    <?php      
                        checkBoxProducts();
                    ?>
                <span class="error"> <?php echo $productErr;?></span>
            <p><input type="submit" /></p>
        </form>
    </body>
    
</html>



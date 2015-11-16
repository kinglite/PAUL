<?php
$username = 'guest';
$passwort = '';
$db = new PDO('mysql:host=localhost;
       dbname=PAUL;
       charset=utf8', 'guest', '', 
       array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

include './Orga_Offer_HTML_functions.php';

function checkBoxProducts($offer_id){
    
    global $db;
    
    try{
        
     $checked = FALSE;
     
     $statementProd = "Select * from products";

     $statementJoin = "SELECT * FROM productsorgajoin WHERE ID_organisationOffer = $offer_id";
     
     foreach ( $db->query($statementProd) as $row1){
         
         $checked = FALSE;
         
         foreach( $db->query($statementJoin) as $row2){
            if($row1['ID'] === $row2['ID_product'])
               $checked = True; 
         }
         if($checked)
            echo "<p><input type=\"checkbox\" name=\"productChoice[]\" value=$row1[productname] id=\"check1\" checked> $row1[productname]</p>\n";
         else
             echo "<p><input type=\"checkbox\" name=\"productChoice[]\" value=$row1[productname] id=\"check1\"> $row1[productname]</p>\n";
     }

    } catch (Exception $ex) {

    }
    
}

function getCountry($id){
    
    global $db;
    
    try{
     $statementProd = "Select countryName from countries "
             . "WHERE id = $id ";

     foreach ( $db->query($statementProd) as $row){

         return $row['countryName'];
      
     }

    } catch (Exception $ex) {
        
        echo "ERROR";

    }  
}

function getColumnData($id, $column){
    
    global $db;
    
    $statement = "SELECT $column FROM organisation_offer WHERE id = $id";
    
    foreach ($db->query($statement) as $row){
        
        return $row[$column];
    }
}

?>


<!Doctype HTML>
<html>
    
    <?php
    $id = $_POST['offerID'];
    $id = 2;
    ?>
    
    <body>    
    
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <p>Ihr Organame: <input type="text" name="orga" value=
                                <?php
                                    echo getColumnData($id, 'organisation');
                                ?>>
            </p>
            
            <p>Das Startland: 
            
                <select name="StartCountry">
                    <option value=
                        <?php
                            echo getCountry(getColumnData($id, 'startCountry'));
                        ?>
                    >
                    <?php
                        echo getCountry(getColumnData($id, 'startCountry'));
                    ?>
                    </option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
            </p>  
                
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newstartCountry" /></p>
            
            <p>Das Startdorf: <input type="text" name="startVillage" value=
                <?php
                    echo getColumnData($id, 'startVillage');
                ?>>
            </p>
            
            <p>Das Zielland:  
            
                <select name="EndCountry">
                    <option value=
                        <?php
                            echo getCountry(getColumnData($id, 'destinationCountry'));
                        ?>
                    >
                        <?php
                            echo getCountry(getColumnData($id, 'destinationCountry'));
                        ?>
                    </option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
            </p>
            
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newdestCountry" /></p>
            
            <p>Das Zieldorf: <input type="text" name="destVillage" value=
                <?php
                    echo getColumnData($id, 'destinationVillage');
                ?>>
            </p>
            
            <p>Das Startdatum: <input type="date" name="startDate" value=
                <?php
                    echo getColumnData($id, 'startDate');
                ?>>
            </p>
            
            <p>Das Enddatum: <input type="date" name="endDate" value=
                <?php
                    echo getColumnData($id, 'endDate');
                ?>>
            </p>
            <p>Welches Produkt: 
                    
                    <?php      
                        checkBoxProducts($id);
                    ?>
            <p><input type="submit" /></p>
        </form>
        
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
               $name = test_input($_POST["orga"]);
               if(isset($_POST["newstartCountry"]))
                    $startCountry = test_input($_POST["newstartCountry"]);
               else
                    $startCountry = test_input($_POST["StartCountry"]);
               $startVillage = test_input($_POST["startVillage"]);
               if(isset($_POST["newdestCountry"]))
                    $destCountry = test_input($_POST["newdestCountry"]);
               else
                    $destCountry = test_input($_POST["EndCountry"]);
               $destVillage = test_input($_POST["destVillage"]);
               $startDate = test_input($_POST["startDate"]);
               $endDate = test_input($_POST["endDate"]);
               $products = test_input($_POST["productChoice"]);
               
               create_Organisation_Offer($name, $startCountry, $startVillage, $destCountry, $destVillage, $startDate, $endDate, $products);
            }
        ?>
    </body>
    
</html>



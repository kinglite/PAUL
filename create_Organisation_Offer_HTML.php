<?php
$username = 'guest';
$passwort = '';
$db = new PDO('mysql:host=localhost;
       dbname=PAUL;
       charset=utf8', 'guest', '', 
       array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

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

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>


<!Doctype HTML>
<html>
    
    <body>    
    
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <p>Ihr Organame: <input type="text" name="orga" /></p>
            <p>Das Startland: 
            
                <select name="StartCountry">
                    <option value="--">--</option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
            </p>  
                
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newstartCountry" /></p>
            <p>Das Startdorf: <input type="text" name="startVillage" /></p>
            <p>Das Zielland:  
            
                <select name="EndCountry">
                    <option value="--">--</option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
            </p>
            
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newdestCountry" /></p>
            <p>Das Zieldorf: <input type="text" name="destVillage" /></p>
            <p>Das Startdatum: <input type="date" name="startDate" /></p>
            <p>Das Enddatum: <input type="date" name="endDate" /></p>
            <p>Welches Produkt: 
                    
                    <?php      
                        checkBoxProducts();
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



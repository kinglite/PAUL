<?php

$table = 'organisation_offer';
include 'Angebot_erstellen.php';
include 'Offer_HTML_functions.php';
include 'eingabeCheck.php';

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

        ?>
    
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <p>Ihr Organame*: <input type="text" name="name" value="<?php echo $name; ?>"/>
                <span class="error"> <?php echo $nameErr;?></span>
            </p>
            <p>Das Startland*: 
            
                <select name="startCountry">
                    <option value="<?php echo $startCountry; ?>"><?php echo $startCountry; ?></option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $startCErr;?></span>
            </p>  
                
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newStartCountry"
                <?php 
                    if(!empty($_POST["newStartCountry"])){
                        echo "value = \"$startCountry\"";
                    }
                ?> />
            </p>
            <p>Das Startdorf*: <input type="text" name="startVillage" value="<?php echo $startVillage; ?>"/>
                <span class="error"> <?php echo $startVErr;?></span>
            </p>
            <p>Das Zielland*:  
            
                <select name="destCountry">
                    <option value="<?php echo $destCountry; ?>"><?php echo $destCountry; ?></option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $destCErr;?></span>
            </p>
            
            <p>gewünschtes Land nicht gelistet: <input type="text" name="newDestCountry" 
                                                       <?php 
                    if(!empty($_POST["newDestCountry"])){
                        echo "value = \"$destCountry\"";
                    }
                ?> />
            </p>
            
            <p>Das Zieldorf*: <input type="text" name="destVillage" value="<?php echo $destVillage; ?>"/>
                <span class="error"> <?php echo $destVErr;?></span>
            </p>
            <p>Das Startdatum*: <input type="date" name="startDate" value="<?php echo $startDate; ?>"/>
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>
            <p>Das Enddatum*: <input type="date" name="endDate" value="<?php echo $endDate; ?>"/>
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



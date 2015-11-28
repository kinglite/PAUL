<?php
include './Angebot_erstellen.php';
include './Offer_HTML_functions.php';
include './eingabeCheck.php';
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

            <?php
            if($table == 'deliverer_offer'){
                echo "<p>Ihr Name*: <input type=\"text\" name=\"name\" value=\"$name\" required=\"required\">" .
                "<span class=\"error\"> $nameErr</span>" .
            "</p>";
            }
            else{
              echo "<p>Ihr Organame*: <input type=\"text\" name=\"name\" value=\"$name\" required=\"required\">" .
                "<span class=\"error\"> $nameErr</span>" .
            "</p>";
              echo "<p>Ansprechpartner: <input type=\"text\" name=\"contact\" value=$contact>" .
                "<span class=\"error\"> $contactErr</span>" .
            "</p>";
            }
            ?>
            
            <p>Ihre eMail*: <input type="email" name="eMail" value="<?php echo $eMail; ?>" required="required"/>
                <span class="error"> <?php echo $eMailErr;?></span>
            </p>
            
            <p>Das Startland*: 
            
                <select name="startCountry" required="required">
                    <option value="<?php echo $startCountry; ?>"><?php echo $startCountry; ?></option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $startCErr;?></span>
            </p>  
                
            <p>Das Startdorf*: <input type="text" name="startVillage" value="<?php echo $startVillage; ?>" required="required"/>
                <span class="error"> <?php echo $startVErr;?></span>
            </p>
            <p>Das Zielland*:  
            
                <select name="destCountry" required="required">
                    <option value="<?php echo $destCountry; ?>"><?php echo $destCountry; ?></option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $destCErr;?></span>
            </p>
            
            <p>Das Zieldorf*: <input type="text" name="destVillage" value="<?php echo $destVillage; ?>" required="required"/>
                <span class="error"> <?php echo $destVErr;?></span>
            </p>
            <p>Das Startdatum*: <input type="date" name="startDate" value="<?php echo $startDate; ?>" required="required"/>
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>
            <p>Das Enddatum*: <input type="date" name="endDate" value="<?php echo $endDate; ?>" required="required"/>
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

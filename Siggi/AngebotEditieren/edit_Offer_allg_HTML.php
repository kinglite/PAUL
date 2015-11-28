<!Doctype HTML>
<html> 
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    
    <body>    
    
        <form onSubmit="return" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <?php
            if($table == 'organisation_offer'){
            echo "<p>Ihr Organame: <input type=\"text\" name=\"name\" value=\"";
                                
                if(!isset($_POST['name']))
                    echo getColumnData($id, 'name')."\">";
                else
                    echo $name."\">";
                
                echo "<span class=\"error\">$nameErr</span>";
            echo "</p>";
            
            echo "<p>Ansprechpartner: <input type=\"text\" name=\"contact\" value=\"";
                if(!isset($_POST['contact']))
                    echo getColumnData($id, 'contact')."\">";
                else
                    echo $contact."\">";
                    
                echo "<span class=\"error\">$contactErr</span>";
            echo "</p>";
            }
            else{
                echo "<p>Ihr Name: <input type=\"text\" name=\"name\" value=\"";
                                
                if(!isset($_POST['name']))
                    echo getColumnData($id, 'name')."\">";
                else
                    echo $name."\">";
                
                echo "<span class=\"error\">$nameErr</span>";
            echo "</p>";
            }
            ?>
            
            <p>Ihre eMail: <input type="email" name="eMail" value=
                                <?php
                                if(!isset($_POST['eMail']))
                                    echo getColumnData($id, 'eMail');
                                else
                                    echo $eMail;
                                ?>>
                <span class="error"> <?php echo $eMailErr;?></span>
            </p>
            
            <p>Das Startland: 
            
                <select name="startCountry">
                    <option value=
                        <?php
                        if(!isset($_POST['startCountry']))
                            echo getCountry(getColumnData($id, 'startCountry'));
                        else
                            echo $startCountry;
                        ?>
                    >
                    <?php
                    if(!isset($_POST['startCountry']))
                        echo getCountry(getColumnData($id, 'startCountry'));
                    else
                        echo $startCountry;
                    ?>
                    </option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $startCErr;?></span>
            </p>  
            
            <p>Das Startdorf: <input type="text" name="startVillage" value=
                <?php
                if(!isset($_POST['startVillage']))
                    echo getColumnData($id, 'startVillage');
                else
                    echo $startVillage;
                ?>>
                <span class="error"> <?php echo $startVErr;?></span>
            </p>
            
            <p>Das Zielland:  
            
                <select name="destCountry">
                    <option value=
                        <?php
                        if(!isset($_POST['destCountry']))
                            echo getCountry(getColumnData($id, 'destinationCountry'));
                        else
                            echo $destCountry;
                        ?>
                    >
                        <?php
                        if(!isset($_POST['destCountry']))
                            echo getCountry(getColumnData($id, 'destinationCountry'));
                        else
                            echo $destCountry;
                        ?>
                    </option>
                    <?php
                        selectCountryDropbox();
                   ?> 
                </select> 
                <span class="error"> <?php echo $destCErr;?></span>
            </p>
                        
            <p>Das Zieldorf: <input type="text" name="destVillage" value=
                <?php
                if(!isset($_POST['destVillage']))
                    echo getColumnData($id, 'destinationVillage');
                else
                    echo $destVillage;
                ?>>
                <span class="error"> <?php echo $destVErr;?></span>
            </p>
            
            <p>Das Startdatum: <input type="date" name="startDate" value=
                <?php
                if(!isset($_POST['startDate']))
                    echo reformDatetoNormal(getColumnData($id, 'startDate'));
                else
                    echo $startDate;
                ?>>
                <span class="error"> <?php echo $startDateErr;?></span>
            </p>
            
            <p>Das Enddatum: <input type="date" name="endDate" value=
                <?php
                if(!isset($_POST['endDate']))
                    echo reformDatetoNormal(getColumnData($id, 'endDate'));
                else
                    echo $endDate;
                ?>>
                <span class="error"> <?php echo $endDateErr;?></span>
            </p>
            <p>Welches Produkt: 
                    
                    <?php      
                        checkBoxProductsFilled($id);
                    ?>
            <p>
                <span class="error"> <?php echo $productErr;?></span>
            <p><input type="submit" /></p>
        </form>
    </body>
    
</html>



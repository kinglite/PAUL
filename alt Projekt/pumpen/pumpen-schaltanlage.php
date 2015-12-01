<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="schalt">
            <h1><img src="../images/logo.png" alt="logo"> Schaltanlage</h1>
            Optionale Angaben
            <p>Schritt 6/7</p>

            <p>Ort der Schaltanlage</p>
            <input type="hidden" name="schalt" value="">
            <input type="radio" id="inside" name="schalt" value="im Gebäude (Innenschrank)">
            <label for="inside">im Gebäude (Innenschrank)</label><br> 
            <input type="radio" id="outside" name="schalt" value="im Gelände (Freiluftschrank">
            <label for="outside">im Gelände (Freiluftschrank)</label><br> 

            <h1>Entfernung Steuerung / Pumpe</h1>
            <input type="hidden" name="entfernung" value="">
            <input type="radio" id="10" name="entfernung" value="10">
            <label for="10">bis 10 m</label><br>
            <input type="radio" id="gr10" name="entfernung" value="gr10">
            <label for="gr10"> ab 10 m – genaue Entfernung <input type="number" name="hoechststand" value="<?php
                if (isset($_SESSION["hoechststand"])) {
                    echo $_SESSION["hoechststand"];
                }
                ?>"/> m</label><br>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
        <form action="pumpen-einbau.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

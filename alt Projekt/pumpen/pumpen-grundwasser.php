<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Grundwasser</title>
    </head>
    <body>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="grw">
            <h1><img src="../images/logo.png" alt="logo"> Grundwasser</h1>
            Optionale Angaben
            <p>Schritt 4/7</p>
            <p>Höchststand ab OK Abdeckung <input type="number" name="hoechststand" value="<?php
                if (isset($_SESSION["hoechststand"])) {
                    echo $_SESSION["hoechststand"];
                }
                ?>"/> m</p>

            <p>Pumpe/n</p>
            <input type="hidden" name="nutzung" value="">
            <input type="radio" id="privat" name="nutzung" value="Private Haushalte"><label for="privat">Private Haushalte</label><br> 
            <input type="radio" id="gewerblich" name="nutzung" value="Gewerbliche Nutzung"><label for="gewerblich">Gewerbliche Nutzung</label><br> 

            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
        <form action="pumpen-schacht.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

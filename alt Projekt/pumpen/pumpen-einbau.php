<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Einbausituation / Ausstattung</title>
    </head>
    <body>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="einb">
            <h1><img src="../images/logo.png" alt="logo"> Einbausituation / Ausstattung</h1>
            Optionale Angaben
            <p>Schritt 5/7</p>
            <input type="hidden" name="pumpen" value="">
            <input type="radio" id="einzel" name="pumpen" value="Einzelanlage">
            <label for="einzel">Einzelanlage</label><br> 
            <input type="radio" id="doppel" name="pumpen" value="Doppelanlage">
            <label for="doppel">Doppelanlage</label><br> 
            <input type="radio" id="dreifach" name="pumpen" value="Dreifachanlage">
            <label for="dreifach">Dreifachanlage</label><br>
            <input type="radio" id="mehrere" name="pumpen" value="Leistung auf mehrere Pumpen verteilt">
            <label for="mehrere">Leistung auf mehrere Pumpen verteilt</label><br>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
        <form action="pumpen-grundwasser.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

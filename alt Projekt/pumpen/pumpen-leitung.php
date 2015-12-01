<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Rückstauschleife und Druckleitung</title>
    </head>
    <body>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="leitung">
            <h1><img src="../images/logo.png" alt="logo"> Rückstauschleife und Druckleitung</h1>
            Optionale Angaben
            <p>Schritt 7/7</p>
            <p>Rückstauschleife vorgesehen?</p>
            <input type="hidden" name="schleife" value="">
            <input type="radio" id="sJa" name="schleife" value="Ja">
            <label for="ja">Ja</label><br> 
            <input type="radio" id="sNein" name="schleife" value="Nein">
            <label for="nein">Nein</label><br> 

            <h1>Druckleitung permanent steigend?</h1>
            <input type="hidden" name="druckleitung" value="">
            <input type="radio" id="dlJa" name="druckleitung" value="Ja">
            <label for="ja">Ja</label><br> 
            <input type="radio" id="dlNein" name="druckleitung" value="Nein">
            <label for="nein">Nein</label><br> 
            <p>
                <input class="submitButton" type="submit" value="Zur Auswertung" />
            </p>
        </form>
        <form action="pumpen-schaltanlage.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Schacht</title>
    </head>
    <body>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="scha">
            <h1><img src="../images/logo.png" alt="logo"> Schacht</h1>
            Optionale Angaben
            <p>Schritt 3/7</p>
            <p>Abdeckungsklasse:</p>
            <input type="hidden" name="abKlasse" value="">
            <input type="radio" id="a" name="abKlasse" value="a"><label for="a">A</label><br> 
            <input type="radio" id="b" name="abKlasse" value="b"><label for="b">B</label><br> 
            <input type="radio" id="d" name="abKlasse" value="d"><label for="d">D</label> 
            <p>
            <p>Leiter Ausführung:</p>
            <input type="hidden" name="leiter" value="">
            <input type="radio" id="es" name="leiter" value="a"><label for="es">Edelstahlausführung</label><br> 
            <input type="radio" id="gfk" name="leiter" value="b"><label for="gfk">GfK-Ausführung</label><br> 

            <p>Zulauftiefe <input type="number" name="zulauftiefe" /> mm</p>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
        <form action="pumpen-druckrohrleitung.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

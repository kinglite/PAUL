<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Druckrohrleitung</title>
    </head>
    <body>
        <?php
        SESSION_START();
        switch ($_SESSION["art"]) {
            case "asWasser":
                $back = "pumpen-asWasser-1";
                break;
            case "swWasser":
                $back = "pumpen-swWasser-1";
                break;
            case "nsWasser":
                $back = "pumpen-nsWasser-1";
                break;
            case "grWasser":
                $back = "pumpen-grWasser-1";
                break;
        }
        ?>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="dl">
            <h1><img src="../images/logo.png" alt="logo"> Druckrohrleitung</h1>
            Pflichtangaben
            <p>Schritt 2/7</p>
            <p>Länge: 
                <input type="number" name="laenge" value="<?php
                if (isset($_SESSION["laenge"])) {
                    echo $_SESSION["laenge"];
                }
                ?>" required="required"/> m
            </p>
            <p>Höhenunterschied 
                <input type="number" name="hoenenunterschied" value="<?php
                if (isset($_SESSION["hoenenunterschied"])) {
                    echo $_SESSION["hoenenunterschied"];
                }
                ?>" required="required"/>
                m (von der Zulauftiefe zum höchsten Punkt der Druckrohrleitung)
            </p>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
            <p>
            </p>
        </form>
        <form action="<?php echo $back; ?>.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>


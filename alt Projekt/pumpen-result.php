<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title>Pumpen Auswertung</title>
    </head>
    <body>
        <?php
        //Post-Werte in Session speichern. 
        SESSION_START();
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = htmlspecialchars($value);
        }
        //DB-Verbindung
        require_once ('konfiguration.php');
        $db_link = mysqli_connect(
                MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
        );

        echo "<h1><img src=\"images/logo.png\" alt=\"logo\"> Pumpen Ergebnis</h1>";

        if (MF3068()) {
            $result = "MF3068";
            getResult($result, "p");
        } elseif (MF3090()) {
            $result = "MF3090";
            getResult($result, "p");
        } elseif (C3045()) {
            $result = "CS3045";
            getResult($result, "f");
        } elseif (C3057()) {
            $result = "CS3057";
            getResult($result, "f");
        } else {
            $_SESSION["empf"] = "<p>Für eine Empfehlung nehmen Sie bitte Kontakt mit uns auf.</p>";
        }

        echo $_SESSION["empf"];
        ?>

        <form action="kontakt.php" method="post" >
            <p>
                <input class="submitButton" type="submit" value="Kontakt aufnehmen" />
            </p>
        </form>
        <form action="pumpen/pumpen-leitung.php" method="post" > 
            <p>
                <input class="backButton" type="submit" value="Zurück"/>
            </p>
        </form>
        <form action="pumpen-start.php" method="post" >  
            <p>
                <input class="backButton" type="submit" value="Zurück zum Anfang"/>
            </p>
        </form>
    </body>
</html>

<?php

function getResult($result, $pumpenart) {
    $empfehlungsText = "<p>Wir empfehlen Ihnen die Pumpe ";
    if ($pumpenart == "p") {
        $linkZurPumpeLevaPol = ".</p>"
                . " <img src=\"images/" . $result . ".png\" alt=\"pumpe\" height=\"250\" width=\"300\"> "
                . "<p>Weitere Informationen zur Pumpe finden Sie hier: <a href=\"http://www.mall.info/produkte/pumpen-und-anlagentechnik/kompaktpumpstationen/levapol.html\" target=\"_blank\">"
                . "Mall-Kompaktpumpstation LevaPol</a></p>";
        $_SESSION["empf"] = $empfehlungsText . $result . $linkZurPumpeLevaPol;
    } else {
        $linkZurPumpeLevaFlow = ".</p>"
                . " <img src=\"images/" . $result . ".png\" alt=\"pumpe\" height=\"42\" width=\"42\"> "
                . "<p>Weitere Informationen zur Pumpe finden Sie hier: <a href=\"http://www.mall.info/produkte/pumpen-und-anlagentechnik/kompaktpumpstationen/levapol.html\" target=\"_blank\">"
                . "Mall-Einzel- und Doppelpumpstationen LevaFlow</a></p>";
        $_SESSION["empf"] = $empfehlungsText . $result . $linkZurPumpeLevaFlow;
    }
    return true;
}

function C3045() {
    if ($_SESSION["foerdermenge"] > 10.25) {
        return false;
    } else if ($_SESSION["Hman"] > 14) {
        return false;
    } else {
        $wert = - 0.008 * pow($_SESSION["foerdermenge"], 3) + 0.1315 * pow($_SESSION["foerdermenge"], 2) - 1.469 * $_SESSION["foerdermenge"] + 14.5;
        if ($_SESSION["Hman"] <= $wert) {
            return true;
        }
    }
    return false;
}

function C3057() {
    if ($_SESSION["foerdermenge"] > 18) {
        return false;
    } else if ($_SESSION["Hman"] > 20.5) {
        return false;
    } else {
        $wert = 0.02 * pow($_SESSION["foerdermenge"], 3) - 0.23 * pow($_SESSION["foerdermenge"], 2) - 0.532 * $_SESSION["foerdermenge"] + 20.5;
        if ($_SESSION["Hman"] <= $wert) {
            return true;
        }
    }
    return false;
}

function MF3068() {
    if ($_SESSION["foerdermenge"] > 4.35) {
        return false;
    } else if ($_SESSION["Hman"] > 33) {
        return false;
    } else {
        $wert = -0.791 * pow($_SESSION["foerdermenge"], 3) + 3.659 * pow($_SESSION["foerdermenge"], 2) - 5.109 * $_SESSION["foerdermenge"] + 33;
        if ($_SESSION["Hman"] <= $wert) {
            return true;
        }
    }
    return false;
}

function MF3090() {
    if ($_SESSION["foerdermenge"] > 5.2) {
        return false;
    } else if ($_SESSION["Hman"] > 45.4) {
        return false;
    } else {
        $wert = -0.318 * pow($_SESSION["foerdermenge"], 3) + 1.835 * pow($_SESSION["foerdermenge"], 2) - 5.097 * $_SESSION["foerdermenge"] + 45.4;
        if ($_SESSION["Hman"] <= $wert) {
            return true;
        }
    }
    return false;
}

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title>Pelletspeicher Auswertung</title>
    </head>
    <body>
        <form action="kontakt.php" method="post" >  
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

            echo "<h1><img src=\"images/logo.png\" alt=\"logo\"> Pelletspeicher Ergebnis</h1>";
            //146250 als Leistung für Pel 45000
            if ($_SESSION["kesselhersteller"]) {
                echo "Leider ist ihre angegebene Heizkessel-Leistung "
                . "zu groß oder zu klein um Ihnen einen Hersteller zu empfehlen. "
                . "Bitte nehmen Sie Kontakt mit uns auf.";
            }
            if ($_SESSION["volumen"] == "kWh") {
                $_SESSION["nutzvolumen"] = $_SESSION["leistung"] / 3250;
            } else {
                $_SESSION["leistung"] = $_SESSION["nutzvolumen"] * 3250;
            }

            //$_SESSION["leistung"] = str_replace(".",",", $_SESSION["leistung"]);
            // $_SESSION["nutzvolumen"] = str_replace(".",",", $_SESSION["nutzvolumen"]);

            $nutzvolumen = $_SESSION["nutzvolumen"];


            $end = false;

            //echo$nutzvolumen;
            max_leistung($db_link);
            $linkZumSpeicher = "";
            $erstePumpe = "";
            $sql = "SELECT * FROM pelletspeicher INNER JOIN pelletspeichertypen ON pelletspeicher.pelletspeichertypen_id=pelletspeichertypen.id; ";
            $db_erg = mysqli_query($db_link, $sql);
            while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {

                if ($nutzvolumen <= $zeile['nutzvolumen'] * 0.95 OR $nutzvolumen <= $zeile['nutzvolumen'] * 1.05) {
                    if ($end) {
                        if ($zeile['nutzvolumen'] * 0.95 <= $nutzvolumen) {
                            echo "<p>Außerdem können Wir Ihnen den Pelletspeicher " . $zeile['bezeichnung'] . " " . $zeile['name'] . " empfehlen.</p>"
                            . "<img src=\"images/" . $zeile['image'] . ".jpg\" alt=\"speicher 2\">";
                            $_SESSION["speicher"] = $_SESSION["speicher"] . "und" . $zeile['bezeichnung'] . " " . $zeile['name'];
                            if ($erstePumpe != $zeile['name']) {
                                echo $linkZumSpeicher . "<p>Informationen zu dem " . utf8_encode($zeile['text']) . " finden Siel hier: "
                                . "<a href=\"" . $zeile['link'] . "\" target=\"_blank\">"
                                . $zeile['name'] . "</a></p>";
                            }
                        }
                        break;
                    } else {
                        echo "<p>Wir empfehlen Ihnen den Pelletspeicher " . $zeile['bezeichnung'] . " " . $zeile['name'] . " für Ihr Projekt.</p>";
                        echo " <img src=\"images/" . $zeile['image'] . ".jpg\" alt=\"speicher\"> ";
                        $_SESSION["speicher"] = $zeile['bezeichnung'] . " " . $zeile['name'];
                        $end = true;
                        echo "<p>Informationen zu dem " . utf8_encode($zeile['text']) . " finden Siel hier: "
                        . "<a href=\"" . $zeile['link'] . "\" target=\"_blank\">"
                        . $zeile['name'] . "</a></p>";
                        $erstePumpe = $zeile['name'];
                    }
                }
            }

            //Link zur Staatlichenförderung
            echo "<p>Infos zur Staatlichen Förderung finden Sie hier: "
            . "<a href=\"http://www.bafa.de/bafa/de/energie/erneuerbare_energien/index.html\" target=\"_blank\">"
            . "Bundesamt für Wirtschaft und Ausfuhrkontrolle</a></p>";
            ?>
            <p>
                <input class="submitButton" type="submit" value="Kontakt aufnehmen"/>
            </p>
        </form>
        <form action="pelletspeicher.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

<?php

function max_leistung($db_link) {
    global $leistung;
    $sql = "SELECT MAX(leistung) FROM pelletspeicher";
    $db_erg = mysqli_query($db_link, $sql);

    $max_leistung = mysqli_fetch_array($db_erg, MYSQL_ASSOC)['MAX(leistung)'];

    if ($leistung > $max_leistung) {
        echo "Achtung, maximal anschließbare Kesselleistung überschritten. Bitte Kontakt mit Fa. Mall aufnehmen.";
        exit;
    }
}

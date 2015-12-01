
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        SESSION_START();
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = htmlspecialchars($value);
        }
        $text2 = "";
        $empfaenger = $_SESSION["email"];
        $betreff = "Ihre Anfrage bei Mall";
        $from = "From: Mall Info <info@mall.de>";
        $from .= "Reply-To: info@mall.de\n";
        $from .= "Content-Type: text/html\n";
        $text = "Vielen Dank für Ihr Interesse. Wir werden uns bald bei Ihnen melden."
                . "<br>"
                . "Ihre Daten:";


        if ($_SESSION["art"] == "pel") {
            $text = $text
                    . "<p>Bemessungsgrundwasserstand ab Gelände-Oberkante: "
                    . $_SESSION["hk-leistung"]
                    . "<br>"
                    . "Abstand zwischen Heizkessel und Außenkante Pelletspeicher: "
                    . $_SESSION["abstand"]
                    . "<br>"
                    . "Anzahl der Bögen im Saugschlauch: "
                    . $_SESSION["boegen"]
                    . "<br>"
                    . "Höhenunterschied zwischen Saugturbine am Heizkessel und Schachtabdeckung Pelletspeicher  
                (liegt die Turbine höher als Schachtabdeckung, bitte negativen Wert eintragen): "
                    . $_SESSION["hoenenunterschied"]
                    . "<br>"
                    . "Lastbild der Schachtabdeckung: "
                    . $_SESSION["lastbild"]
                    . "<br>"
                    . "Jahres-Endenergie-Verbrauch in kWh: "
                    . $_SESSION["leistung"]
                    . "<br>"
                    . "Nutzvolumen in m³: "
                    . $_SESSION["nutzvolumen"]
                    . "</p>"
                    . "Unsere Empfehlung für Sie: "
                    . $_SESSION["speicher"]
                    . "<br>"
                    . "Ihr gewählter Kesselhersteller: "
                    . $_SESSION["kesselhersteller"]
                    . "<br>";
        } else {
            $text2 = "<p>Optionale Angaben"
                    . "Druckrohrleitung Länge: "
                    . $_SESSION["laenge"]
                    . "<br>"
                    . "Höhenunterschied von der Zulauftiefe: "
                    . $_SESSION["hoenenunterschied"] . " m"
                    . "<br>"
                    . "Schacht Abdeckungsklasse: "
                    . $_SESSION["abKlasse"]
                    . "<br>"
                    . "Leiter Ausführung: "
                    . $_SESSION["leiter"]
                    . "<br>"
                    . "Zulauftiefe: "
                    . $_SESSION["zulauftiefe"] . " mm"
                    . "<br>"
                    . "Höchststand ab OK Abdeckung: "
                    . $_SESSION["hoechststand"] . " m"
                    . "<br>"
                    . "Pumpe/n: "
                    . $_SESSION["nutzung"]
                    . "<br>"
                    . "Einbausituation / Ausstattung: "
                    . $_SESSION["pumpen"] . " m"
                    . "<br>"
                    . "Ort der Schaltanlage: "
                    . $_SESSION["abKlasse"]
                    . "<br>"
                    . "Entfernung Steuerung / Pumpe: ";
            if ($_SESSION["entfernung"] == "10") {
                $text2 = $text2 . "<=10 m";
            } elseif ($_SESSION["entfernung"] == "gr10") {
                $text2 = $text2 . $_SESSION["hoechststand"] . "m";
            }
            $text2 = $text2
                    . "<br>"
                    . "Rückstauschleife vorgesehen? "
                    . $_SESSION["schleife"]
                    . "<br>"
                    . "Druckleitung permanent steigend? "
                    . $_SESSION["druckleitung"]
                    . "<br>"
                    . "</p>";


            if ($_SESSION["art"] == "swWasser") {
                $text = $text
                        . "<p>Abwasser fäkalienhaltig"
                        . "<br>";
                if ($_SESSION["volumen"] == "mr") {
                    $text = $text . "Menge: " . $_SESSION["foerdermenge"] . " l/s" . "<br>";
                } elseif ($_SESSION["volumen"] == "wcr") {
                    $text = $text . "WC: " . $_SESSION["wc"] . " Stück" . "<br>";
                } elseif ($_SESSION["volumen"] == "aer") {
                    $text = $text . "Anzahl Einwohner: " . $_SESSION["wc"] . "<br>";
                }
                $text = $text . "</p>";
            } else if ($_SESSION["art"] == "grWasser") {
                $text = $text
                        . "<p>Abwasser fäkalienfrei (Grauwasser)"
                        . "<br>";
                if ($_SESSION["volumen"] == "mr") {
                    $text = $text . "Menge: " . $_SESSION["foerdermenge"] . " l/s" . "<br>";
                } elseif ($_SESSION["volumen"] == "br") {
                    $text = $text . "Waschbecken: " . $_SESSION["waschbecken"] . " Stück" . "<br>"
                            . "Dusche: " . $_SESSION["dusche"] . " Stück" . "<br>"
                            . "Bodenlauf: " . $_SESSION["bodenlauf"];
                }
                $text = $text . "</p>";
            } else if ($_SESSION["art"] == "asWasser") {
                $text = $text
                        . "<p>Abwasser aus Abscheideranlage"
                        . "<br>";
                $text = $text . "Menge: " . $_SESSION["asWasser"] . " l/s" . "<br>"
                        . "Nenngröße: " . $_SESSION["NGr"]
                        . "</p>";
            } else if ($_SESSION["art"] == "nsWasser") {
                $text = $text
                        . "<p>Niederschlagswasser"
                        . "<br>";
                $text = $text . "Menge: " . $_SESSION["nsWasser"] . " l/s" . "<br>"
                        . "</p>";
            }

            $text = $text . $text2;
            $text2 = "<p>" . $_SESSION["empf"] . "</p>";
        }
        $text = $text
                . "<p>Ihre Kontaktdaten: "
                . "<br>"
                . "Firma / Behörde: "
                . $_SESSION["firma"]
                . "<br>"
                . "Name: "
                . $_SESSION["name"]
                . "<br>"
                . "Telefon: "
                . $_SESSION["tel"]
                . "<br>"
                . "Mobil: "
                . $_SESSION["mobil"]
                . "<br>"
                . "E-Mail: "
                . $_SESSION["email"]
                . "<br>"
                . "PLZ: "
                . $_SESSION["plz"]
                . "<br>"
                . "Straße: "
                . $_SESSION["str"]
                . "<br>"
                . "Ort: "
                . $_SESSION["ort"]
                . "<br>"
                . "Projektname: "
                . $_SESSION["projektname"]
                . "</p>";


        echo $text . $text2;
        //Email an Kunde
        //mail($empfaenger, $betreff, $text, $from);

        //Email an Mall
        if ($_SESSION["art"] == "pel") {
            $artAnfrage = "Pelletspeicher";
        } else {
            $artAnfrage = "Pumpen";
        }

        $empfaenger = "info@mall.de";
        $betreff = "Anfrage bei Mall bezüglich " . $artAnfrage;
        $from = "From: " . $_SESSION["name"] . " <" . $_SESSION["email"] . ">";
        $from .= "Reply-To: " . $_SESSION["email"] . "\n";
        $from .= "Content-Type: text/html\n";

        //mail($empfaenger, $betreff, $text, $from);
        ?>
    </body>
</html>
        <?php
        //session_destroy();
<!DOCTYPE html>

<html>
    <head>
        <script>
            function selectNutzvolumen() {
                document.getElementById("leistung").disabled = true;
                document.getElementById("leistung").value = "";
                document.getElementById("nutzvolumen").disabled = false;
            }

            function selectLeistung() {
                document.getElementById("leistung").disabled = false;
                document.getElementById("nutzvolumen").disabled = true;
                document.getElementById("nutzvolumen").value = "";
            }

            function submitForm() {
                if (document.getElementById("leistung").value === "" && document.getElementById("nutzvolumen").value === "") {
                    alert("Sie müssen entweder den Jahres-Endenergie-Verbrauch oder das Nutzvolumen angeben.");
                    document.getElementById("werte").style.color = "#FF0000";
                    document.getElementById("hk-leistungs").style.color = "#FF0000";
                    return false;
                } else if (checkNumberGR()) {
                    return false;
                } else if (checkNumber()) {
                    return false;
                }
            }

            function checkNumberGR() {
                var chkZ = 1;
                for (i = 0; i < document.getElementById("grWasser").value.length; ++i)
                    if (document.getElementById("grWasser").value.charAt(i) < "0" || document.getElementById("grWsser").value.charAt(i) > "9")
                        chkZ = -1;
                if (chkZ === -1) {
                    alert("Bitte geben Sie nur ganze Zahlen ein.");
                    document.getElementById("grWasser").focus();
                    document.getElementById("grWasser").style.borderColor = "#ff0000";
                    return true;

                }
            }

            function checkNumberWB() {
                var chkZ = 1;
                for (i = 0; i < document.getElementById("waschbecke").value.length; ++i)
                    if (document.getElementById("waschbecke").value.charAt(i) < "0" || document.getElementById("waschbecke").value.charAt(i) > "9")
                        chkZ = -1;
                if (chkZ === -1) {
                    alert("Bitte geben Sie nur Zahlen ein.");
                    document.getElementById("waschbecke").focus();
                    document.getElementById("waschbecke").style.borderColor = "#ff0000";
                    return true;

                }
            }
        </script>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title>Pelletspeicher</title>
    </head>
    <body>
        <?php
        SESSION_START();
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = htmlspecialchars($value);
        }
        ?>

        <form action="pelletspeicher-hersteller.php" method="post" onsubmit="return submitForm()">

            <h1><img src="images/logo.png" alt="logo"> Pelletspeicher</h1>

            <p>Heizkessel-Leistung:
                <input type="number" name="hk-leistung" id="hk-leistung" value="<?php
                if (isset($_SESSION["hk-leistung"])) {
                    echo $_SESSION["hk-leistung"];
                }
                ?>"/>kW
                <br>
                Geben Sie die Heizkessel-Leistung an um im nächsten Schritt (optional) einen Kesselhersteller auszuwählen.
            </p>
            <p>Bemessungsgrundwasserstand ab Gelände-Oberkante:
                <input type="number" name="wasserstand" id="wasserstand" 
                       value="<?php
                       if (isset($_SESSION["wasserstand"])) {
                           echo $_SESSION["wasserstand"];
                       }
                       ?>"/>m
            </p>
            <p>Abstand zwischen Heizkessel und Außenkante Pelletspeicher:
                <input type="number" name="abstand" value="<?php
                if (isset($_SESSION["abstand"])) {
                    echo $_SESSION["abstand"];
                }
                ?>"/>m
            </p>
            <p>Anzahl der Bögen im Saugschlauch:
                <input type="number" name="boegen" value="<?php
                if (isset($_SESSION["boegen"])) {
                    echo $_SESSION["boegen"];
                }
                ?>"/>Stück
            </p>
            <p>Höhenunterschied zwischen Saugturbine am Heizkessel und Schachtabdeckung Pelletspeicher  
                (liegt die Turbine höher als Schachtabdeckung, bitte negativen Wert eintragen):
                <input type="number" name="hoenenunterschied" value="<?php
                if (isset($_SESSION["hoenenunterschied"])) {
                    echo $_SESSION["hoenenunterschied"];
                }
                ?>"/>m
            </p>

            <p>Lastbild der Schachtabdeckung:</p>
            <input type="hidden" name="lastbild" value="">
            <input type="radio" id="a" name="lastbild" value="a"><label for="a">A (begehbar)</label><br> 
            <input type="radio" id="b" name="lastbild" value="b"><label for="b">B (befahrbar)</label><br> 
            <input type="radio" id="c" name="lastbild" value="c"><label for="c">C (Verkehrswege)</label> 

            <p> <font id="werte">Geben Sie einen der zwei Werte an*:</font></p>
            <p><input type="radio" id="kWh" name="volumen" value="kWh" required="required" onclick="selectLeistung()">
                <label for="kWh"><b>Jahres-Endenergie-Verbrauch in kWh:</b></label>
                <input type="number" name="leistung" id="leistung" value="<?php
                if (isset($_SESSION["leistung"])) {
                    echo $_SESSION["leistung"];
                }
                ?>"/>
            </p>
            <p><input type="radio" id="m3" name="volumen" value="m3" required="required" onclick="selectNutzvolumen()">
                <label for="m3"><b>Nutzvolumen in m³:</b></label>
                <input type="number" name="nutzvolumen" id="nutzvolumen" value="<?php
                if (isset($_SESSION["nutzvolumen"])) {
                    echo $_SESSION["nutzvolumen"];
                }
                ?>"/>
            </p>
            <p>
                <input class="submitButton" type="submit" value="Absenden"/>
            </p>
            <p>*Pflichtangabe für die Berechnung.</p>
        </form>

    </body>
</html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <script>
            function selectMenge() {
                document.getElementById("wc").disabled = true;
                document.getElementById("ae").disabled = true;
                document.getElementById("wc").value = "";
                document.getElementById("ae").value = "";
                document.getElementById("swWasser").disabled = false;

                document.getElementById("berechnung").value = "false";
            }

            function selectWC() {
                document.getElementById("wc").disabled = false;
                document.getElementById("swWasser").disabled = true;
                document.getElementById("ae").disabled = true;
                document.getElementById("swWasser").value = "";
                document.getElementById("ae").value = "";

                document.getElementById("berechnung").value = "wc";
            }

            function selectAE() {
                document.getElementById("ae").disabled = false;
                document.getElementById("swWasser").disabled = true;
                document.getElementById("wc").disabled = true;
                document.getElementById("swWasser").value = "";
                document.getElementById("wc").value = "";

                document.getElementById("berechnung").value = "ae";
            }

            function submitForm() {
                if (document.getElementById("swWasser").value === ""
                        && document.getElementById("ae").value === ""
                        && document.getElementById("wc").value === "") {
                    alert("Sie müssen entweder die Menge oder Stückzahlen zur Berechnung angeben.");
                    return false;
                }
            }
        </script>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Abwasser fäkalienhaltig</title>
    </head>
    <body>

        <form action="../pumpen-control.php" method="post" onsubmit="return submitForm()">
            <input type="hidden" name="page" value="sw1">
            <input type="hidden" name="art" value="swWasser">
            <input type="hidden" name="berechnung" value="false">

            <h1><img src="../images/logo.png" alt="logo"> Abwasser fäkalienhaltig</h1>
            Pflichtangaben
            <p>Geben Sie an: </p>
            <input type="hidden" name="swWsser" value="">
            <p><input type="radio" id="mr" name="volumen" value="mr" checked="checked" required="required" onclick="selectMenge()">
                <label for="m">Menge: </label><input type="number" name="swWasser" id="swWasser" value="<?php
                if (isset($_SESSION["swWasser"])) {
                    echo $_SESSION["swWasser"];
                }
                ?>"/> l/s</p>

            <p>ODER</p>

            Berechnung:
            <p><input type="radio" id="wcr" name="volumen" value="wcr" required="required" onclick="selectWC()">
                WC <input type="number" name="wc" id="wc" disabled="true"/> Stück</p>
            <p>Oder</p>
            <p><input type="radio" id="aer" name="volumen" value="aer" required="required" onclick="selectAE()">
                Anzahl Einwohner <input type="number" name="ae" id="ae" disabled="true"/></p>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
                <form action="../pumpen-start.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

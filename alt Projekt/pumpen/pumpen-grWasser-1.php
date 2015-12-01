<html>
    <head>
        <script>
            function selectMenge() {
                document.getElementById("waschbecken").disabled = true;
                document.getElementById("dusche").disabled = true;
                document.getElementById("bodenlauf").disabled = true;
                document.getElementById("waschbecken").value = "";
                document.getElementById("dusche").value = "";
                document.getElementById("bodenlauf").value = "";
                document.getElementById("grWasser").disabled = false;

                document.getElementById("berechnung").value = "false";
            }

            function selectBerechnung() {
                document.getElementById("waschbecken").disabled = false;
                document.getElementById("dusche").disabled = false;
                document.getElementById("bodenlauf").disabled = false;
                document.getElementById("grWasser").disabled = true;
                document.getElementById("grWasser").value = "";

                document.getElementById("berechnung").value = "true";
            }

//Überprüfung der Eingaben
            function submitForm() {
                if (document.getElementById("grWasser").value === ""
                        && document.getElementById("waschbecken").value === ""
                        && document.getElementById("dusche").value === ""
                        && document.getElementById("bodenlauf").value === "") {
                    alert("Sie müssen entweder die Menge oder Stückzahlen zur Berechnung angeben.");
                    return false;
                }
                var fehler = false;
                if (checkNumberGR()) {
                    fehler = true;
                }
                if (checkNumberWB()) {
                    fehler = true;
                }
                if (checkNumberDU()) {
                    fehler = true;
                }
                if (checkNumberBL()) {
                    fehler = true;
                }
                if (fehler === true) {
                    alert("Bitte geben Sie nur ganze Zahlen ein.");
                    return false;
                }
            }

            function checkNumberGR() {
                var chkZ = 1;
                var x = document.getElementById('grWasser');
                for (i = 0; i < x.value.length; ++i)
                    if (x.value.charAt(i) < "0" || x.value.charAt(i) > "9")
                        chkZ = -1;
                if (chkZ === -1) {
                    x.focus();
                    x.style.borderColor = "#ff0000";
                    return true;

                }
            }

            function checkNumberWB() {
                var chkZ = 1;
                var x = document.getElementById('waschbecken');
                for (i = 0; i < x.value.length; ++i)
                    if (x.value.charAt(i) < "0" || x.value.charAt(i) > "9")
                        chkZ = -1;
                if (chkZ === -1) {
                    x.focus();
                    x.style.borderColor = "#ff0000";
                    return true;

                }
            }
            function checkNumberBL() {
                var chkZ = 1;
                var x = document.getElementById('bodenlauf');
                for (i = 0; i < x.value.length; ++i)
                    if (x.value.charAt(i) < "0" || x.value.charAt(i) > "9")
                        chkZ = -1;
                if (chkZ === -1) {
                    x.focus();
                    x.style.borderColor = "#ff0000";
                    return true;

                }
            }
            function checkNumberDU() {
                var chkZ = 1;
                var x = document.getElementById('dusche');
                for (i = 0; i < x.value.length; ++i)
                    if (x.value.charAt(i) < "0" || x.value.charAt(i) > "9")
                        chkZ = -1;
                if (chkZ === -1) {
                    x.focus();
                    x.style.borderColor = "#ff0000";
                    return true;

                }
            }

        </script>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Abwasser fäkalienfrei</title>
    </head>
    <body>
        <form name="Formular" action="../pumpen-control.php" method="post" onsubmit="return submitForm()">
            <input type="hidden" name="page" value="gr1">
            <input type="hidden" name="art" value="grWasser">

            <h1><img src="../images/logo.png" alt="logo"> Abwasser fäkalienfrei (Grauwasser)</h1>
            Pflichtangaben
            <p>Geben Sie an: </p>

            <p><input type="radio" id="mr" name="volumen" value="mr" checked="checked" required="required" onclick="selectMenge()">
                <label for="m">Menge: </label><input type="number" name="grWasser" id="grWasser" value="<?php
                if (isset($_SESSION["grWasser"])) {
                    echo $_SESSION["grWasser"];
                }
                ?>"/> l/s</p>

            <p>ODER</p>
            <p><input type="radio" id="br" name="volumen" value="br" required="required" onclick="selectBerechnung()">
                <label for="b">Berechnung</label>
            </p>
            <p> Waschbecken <input type="number" name="waschbecken" id="waschbecken" disabled="true" value=""/> Stück</p>
            <p> Dusche <input type="number" name="dusche" id="dusche" disabled="true" value=""/> Stück</p>
            <p> Bodenlauf <input type="number" name="bodenlauf" id="bodenlauf" disabled="true" value=""/> Stück</p>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
                <form action="../pumpen-start.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

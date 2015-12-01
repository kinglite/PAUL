<html>
    <head>
        <script>
            function selectMenge() {
                document.getElementById("flaeche").disabled = true;
                document.getElementById("groese").disabled = true;
                document.getElementById("oplz").disabled = true;
                document.getElementById("nsWasser").disabled = false;
                document.getElementById("groese").value = "";
                document.getElementById("oplz").value = "";
                document.getElementById("nsWasser").setAttribute("required", "");
                document.getElementById("groese").removeAttribute("required");
                document.getElementById("berechnung").value = "false";
            }

            function selectBerechnung() {
                document.getElementById("flaeche").disabled = false;
                document.getElementById("groese").disabled = false;
                document.getElementById("oplz").disabled = false;
                document.getElementById("nsWasser").disabled = true;
                document.getElementById("nsWasser").value = "";
                document.getElementById("groese").setAttribute("required", "");
                document.getElementById("nsWasser").removeAttribute("required");
                document.getElementById("berechnung").value = "true";
            }
        </script>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Niederschlagswasser</title>
    </head>
    <body>
        <form action="../pumpen-control.php" method="post" >
            <input type="hidden" name="page" value="ns1">
            <input type="hidden" name="art" value="nsWasser">
            <input type="hidden" name="berechnung" value="false">

            <h1><img src="../images/logo.png" alt="logo"> Niederschlagswasser</h1>
            Pflichtangaben
            <p><input type="radio" id="mr" name="volumen" value="mr" checked="checked" required="required" onclick="selectMenge()">
                <label for="m">Menge: </label><input type="number" name="nsWasser" id="nsWasser" value="<?php
                if (isset($_SESSION["nsWasser"])) {
                    echo $_SESSION["nsWasser"];
                }
                ?>" required="required" /> l/s</p>

            <p>ODER</p>
            <p><input type="radio" id="br" name="volumen" value="br" required="required" onclick="selectBerechnung()">
                <label for="b">Berechnung</label></p>

            <?php
            //DB-Verbindung
            require_once ('../konfiguration.php');
            $db_link = mysqli_connect(
                    MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
            );
            echo "<p>Wählen Sie optional die Art der Fläche: ";
            echo "<select name=\"flaeche\" id=\"flaeche\" disabled=\"true\">";
            echo "<option value=\"\" id=\"null\"></option>";
            $sql = "SELECT * FROM flaeche";
            $db_erg = mysqli_query($db_link, $sql);
            while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
                echo "<option value=\"" . $zeile['wert'] . "\">" . utf8_encode($zeile['bezeichnung']) . "</option>";
            }
            echo "</select></p>";
            ?>
            <p><label for="groese">Größe der Fläche: </label><input type="number" name="groese" id="groese" disabled="true"/> m&sup2</p>
            <p> <label for="groese">Optional Ort (PLZ): </label><input type="number" name="oplz" id="oplz" disabled="true"/></p>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
        <form action="../pumpen-start.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

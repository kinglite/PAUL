<!DOCTYPE html>

<html>
    <head>
        <script>
            function selectMenge() {
                document.getElementById("NGr").disabled = true;
                document.getElementById("asWasser").disabled = false;
            }

            function selectBR() {
                document.getElementById("NGr").disabled = false;
                document.getElementById("asWasser").disabled = true;
                document.getElementById("asWasser").value = "";
            }
            //Überprüfung der Eingaben
            function submitForm() {
                if (document.getElementById("asWasser").value === "" && document.getElementById("NGr").value === "0") {
                    alert("Bitte geben Sie einen Wert ein.");
                    return false;
                }
            }
        </script>
        <link rel="stylesheet" type="text/css" href="../stylesheet.css">
        <meta charset="UTF-8">
        <title>Abwasser aus Abscheideranlage</title>
    </head>
    <body>
        <?php
        SESSION_START();
        ?>
        <form name="Formular" action="../pumpen-control.php" method="post" onsubmit="return submitForm()">
            <input type="hidden" name="page" value="as1">
            <input type="hidden" name="page" value="as1">
            <input type="hidden" name="art" value="asWasser">
            <h1><img src="../images/logo.png" alt="logo"> Abwasser aus Abscheideranlage</h1>
            Pflichtangaben
            <p>Geben Sie an: </p>
            <input type="hidden" name="asWasser" value="">
            <p><input type="radio" id="mr" name="volumen" value="mr" 
                <?php
                if ($_SESSION["fehler"]) {
                    echo "";
                } else {
                    echo "checked=\" checked\"";
                }
                ?> required="required" onclick="selectMenge()">
                <label for="m">genaue Menge: </label><input type="number" name="asWasser" 
                <?php
                if ($_SESSION["fehler"]) {
                    echo "disabled=\"true\"";
                }
                ?> id="asWasser" value="<?php
                if (isset($_SESSION["asWasser"])) {
                    echo $_SESSION["asWasser"];
                }
                ?>"/>l/s</p>

            <p>ODER</p>
            <?php
            if ($_SESSION["fehler"]) {
                echo "<p><font color=\"#FF0000\">Wählen Sie bitte einen Wert aus:</font></p>";
            }
            ?>
            <p><input type="radio" id="br" name="volumen" value="br" 
                <?php
                if ($_SESSION["fehler"]) {
                    echo "checked=\" checked\"";
                }
                ?> required="required" onclick="selectBR()"> 


                Nenngröße:
                <select name="NGr" id="NGr"
                <?php
                if ($_SESSION["fehler"]) {
                    echo "";
                } else {
                    echo "disabled=\" true\"";
                }
                ?>>
                    <option value = "0" selected="selected"></option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>6</option>
                    <option>7</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>25</option>
                    <option>30</option>
                </select>l/s
            </p>
            <p>
                <input class="submitButton" type="submit" value="Weiter" />
            </p>
        </form>
        <form action="../pumpen-start.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>

    </body>
</html>

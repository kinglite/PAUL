<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title>Kontakt</title>
    </head>
    <?php
    //Post-Werte in Session speichern. 
    SESSION_START();
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = htmlspecialchars($value);
    }

    if ($_SESSION["art"] == "pel") {
        $link = "pelletspeicher";
    } else {
        $link = "pumpen";
    }
    ?>
    <body>
        <form action="kontakt-result.php" method="post" >
            <h1><img src="images/logo.png" alt="logo"> Ansprechpartner</h1>
            <p>Firma / Behörde:
                <input type="text" name="firma" maxlength="30" value="<?php
                if (isset($_SESSION["firma"])) {
                    echo $_SESSION["firma"];
                }
                ?>"/>
            </p>
            <p>Name:
                <input type="text" name="name" maxlength="25" required="required" value="<?php
                if (isset($_SESSION["name"])) {
                    echo $_SESSION["name"];
                }
                ?>"/>*
            </p>
            <p>Telefon:
                <input type="tel" name="tel" maxlength="20" value="<?php
                if (isset($_SESSION["tel"])) {
                    echo $_SESSION["tel"];
                }
                ?>" />
            </p>
            <p>Mobil:
                <input type="tel" name="mobil" maxlength="20"  value="<?php
                if (isset($_SESSION["mobil"])) {
                    echo $_SESSION["mobil"];
                }
                ?>" />
            </p>
            <p>E-Mail:
                <input type="email" name="email" maxlength="40" required="required" value="<?php
                if (isset($_SESSION["email"])) {
                    echo $_SESSION["email"];
                }
                ?>"/>*
            </p>
            <p>PLZ:
                <input type="text" name="plz" maxlength="5" value="<?php
                if (isset($_SESSION["plz"])) {
                    echo $_SESSION["plz"];
                }
                ?>"/>
            </p>
            <p class="box"><label for="strasse">Straße:</label>
                <input type="text" name="str" maxlength="30" value="<?php
                if (isset($_SESSION["str"])) {
                    echo $_SESSION["str"];
                }
                ?>"/>
            </p>
            <p>Ort:
                <input type="text" name="ort" maxlength="20" value="<?php
                if (isset($_SESSION["ort"])) {
                    echo $_SESSION["ort"];
                }
                ?>"/>
            </p>
            <p>Projektname:
                <input type="text" name="projektname" maxlength="20" required="required" value="<?php
                if (isset($_SESSION["projektname"])) {
                    echo $_SESSION["projektname"];
                }
                ?>"/>*
            </p>
            <p>
                * Pflichtangaben
            </p>
            <p>
                <input class="submitButton" type="submit" value="Absenden"/>
            </p>
            <p>
                Hinweis: Ihre Daten werden nicht dauerhaft gespeichert.
            </p>
        </form>
        <form action="<?php
        echo $link
        ?>-result.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück"/>
        </form>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title>Kesselhersteller</title>
    </head>
    <body>
        <form action="pelletspeicher-result.php" method="post">
            <?php
            SESSION_START();
            foreach ($_POST as $key => $value) {
                $_SESSION[$key] = htmlspecialchars($value);
            }
            $_SESSION["art"] = "pel";

            if ($_SESSION["hk-leistung"] == "") {
                $_SESSION["kesselhersteller"] = "";
                Header("Location: pelletspeicher-result.php");
                exit();
            } else {
                //DB-Verbindung
                require_once ('konfiguration.php');
                $db_link = mysqli_connect(
                        MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
                );
                
                $_SESSION["kesselhersteller"] = true;
                echo "<h1><img src=\"images/logo.png\" alt=\"logo\"> Kesselhersteller</h1>";
                echo "Wenn Sie möchten können Sie einen Kesselhersteller aussuchen: ";
                echo "<select name=\"kesselhersteller\">";
                echo "<option></option>";
                $sql = "SELECT * FROM kesselhersteller";
                $db_erg = mysqli_query($db_link, $sql);
                while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
                    if ($zeile['min'] <= $_SESSION["hk-leistung"] AND $zeile['max'] >= $_SESSION["hk-leistung"]) {
                        echo "<option>" . utf8_encode($zeile['hersteller']) . "</option>";
                    }
                }
                echo "</select> ";
            }
            ?>
            <p>
                <input class="submitButton" type="submit" value="Zur Auswertung"/>
            </p>
        </form>
        <form action="pelletspeicher.php" method="post" >  
            <input class="backButton" type="submit" value="Zurück" />
        </form>
    </body>
</html>

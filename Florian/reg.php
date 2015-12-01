<?php
// define variables and set to empty values
$usernameErr = $nameErr = $eMailErr = $passwordErr = "";
$ErrCounter = 1;

//TODO E-Mail ändern
$Absender = "name@ihre-domain.de";

if (isset($_REQUEST['Send'])) {
$ErrCounter = 0;
    require_once ('functions.php');

    $username = filterfunktion($_REQUEST["lName"]);
    $name = filterfunktion($_REQUEST["name"]);
    $password = filterfunktion($_REQUEST["password"]);
    $password2 = filterfunktion($_REQUEST["password2"]);
    $eMail = filterfunktion($_REQUEST["eMail"]);

    if ($password == $password2) {
        $password = password_hash($password, PASSWORD_BCRYPT);
    } else {

        $passwordErr = "Passwörter stimmen nicht überein<br>";
        $ErrCounter++;
    }if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
        $eMailErr = "Üngültige E-Mail<br>";
        $ErrCounter++;
    }


    require_once ('konfiguration.php');
    $db_link = mysqli_connect(
            MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
    );

    $sql = "SELECT username,name FROM accounts";
    $db_erg = mysqli_query($db_link, $sql);
    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {

        if ($zeile['username'] == $username) {
            $usernameErr = "Login Name bereits vergeben<br>";
            $ErrCounter++;
        }
        if ($zeile['name'] == $name) {
            $nameErr = "Name bereits vergeben<br>";
            $ErrCounter++;
        }
    }

    if ($ErrCounter == 0) {
        $Aktivierungscode = zufallsstring(12);

        mysql_query($db_link, "INSERT INTO accounts (username, passwort, email, name, activation, active) VALUES ('$username', '$name', '$password', '$eMail', '$Aktivierungscode', 'FALSE')");

        $ID = mysql_insert_id();

        //TODO aktivieren
        //mail($_REQUEST['EMail'], "Registrierung abschließen", "Hallo,\n\num die Registrierung abzuschließen, klicken Sie bitte auf den folgenden Link:\n\nhttp://www.ihre-domain.de/reg-aktivieren.php?ID=$ID&Aktivierungscode=$Aktivierungscode", "FROM: $Absender");
        echo"Um die Registrierung abzuschließen, rufen Sie Ihr E-Mail-Postfach ab und klicken Sie auf den Aktivierungslink in der soeben an Sie versandten E-Mail.";
    }
} 
if ($ErrCounter > 0){
    ?>

    <form action="" method="post">
        <?php echo $usernameErr; ?>
        Login Name: <input maxlength="50" name="lName" type="text" required="required"><br>
        <?php echo $nameErr; ?>
        Angezeigter Name: <input maxlength="255" name="name" type="text" required="required"><br>
        <?php echo $passwordErr; ?>
        Passwort: <input maxlength="255" name="password" type="text" required="required"><br>
        Passwort Wiederholung: <input maxlength="255" name="password2" type="text" required="required"><br>
        <?php echo $eMailErr; ?>
        E-Mail: <input maxlength="50" name="eMail" type="text" required="required"><br>
        <input name="Send" type="submit" value="Absenden">
    </form>

    <?php
}
?>
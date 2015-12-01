<?php

// Hier bitte die l/s je Einwohner eintragen!
$anzahlEinwohnerWasser = 4;


//Post-Werte in Session speichern. 
SESSION_START();
foreach ($_POST as $key => $value) {
    $_SESSION[$key] = htmlspecialchars($value);
}

switch ($_SESSION["page"]) {
    case "as1":
        header('Location: pumpen/pumpen-druckrohrleitung.php');
        getAS();
        if ($_SESSION["fehler"]) {
            header('Location: pumpen/pumpen-asWasser-1.php');
        } else {
            header('Location: pumpen/pumpen-druckrohrleitung.php');
        }
        break;
    case "sw1":
        getSW();
        header('Location: pumpen/pumpen-druckrohrleitung.php');
        break;
    case "ns1":
        getNS();
        header('Location: pumpen/pumpen-druckrohrleitung.php');
        break;
    case "gr1":
        getGR();
        header('Location: pumpen/pumpen-druckrohrleitung.php');
        break;
    case "dl":
        getRD();
        getVH();
        header('Location: pumpen/pumpen-schacht.php');
        break;
    case "scha":
        header('Location: pumpen/pumpen-grundwasser.php');
        break;
    case "grw":
        header('Location: pumpen/pumpen-einbau.php');
        break;
    case "einb":
        header('Location: pumpen/pumpen-schaltanlage.php');
        break;
    case "schalt":
        header('Location: pumpen/pumpen-leitung.php');
        break;
    case "leitung":
        header('Location: pumpen-result.php');
        break;
}

function getAS() {

    if ($_SESSION["volumen"] === "mr") {
        $_SESSION["foerdermenge"] = $_SESSION["asWasser"];
        $_SESSION["fehler"] = FALSE;
        $_SESSION["NGr"] = "";
    } else {
        if ($_SESSION["NGr"] != "0") {
            $_SESSION["foerdermenge"] = $_SESSION["NGr"];
            $_SESSION["fehler"] = FALSE;
        } else {
            $_SESSION["fehler"] = true;
        }
    }
}

function getSW() {

    switch ($_SESSION["volumen"]) {
        case "mr":
            $_SESSION["foerdermenge"] = $_SESSION["swWasser"];
            break;
        case "br":
            $_SESSION["foerdermenge"] = $_SESSION["wc"] * 2;
            break;
        case "aer":
            /* @var $anzahlEinwohnerWasser type */
            $_SESSION["foerdermenge"] = $_SESSION["ae"] * $anzahlEinwohnerWasser;
            break;
    }
}

function getGR() {

    switch ($_SESSION["volumen"]) {
        case "mr":
            $_SESSION["foerdermenge"] = $_SESSION["grWasser"];
            break;
        case "br":
            $_SESSION["foerdermenge"] = $_SESSION["waschbecken"] * 0.5;
            $_SESSION["foerdermenge"] = $_SESSION["foerdermenge"] + $_SESSION["dusche"] * 0.8;
            $_SESSION["foerdermenge"] = $_SESSION["foerdermenge"] + $_SESSION["bodenlauf"] * 1.5;
            break;
    }
}

function getNS() {

    switch ($_SESSION["volumen"]) {
        case "mr":
            $_SESSION["foerdermenge"] = $_SESSION["nsWasser"];
            break;
        case "br":
            $_SESSION["foerdermenge"] = $_SESSION["groese"] * 0.03;
            break;
    }
}

function getRD() {
    $_SESSION["Rohrdurchmesser"] = 0;

    //DB-Verbindung
    require_once ('konfiguration.php');
    $db_link = mysqli_connect(
            MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK
    );

    $sql = "SELECT * FROM `rohrdurchmesser`";
    $db_erg = mysqli_query($db_link, $sql);
    while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {

        if ($_SESSION["foerdermenge"] <= $zeile['max']) {
            $_SESSION["Rohrdurchmesser"] = $zeile['durchmesser'];
            break;
        }
    }
}

function getVH() {
    $A = (3.14 / 4) * pow($_SESSION["Rohrdurchmesser"] / 1000, 2);
    $V = ($_SESSION["foerdermenge"] / 1000) / $A;
    $Lam = pow((1 / (-2 * log((0.01 / $_SESSION["Rohrdurchmesser"]) / 3.71, 10))), 2);

    $_SESSION["Hverlust"] = ($Lam * $_SESSION["laenge"] / ($_SESSION["Rohrdurchmesser"] / 1000)) * (pow($V, 2) / (2 * 9.81));

    $_SESSION["Hman"] = $_SESSION["Hverlust"] + $_SESSION["hoenenunterschied"];
}

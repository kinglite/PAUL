<!DOCTYPE html>

<?php
SESSION_START();
    $_SESSION["foerdermenge"] = 0;
    $_SESSION["fehler"] = false;
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <meta charset="UTF-8">
        <title>Pumpen</title>
    </head>
    <body>
        <h1><img src="images/logo.png" alt="logo"> Bitte wählen Sie das gewünschte Fördermedium aus:</h1>
        <button onclick="location.href='http://localhost/Mall/pumpen/pumpen-asWasser-1.php'">Abwasser aus Abscheideranlage</button>
        <button onclick="location.href='http://localhost/Mall/pumpen/pumpen-grWasser-1.php'">Abwasser fäkalienfrei</button>
        <button onclick="location.href='http://localhost/Mall/pumpen/pumpen-swWasser-1.php'">Abwasser fäkalienhaltig</button>
        <button onclick="location.href='http://localhost/Mall/pumpen/pumpen-nsWasser-1.php'">Niederschlagswasser</button>
    </body>
</html>

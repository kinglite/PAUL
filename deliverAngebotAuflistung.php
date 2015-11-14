<!Doctype HTML>
<html>
    
    <body>
        <table style="width: 100%">
            <tr>
                          <th>Angebots-ID</th>
                          <th>Name</th>
                          <th>Startland</th>
                          <th>Startdorf</th>
                          <th>Zielland</th>
                          <th>Zieldorf</th>
                          <th>Datum</th>
                          <th>Kontakt</th>
            </tr>
            <?php
                  $db = new PDO('mysql:host=localhost;
                                                  dbname=PAUL;
                                                  charset=utf8', 'guest', '', 
                                                  array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


                  $statement = 'SELECT do.id, do.name, c1.countryName as startCountry, do.startVillage, c2.countryName as destCountry, do.destinationVillage, '
                          . 'do.startDate FROM deliverer_offer do '
                          . 'join countries c1 on do.startCountry = c1.id '
                          . 'join countries c2 on do.destinationCountry = c2.ID';
                  foreach($db->query($statement) as $row)
                  /*while($row = mysql_fetch_array($result))*/
                  {   //Creates a loop to loop through results
                          echo "<tr>\n";
                          echo "<td>" . htmlspecialchars($row['id']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['name']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['startCountry']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['startVillage']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['destCountry']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['destinationVillage']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['startDate']) . "</td>\n";
                          echo "<td>" . "<a href=\"mailto.html/mail?\">kontaktieren </a></td>\n";
                          echo "</tr>";  //$row['index'] the index here is a field name
                  }
            ?>
        </table>
    </body>

</html>
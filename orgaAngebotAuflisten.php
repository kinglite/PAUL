<!Doctype HTML>
<html>
    
    <body>
        <table style="width: 100%">
            <tr>
                          <th>Angebots-ID</th>
                          <th>Organisation</th>
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

                  $statement = 'SELECT oo.id, oo.organisation, c1.countryName as startCountry, oo.startVillage, c2.countryName as destCountry, oo.destinationVillage, '
                          . 'oo.startDate FROM organisation_offer oo '
                          . 'join countries c1 on oo.startCountry = c1.id '
                          . 'join countries c2 on oo.destinationCountry = c2.ID';
                  foreach($db->query($statement) as $row)
                  /*while($row = mysql_fetch_array($result))*/
                  {   //Creates a loop to loop through results
                          echo "<tr>\n";
                          echo "<td>" . htmlspecialchars($row['id']) . "</td>\n";
                          echo "<td>" . htmlspecialchars($row['organisation']) . "</td>\n";
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
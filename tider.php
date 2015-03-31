<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
?>
<!--<!DOCTYPE html>-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tider</title>
    </head>
    <body>
        <form method = 'POST' action='doTider.php'>
            Lägg till en tid
            <p>Starttid ÅÅÅÅ-MM-DD TT:MM:SS</p> <input type = 'text' name = 'start' required>
            <p>Sluttid ÅÅÅÅ-MM-DD TT:MM:SS</p> <input type = 'text' name = 'slut' required>
            <input type = 'submit' value = 'Lägg till' name='addt'>
        </form>

        <form method = 'POST'></form>
        <br>


        <!--        <!--visa alla tider-->
        <?php
//        if ($_POST["value"] == 1) { MÅSTE HA DEN HÄR RADEN

            $sql = "SELECT * FROM tider";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $tider = $stmt->fetchAll();

            foreach ($tider as $tid) {
                echo "<br>" . $tid["id"];
                echo "<br>" . $tid["starttid"];
                echo "<br>" . $tid ["sluttid"];
                echo "<br><form method='POST'><input type = 'submit' value = 'Redigera' name='redigera'><input type='hidden' value='" . $tid["id"] . "' name='id'></form>";

                if (isset($_POST["redigera"]) and $_POST["id"] == $tid["id"]) {
                    echo "<form method='POST' action='doTider.php'><input type='text' value='" . $tid["starttid"] . "' name='startred'> <br>";
                    echo "<input type='text' value='" . $tid["sluttid"] . "' name='slutred'> <br>";
                    echo "<input type='hidden' value='" . $tid["id"] . "' name='id' ><br>";
                    echo "<input type='submit' value='Ändra' name='andra'></form>";
                }
                echo "<form method='POST' action='doTider.php'><input type='hidden' value='" . $tid["id"] . "' name='id'><input type = 'submit' value = 'Delete' name='delete'></form>";
                echo "<br>";
            }
//        }
        ?>
        <a href="admin.php">Tillbaka</a>

    </body>
</html>

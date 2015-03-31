<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

//if ($_POST["value"] == 1) {

//    if (isset($_GET["add"])) {
//        $behandling = filter_input(INPUT_GET, 'behandling', FILTER_SANITIZE_SPECIAL_CHARS);
//        $langd = filter_input(INPUT_GET, 'langd', FILTER_SANITIZE_SPECIAL_CHARS);
//        $sql = "INSERT INTO `behandlingar`(`namn`, `längd`) VALUES ('$behandling','$langd')";
//
//        $stmt = $dbh->prepare($sql);
//        $stmt->bindParam(":behandling", $behandling);
//        $stmt->bindParam(":langd", $langd);
//        $stmt->execute();
//        $login = $stmt->fetch();
//    }
//}
?>

<!--<!DOCTYPE html>-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lägg till behandlingar</title>
    </head>
    <body>
        <form method = 'POST' action='doBehandlingar.php'>
            Lägg till en behandling
            <p>Namn</p> <input type = 'text' name = 'behandling' value="" required>
            <p>Längd (min)</p> <input type = 'text' name = 'langd' value="" required>
            <input type = 'submit' value = 'Lägg till' name="addb">
        </form>
        <?php
//        Visa ut alla behandlingar
        $sql = "SELECT * FROM behandlingar";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $behandlingar = $stmt->fetchAll();

        foreach ($behandlingar as $behandling) {
            echo "<br>" . $behandling["id"];
            echo "<br>" . $behandling["namn"];
            echo "<br>" . $behandling ["längd"] . "min <br>";
        }
        ?>
        <a href='admin.php'>Tillbaka</a>
    </body>
</html>

<!DOCTYPE html>
<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
session_start();
//$_SESSION["inlog"];
if (isset($_POST['logout'])) {
    $_SESSION["inlog"] = 0;
}


if (isset($_POST["anvnam"])) {
    $anvnam = filter_input(INPUT_POST, 'anvnam', FILTER_SANITIZE_SPECIAL_CHARS);
    $losord = filter_input(INPUT_POST, 'losord', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT * FROM `inlog` WHERE anvnam='$anvnam' AND losord='$losord'";
//    echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":anvnam", $anvnam);
    $stmt->bindParam(":losord", $losord);
    $stmt->execute();
    $login = $stmt->fetchAll();
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Välkommen, logga in.</title>
    </head>
    <body>

        <?php
        if (!empty($login)) {
            $_SESSION["inlog"] = 1;
            $_SESSION["namn"] = $anvnam;
            echo '<p>Välkommen, du är nu inloggad!</p>';
        } else {
//    echo 'Vänligen logga in med ett registrerat användarnamn';
        }

        if ($_SESSION["inlog"] == 1) {
            echo "<p>Du är nu inloggad som " . $_SESSION["namn"] . "!</p>";
            echo "<form method='POST'><input type = 'submit' value = 'Logga ut' name='logout'></form>";
//            
            echo "<form method='POST' action='bytLos.php'><input type='submit' value='Byt Lösenord' name='bytLos'>
        <input type='hidden' value='" . $_SESSION["namn"] . "' name='anvnam'></form>";
            echo "<form method='POST' action='tider.php'><input type='submit' value='Redigera Tider' name='redigeraTider'>
        <input='hidden' value='1' name='1'></form>";

            echo "<form method='POST' action='behandlingar.php'><input type='submit' value='Lägg till behandling' name='laggTillBehandling'>
        <input='hidden' value='1' name='1'></form>";
        } else {
            echo "<form method = 'POST'>
        <p>Användarnamn:</p> <input type = 'text' name = 'anvnam' required>
        <p>Lösenord:</p><input type = 'password' name = 'losord' required>
        <input type = 'submit' value = 'Logga in'>
        </form>";
            
            echo '<a href="index.html">Tillbaka till SinnesKällan</a>';
        }
//if ($_SESSION["inlog"] == 0) {
//    
//}
// else {
//}
        ?>
        
    </body>
</html>
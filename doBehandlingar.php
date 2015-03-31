<?php
//if ($_SESSION["inlog"] == 1) {
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
//if (isset($_GET["add"])) {
//var_dump($_POST);
    $behandling = filter_input(INPUT_POST, 'behandling', FILTER_SANITIZE_SPECIAL_CHARS);
    $langd = filter_input(INPUT_POST, 'langd', FILTER_SANITIZE_SPECIAL_CHARS);
//    echo $behandling;
//    echo $langd.'<br>';
    $sql = "INSERT INTO `behandlingar`(`namn`, `längd`) VALUES ('$behandling','$langd')";
//    echo $sql;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":behandling", $behandling);
    $stmt->bindParam(":langd", $langd);
    $stmt->execute();
    $login = $stmt->fetch();
//}
    header ('Location: behandlingar.php');



<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

//if ($_SESSION["inlog"] == 1) {
//if (isset($_POST["sparalos"])) {
$nylos = filter_input(INPUT_POST, 'nylos', FILTER_SANITIZE_SPECIAL_CHARS);
$anvnam = filter_input(INPUT_POST, 'anv', FILTER_SANITIZE_SPECIAL_CHARS);
//echo $anvnam;
//echo $nylos;
//var_dump($_POST);
$sql = "UPDATE `inlog` SET `losord`='$nylos' WHERE `anvnam`='$anvnam'";

$stmt = $dbh->prepare($sql);
//$stmt->bindParam(":nylos", $nylos);
//$stmt->bindParam(":anvnam", $anvnam);
$stmt->execute();
$login = $stmt->fetchAll();
//}
header('Location: admin.php');
//}
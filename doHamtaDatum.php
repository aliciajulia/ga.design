<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);


$sql = "SELECT * FROM tider WHERE bokad=0";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tider = $stmt->fetchAll();
var_dump($tider);
$datumArray = array();
$idArray = array();

foreach ($tider as $tid) {
    $datumArray[] = substr($tid["starttid"], 0, 10);
    $idArray[] = $tid["id"];
}

header ('Location: admin.php');
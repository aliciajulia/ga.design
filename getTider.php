<?php

// Connect to a MySQL database using PHP PDO
$dsn = 'mysql:host=localhost;dbname=ga;';
$login = 'root';
$password = '';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
$dbh = new PDO($dsn, $login, $password, $options);
var_dump($_GET["starttid"]);
$starttid = $_GET["starttid"] . " 00:00:00";
$sluttid = $_GET["starttid"] . " 23:59:59";
//$firstDay = date("Y-m-01", $time);
//$lastDay = date("Y-m-t", $time);
//$nrOfDaysInMonth = date("t", $time);
//$year = date("Y", $time);
//$month = date("m", $time);
//$firstWeekdayfMonth = date("N", strtotime($year . "-" . $month . "-01"));



$sql = "SELECT * FROM tider WHERE starttid BETWEEN '$starttid' AND '$sluttid' ORDER BY starttid ASC";
echo $sql;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$bokningar = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($bokningar);

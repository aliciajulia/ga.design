<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

//if ($_SESSION["inlog"] == 1) {

if (isset($_POST["addt"])) {
    $start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_SPECIAL_CHARS);
    $slut = filter_input(INPUT_POST, 'slut', FILTER_SANITIZE_SPECIAL_CHARS);
    $startHour = (int) substr($start, 11, 12);
    $slutHour = (int) substr($slut, 11, 12);
    $datum = substr($start, 0, 11);


    for ($i = $startHour; $i < $slutHour; $i++) {
        $slutH = $i + 1;
        $starttid = $datum . $i . ":00:00";
        $sluttid = $datum . $slutH . ":00:00";


        $sql = "INSERT INTO `tider`(`id`, `starttid`, `sluttid`) VALUES ('','$starttid','$sluttid')";
//            echo $sql;
        $stmt = $dbh->prepare($sql);
//        $stmt->bindParam(":start", $dateStart);
//        $stmt->bindParam(":slut", $dateSlut);
        $stmt->execute();
        $login = $stmt->fetch();
    }
}


if (isset($_POST["delete"])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "DELETE FROM `tider` WHERE id=$id";
//    var_dump($_POST);
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $login = $stmt->fetch();
}
//redigera tider
if (isset($_POST["andra"])) {
    $startred = filter_input(INPUT_POST, 'startred', FILTER_SANITIZE_SPECIAL_CHARS);
    $slutred = filter_input(INPUT_POST, 'slutred', FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "UPDATE `tider` SET `starttid`='$startred',`sluttid`='$slutred' WHERE id='$id'";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":startred", $startred);
    $stmt->bindParam(":slutred", $slutred);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $login = $stmt->fetch();
}
//}
header('Location: tider.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


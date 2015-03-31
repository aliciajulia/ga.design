<!DOCTYPE html>
<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "ga");
$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);


function datum($datum) {
    foreach ($datum as $tid) {
        echo substr($tid["starttid"], 0, 10) . "<br>";
        echo "<form method=POST><input type='submit' value='Välj' name='valjDatum'><input type='hidden' value='" . $tid['id'] . "' name='datumId'></form>";
    }
}

function tider($datumId) {
    $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
    $sql = "SELECT * FROM tider WHERE id=$datumId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $tider = $stmt->fetchAll();

    foreach ($tider as $tid) {
        echo substr($tid["starttid"], 11, 8) . "<br>";
        echo "<form method=POST><input type='submit' value='Boka tid' name='bokaTid'><input type='hidden' value='" . $tid['id'] . "' name='bokaTidId'></form>";
    }
}

function boka($bokaId, $kundNamn, $kundMail, $kundTelefon) {

    $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $today = date("Y-m-d");
    $sql = "UPDATE tider SET bokad='1',kund=:kundNamn,kundMail=:kundMail,kundTelefon=:kundTelefon,bokadDen=:today WHERE id=:id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":kundNamn", $kundNamn);
    $stmt->bindParam(":kundMail", $kundMail);
    $stmt->bindParam(":kundTelefon", $kundTelefon);
    $stmt->bindParam(":today", $today);
    $stmt->bindParam(":id", $bokaId);
    $stmt->execute();
//    echo $sql;

//    echo $sql;
    echo "kund " . $kundNamn;
//    exit();
    $sql = "SELECT * FROM tider WHERE id=$bokaId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $bokad = $stmt->fetch();

    echo "Du har nu bokat en tid den " . substr($bokad['starttid'], 0, 10) . " från klockan " . substr($bokad['starttid'], 11, 8) . " till klockan "
    . substr($bokad['sluttid'], 11, 8) . ". Ett bekräftelsemail har skickats till " . $bokad['kundMail'] . ". Tack för din bokning!";

//    var_dump($bokad);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Boka tider</title>
    </head>
    <body>
        <div id="kundInfo">
        Ange namn
        <br>
        <form method="POST"><input type="text" name="kundNamn"><br>
            Ange mailadress
            <input type="email" name="kundMail"><br>
            Ange telefonnummer
            <input type="number" name="kundTelefon"><br>
            <input type="submit" name="kundInfo" value="Skicka"></form><br>
            </div>
        <?php
        if (isset($_POST['kundInfo'])) {

//            $sql = "INSERT INTO `tider`(`kund`, `kundMail`, `kundTelefon`) VALUES ($kundNamn,$kundMail,$kundTelefon)";

            $sql = "SELECT * FROM tider WHERE bokad=0";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $datum = $stmt->fetchAll();
            datum($datum);
        }
        if (isset($_POST['valjDatum'])) {
            tider($_POST['datumId']);
        }
        if (isset($_POST['bokaTid'])) {
            $kundNamn = filter_input(INPUT_POST, 'kundNamn', FILTER_SANITIZE_SPECIAL_CHARS);
            $kundMail = filter_input(INPUT_POST, 'kundMail', FILTER_SANITIZE_SPECIAL_CHARS);
            $kundTelefon = filter_input(INPUT_POST, 'kundTelefon', FILTER_SANITIZE_SPECIAL_CHARS);
            boka($_POST['bokaTidId'], $kundNamn, $kundMail, $kundTelefon);
        }
        ?>
    </body>
</html>
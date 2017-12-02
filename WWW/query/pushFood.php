<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 01-12-2017
require 'connect.php';

if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss" && $_SESSION['auth'] != 'osetrovatel' ) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

if(@$_POST['addFood']){

    if(@$_POST['novyDruh'] == "on") {
        $newDruh = mysqli_real_escape_string($db,$_POST['new']);
    }
    else {
        $newDruh = mysqli_real_escape_string($db,$_POST['old']);
    }

    $mnozstvi = mysqli_real_escape_string($db,$_POST['mnozstvi']);
    $trvanlivost = mysqli_real_escape_string($db,$_POST['trvanlivost']);
    $porizeno = date('Y-m-d');
    $kategorie = mysqli_real_escape_string($db,$_POST['strava']);

    // Michal -> validace
    /*
    echo '<script type="text/javascript">',
         'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
         '</script>';

    return;
    */


    $query =
    "INSERT INTO `Krmivo`VALUES('', '$newDruh', '$trvanlivost', '$kategorie', '', '$porizeno', '$mnozstvi')";

    $result = mysqli_query($db, $query);

    if(!$result) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba při vkládání krmiva, zkuste to prosím později", "alert-danger");',
             '</script>';
              return;
    }
    else {
        echo '<script type="text/javascript">',
             'infoPanel("Krmivo úspěšně přidáno", "alert-success");',
             '</script>';
              return;
    }
}
else if(@$_POST['change']) {

    $noveMnoz = mysqli_real_escape_string($db,$_POST['number']);
    $memMnoz = mysqli_real_escape_string($db,$_POST['mem']);
    $idKrmiva = mysqli_real_escape_string($db,$_POST['change']);

    $query = "SELECT mnozstvi FROM `Krmivo` WHERE idKrmiva = '$idKrmiva'";

    $result = mysqli_query($db, $query);

    $row = mysqli_fetch_array($result,MYSQL_ASSOC);

    //---------

    $porizeno = date('Y-m-d');

    if($memMnoz != $row['mnozstvi']) {
        exit;
    }
    if($noveMnoz < 0) {
        $noveMnoz = 0;
    }

    $query = "UPDATE `Krmivo` SET mnozstvi='$noveMnoz', porizeno='$porizeno' WHERE idKrmiva = '$idKrmiva'";

    $result = mysqli_query($db, $query);

    if(!$result) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba při úpravě množství krmiva, zkuste to prosím později", "alert-danger");',
             '</script>';
              return;
    }
    else {
        echo '<script type="text/javascript">',
             'infoPanel("Krmivo úspěšně upraveno", "alert-success");',
             '</script>';
              return;
    }
}
else if(@$_POST['removeFood']) {
    $idKrmiva = mysqli_real_escape_string($db,$_POST['removeFood']);

    $query = "UPDATE Krmivo SET mnozstvi='0'WHERE idKrmiva = '$idKrmiva'";

    $result = mysqli_query($db, $query);
}
?>

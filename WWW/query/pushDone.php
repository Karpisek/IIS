<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 02-12-2017
require 'connect.php';

if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss" && $_SESSION['auth'] != 'osetrovatel' ) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

if(@$_POST['dest'] == 'Etodo' || @$_POST['dest'] == 'Etoday'){

    $idZamestnance = $_SESSION['id'];
    $idExpo = mysqli_real_escape_string($db,$_POST['idExpo']);
    $time = date('Y-m-d');

    // Michal -> validace
    /*
    echo '<script type="text/javascript">',
         'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
         '</script>';

    return;
    */


    $query =
    "INSERT INTO `Uklizeni`VALUES('', '$idZamestnance', '$time', '$idExpo')";

    $result = mysqli_query($db, $query);

    if(!$result) {
              return;
    }
    else {
        return;
    }
}
else if(@$_POST['dest'] == 'Atodo' || @$_POST['dest'] == 'Atoday') {

    $idZamestnance = $_SESSION['id'];
    $idZvire = mysqli_real_escape_string($db,$_POST['idExpo']);
    $time = date('Y-m-d');

    // Michal -> validace
    /*
    echo '<script type="text/javascript">',
         'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
         '</script>';

    return;
    */


    $query =
    "INSERT INTO `Krmeni`VALUES('', '$idZamestnance', '$idZvire', '$time', '')";

    $result = mysqli_query($db, $query);

    if(!$result) {
              return;
    }
    else {
        return;
    }
}
else if(@$_POST['dest'] == 'Edone') {
    $idUklid = mysqli_real_escape_string($db,$_POST['idUklid']);
    $time = date('Y-m-d');

    $query ="DELETE FROM Uklizeni WHERE idUklizeni = '$idUklid'";

    $result = mysqli_multi_query($db, $query);

    while(mysqli_next_result($db));
}
else if(@$_POST['dest'] == 'Adone') {
    $idKrmeni = mysqli_real_escape_string($db,$_POST['idUklid']);
    $time = date('Y-m-d');

    $query ="DELETE FROM Krmeni WHERE idKrmeni = '$idKrmeni'";

    $result = mysqli_multi_query($db, $query);

    while(mysqli_next_result($db));
}
?>

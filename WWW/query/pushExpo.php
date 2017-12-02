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

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss") {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

if(@$_POST['addExpo']){


    if(@$_POST['novyDruh'] != "on") {
        $newDruh = mysqli_real_escape_string($db,$_POST['typExpo']);
    }
    else {
        $newDruh = mysqli_real_escape_string($db,$_POST['typ']);
    }
    $newJmeno = mysqli_real_escape_string($db,$_POST['jmeno']);
    $max = mysqli_real_escape_string($db,$_POST['max']);
    $idZamestnanec = mysqli_real_escape_string($db,$_POST['osetrovatel']);
    $stvoritel = $_SESSION['id'];
    // Michal -> validace
    /*
    echo '<script type="text/javascript">',
         'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
         '</script>';

    return;
    */

    $query =
    "   SELECT *
        FROM Expo
        WHERE druh = '$newDruh' AND jmeno = '$newJmeno'";

    $result = mysqli_query($db, $query);

    $count = mysqli_num_rows($result);


    if($count != 0) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba, expozice s danným jménem již existuje", "alert-danger");',
             '</script>';
              return;
    }
    else {

        $query =
        "INSERT INTO `Expo` VALUES('', (SELECT idZamestnance FROM Zamestnanci WHERE idZamestnance='$idZamestnanec'), '$newDruh', '$newJmeno', '$max');
        INSERT INTO `Uklizeni`(`idZamestnance`, `date`, `idExpo`) VALUES ((SELECT idZamestnance FROM Zamestnanci WHERE idZamestnance = '$stvoritel'), '0000-00-00', (SELECT idExpo FROM Expo WHERE druh = '$newDruh' AND jmeno = '$newJmeno'));";

        $result = mysqli_multi_query($db, $query);

        while(mysqli_next_result($db));


        if($result) {
            echo '<script type="text/javascript">',
                 'infoPanel("Expozice úspěšně přidána", "alert-success");',
                 '</script>';
                  return;
        }
        else {
            echo '<script type="text/javascript">',
                 'infoPanel("Nastala chyba, zkuste vaši akci opakovat později", "alert-danger");',
                 '</script>';
                  return;
        }
    }
}
else if(@$_POST['removeExpo']){
    $idExpo = mysqli_real_escape_string($db,$_POST['removeExpo']);

    $query ="UPDATE Zvire SET idExpo=(SELECT idExpo FROM Expo WHERE idExpo='') WHERE idExpo='$idExpo';";
    $query .="DELETE FROM Expo WHERE idExpo = '$idExpo';";

    $result = mysqli_multi_query($db, $query);

    while(mysqli_next_result($db));

    if(!$result) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba při odebrání expozice, zkuste to prosím později", "alert-danger");',
             '</script>';
              return;
    }
    echo '<script type="text/javascript">',
         'infoPanel("Expozice úspěšně odebrána", "alert-success");',
         '</script>';
          return;
}
?>

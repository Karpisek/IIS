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

if(@$_POST['addAnimal']){


    if(@$_POST['novyDruh'] == "on") {
        $newRodove = mysqli_real_escape_string($db,$_POST['rodoveJmeno']);
        $newDruhove = mysqli_real_escape_string($db,$_POST['druhoveJmeno']);
        $newLokace = mysqli_real_escape_string($db,$_POST['lokace']);
        $newStrava = mysqli_real_escape_string($db,$_POST['strava']);

        // Michal -> validace
        /*
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
             '</script>';

        return;
        */

        $query =
        "INSERT INTO `Druh` VALUES ('', '$newRodove', '$newDruhove', '$newLokace', '$newStrava')";

        $result = mysqli_query($db, $query);

        $query =
        "SELECT idDruh FROM `Druh` WHERE rodoveJmeno = '$newRodove' AND druhoveJmeno='$newDruhove'";

        $result = mysqli_query($db, $query);

        $row = mysqli_fetch_row($result);

        $row = mysqli_fetch_array($result,MYSQL_ASSOC);

        $idDruh = $row['idDruh'];
    }
    else {
        $idDruh = mysqli_real_escape_string($db,$_POST['druh']);
    }

    if(@$idDruh) {

        $jmeno = mysqli_real_escape_string($db,$_POST['jmeno']);
        $puvod = mysqli_real_escape_string($db,$_POST['puvod']);
        $narozen = mysqli_real_escape_string($db,$_POST['narozeni']);
        $idOsetrovatel = mysqli_real_escape_string($db,$_POST['osetrovatel']);
        $idExpo = mysqli_real_escape_string($db,$_POST['expo']);
        $pohlavi = mysqli_real_escape_string($db,$_POST['pohlavi']);
        $stvoritel = $_SESSION['id'];

        // Michal -> validace
        /*
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
             '</script>';

        return;
        */

        $query =
        "INSERT INTO `Zvire` VALUES('', (SELECT idZamestnance FROM Zamestnanci WHERE idZamestnance='$idOsetrovatel'), (SELECT idExpo FROM Expo WHERE idExpo='$idExpo'), (SELECT idDruh FROM Druh WHERE idDruh='$idDruh'), '$pohlavi', '$puvod', '$narozen', '', '$jmeno');
        INSERT INTO `Krmeni`(`idZamestnance`, `date`, `idZvire`) VALUES ((SELECT idZamestnance FROM Zamestnanci WHERE idZamestnance = '$stvoritel'), '0000-00-00', (SELECT idZvire FROM Zvire WHERE idDruh = '$idDruh' AND jmeno = '$jmeno' AND narozeni = '$narozen'));";


        $result = mysqli_multi_query($db, $query);

        while(mysqli_next_result($db));

        if($result) {
            echo '<script type="text/javascript">',
                 'infoPanel("Zvíře úspěšně přidáno", "alert-success");',
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
    else {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba, zkuste vaši akci opakovat později", "alert-danger");',
             '</script>';
              return;
    }


}
else if(@$_POST['removeAnimal']) {
    $idZvire = mysqli_real_escape_string($db,$_POST['removeAnimal']);

    $query ="DELETE FROM Zvire WHERE idZvire = '$idZvire';";

    $result = mysqli_multi_query($db, $query);

    while(mysqli_next_result($db));

    if(!$result) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba při odebrání zvířete, zkuste to prosím později", "alert-danger");',
             '</script>';
              return;
    }
    echo '<script type="text/javascript">',
         'infoPanel("Zvíře úspěšně odebrána", "alert-success");',
         '</script>';
          return;
}
?>

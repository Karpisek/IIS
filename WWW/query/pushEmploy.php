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

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss") {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

if(@$_POST['addEmp']){
    $login = mysqli_real_escape_string($db,$_POST['login']);
    $pass = mysqli_real_escape_string($db,$_POST['heslo']);
    $jmeno = mysqli_real_escape_string($db,$_POST['jmeno']);
    $prijmeni = mysqli_real_escape_string($db,$_POST['prijmeni']);
    $specializace = mysqli_real_escape_string($db,$_POST['specializace']);
    $mail = mysqli_real_escape_string($db,$_POST['email']);
    $narozeni = mysqli_real_escape_string($db,$_POST['narozeni']);
    $titul = mysqli_real_escape_string($db,$_POST['titul']);
    $rc = mysqli_real_escape_string($db,$_POST['rodneCislo']);
    $plat = mysqli_real_escape_string($db,$_POST['plat']);
    $smlouva = mysqli_real_escape_string($db,$_POST['smlouva']);

    // Michal -> validace
    /*
    echo '<script type="text/javascript">',
         'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
         '</script>';

    return;
    */

    $hased_pass =  hash("sha256", $pass);

    $query =
    "   SELECT *
        FROM Zamestnanci
        WHERE login = '$login'";

    $result = mysqli_query($db, $query);

    $count = mysqli_num_rows($result);

    if($count != 0) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
             '</script>';
              return;
    }
    else {
        // vlozeni do zamestnancu
        $query = "INSERT INTO login VALUES('$login','$hased_pass');";
        $query .= "INSERT INTO Zamestnanci (`jmeno`,`prijmeni`,`login`,`specializace`,`mail`,`narozeni`,`titul`,`rodneCislo`,`plat`,`smlouva`) ";
        $query .= "VALUES ('$jmeno', '$prijmeni', '$login', '$specializace', '$mail', '$narozeni', '$titul', '$rc', '$plat', '$smlouva');";

        $result = mysqli_multi_query($db, $query);

        if(!$result) {
            echo '<script type="text/javascript">',
                 'infoPanel("Nastala chyba, zkuste vaši akci opakovat později", "alert-danger");',
                 '</script>';
                  return;
        }

        echo '<script type="text/javascript">',
             'infoPanel("Nový uživatel úspěšně přidán", "alert-success");',
             '</script>';
              return;
    }
}

else if(@$_POST['kick']){
    $login = mysqli_real_escape_string($db,$_POST['kick']);

    $query =
    "   DELETE FROM login
        WHERE user = '$login'";

    $result = mysqli_query($db, $query);


    if(!$result) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba při odebrání uživatel, zkuste to prosím později", "alert-danger");',
             '</script>';
              return;
    }
    echo '<script type="text/javascript">',
         'infoPanel("Uživatel úspěšně odebrán", "alert-success");',
         '</script>';
          return;
}

else if(@$_POST['update']) {
    $login = mysqli_real_escape_string($db,$_POST['update']);
    $new_login = mysqli_real_escape_string($db,$_POST['login']);
    $idZamestnance = mysqli_real_escape_string($db,$_POST['idZamestnance']);
    $jmeno = mysqli_real_escape_string($db,$_POST['jmeno']);
    $prijmeni = mysqli_real_escape_string($db,$_POST['prijmeni']);
    $specializace = mysqli_real_escape_string($db,$_POST['specializace']);
    $oldSpec = mysqli_real_escape_string($db,$_POST['oldSpec']);
    $mail = mysqli_real_escape_string($db,$_POST['email']);
    $narozeni = mysqli_real_escape_string($db,$_POST['narozeni']);
    $titul = mysqli_real_escape_string($db,$_POST['titul']);
    $rc = mysqli_real_escape_string($db,$_POST['rodneCislo']);
    $plat = mysqli_real_escape_string($db,$_POST['plat']);
    $smlouva = mysqli_real_escape_string($db,$_POST['smlouva']);

    // Michal -> validace
    /*
    echo '<script type="text/javascript">',
         'infoPanel("Nastala chyba, uživatel se zadanným loginem již existuje", "alert-danger");',
         '</script>';

    return;
    */

    // zmena specializace
    if($oldSpec != $specializace) {

        $query ="   UPDATE Zvire SET idZamestnance=(SELECT idZamestnance FROM Zamestnanci WHERE idZamestnance='') WHERE idZamestnance='$idZamestnance';";
        $query .="UPDATE Expo SET idZamestnance=(SELECT idZamestnance FROM Zamestnanci WHERE idZamestnance='') WHERE idZamestnance='$idZamestnance'";
        $result = mysqli_multi_query($db, $query);

        while(mysqli_next_result($db));

        if(!$result) {
            echo '<script type="text/javascript">',
                 'infoPanel("Nastala chyba při úpravě přiřazených zvířat/expozic, zkuste to prosím později", "alert-danger");',
                 '</script>';
                 return;
        }
    }

    $query ="UPDATE login SET user='$new_login' WHERE user='$login';";
    $query .="UPDATE Zamestnanci SET jmeno='$jmeno',prijmeni='$prijmeni',
        specializace='$specializace',
        mail='$mail',
        narozeni='$narozeni',
        titul='$titul',
        rodneCislo='$rc',
        plat='$plat',
        smlouva='$smlouva' WHERE login='$new_login';";

    $result = mysqli_multi_query($db, $query);
    while(mysqli_next_result($db));

    if(!$result) {
        echo '<script type="text/javascript">',
             'infoPanel("Nastala chyba při úpravě informací uživatel, zkuste to prosím později", "alert-danger");',
             '</script>';
              return;
    }
    echo '<script type="text/javascript">',
         'infoPanel("Informace o uživateli úspěšně upraveny", "alert-success");',
         '</script>';
          return;
}





?>

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

if(!@$_SESSION['login_user']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

$idZamestnance = $_SESSION['id'];

if(@$_GET['expoTODO']){

    $query = "  SELECT
                    Za.jmeno  as jmeno,
                    Za.prijmeni as prijmeni,
                    Ex.jmeno  as jmenoExpo,
                    Ex.druh   as druhExpo,
                    U.idExpo as id,
                    U.date    as datum,
                    U.idUklizeni as idUklid

                FROM Expo Ex, Zamestnanci Za, (SELECT * FROM (SELECT * FROM (SELECT * FROM Uklizeni ORDER BY Uklizeni.date DESC) tmp GROUP BY idExpo) T ) U
                WHERE Ex.idZamestnance = '$idZamestnance'
                AND Za.idZamestnance = U.idZamestnance
                AND U.idExpo = Ex.idExpo
                AND U.date < CURDATE() - INTERVAL 1 DAY";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}
else if(@$_GET['animalTODO']){

    $query = "  SELECT
                 Za.jmeno  as jmeno,
                    Za.prijmeni as prijmeni,
                    Zv.jmeno  as jmenoZvire,
                    D.druhoveJmeno   as druh,
                    D.rodoveJmeno   as rod,
                    U.idZvire as id,
                    U.date    as datum,
                    U.idKrmeni as idKrmeni,
                    Ex.druh as druhExpo,
                    Ex.jmeno as jmenoExpo

                FROM Expo Ex, Zvire Zv, Zamestnanci Za, (SELECT * FROM (SELECT * FROM (SELECT * FROM Krmeni ORDER BY Krmeni.date DESC) tmp GROUP BY idZvire) T ) U, Druh D
                WHERE Zv.idZamestnance = '$idZamestnance'
                AND Zv.idDruh = D.idDruh
                AND Ex.idExpo = Zv.idExpo
                AND Za.idZamestnance = U.idZamestnance
                AND U.idZvire = Zv.idZvire
                AND U.date < CURDATE() - INTERVAL 1 DAY";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}

//dnes
else if(@$_GET['expoTODAY']){

    $query = "  SELECT
                    Za.jmeno  as jmeno,
                    Za.prijmeni as prijmeni,
                    Ex.jmeno  as jmenoExpo,
                    Ex.druh   as druhExpo,
                    U.idExpo as id,
                    U.date    as datum,
                    U.idUklizeni as idUklid

                FROM Expo Ex, (SELECT * FROM (SELECT * FROM (SELECT * FROM Uklizeni ORDER BY Uklizeni.date DESC) tmp GROUP BY idExpo) T ) U, Zamestnanci Za
                WHERE Ex.idZamestnance = '$idZamestnance'
                AND Za.idZamestnance = U.idZamestnance
                AND U.idExpo = Ex.idExpo
                AND U.date = CURDATE() - interval 1 day";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}
else if(@$_GET['animalTODAY']){

    $query = "  SELECT
                 Za.jmeno  as jmeno,
                    Za.prijmeni as prijmeni,
                    Zv.jmeno  as jmenoZvire,
                    D.druhoveJmeno   as druh,
                    D.rodoveJmeno   as rod,
                    U.idZvire as id,
                    U.date    as datum,
                    U.idKrmeni as idKrmeni,
                    Ex.druh as druhExpo,
                    Ex.jmeno as jmenoExpo

                FROM Expo Ex, Zvire Zv, Zamestnanci Za, (SELECT * FROM (SELECT * FROM (SELECT * FROM Krmeni ORDER BY Krmeni.date DESC) tmp GROUP BY idZvire) T ) U, Druh D
                WHERE Zv.idZamestnance = '$idZamestnance'
                AND Zv.idDruh = D.idDruh
                AND Ex.idExpo = Zv.idExpo
                AND Za.idZamestnance = U.idZamestnance
                AND U.idZvire = Zv.idZvire
                AND U.date = CURDATE() - INTERVAL 1 DAY";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}

//spleno dnes
else if(@$_GET['expoDONE']){

    $query = "  SELECT
                    Za.jmeno  as jmeno,
                    Za.prijmeni as prijmeni,
                    Ex.jmeno  as jmenoExpo,
                    Ex.druh   as druhExpo,
                    U.idExpo as id,
                    U.date    as datum,
                    U.idUklizeni as idUklid

                FROM Expo Ex, Zamestnanci Za, (SELECT * FROM (SELECT * FROM (SELECT * FROM Uklizeni ORDER BY Uklizeni.date DESC) tmp GROUP BY idExpo) T ) U
                WHERE Ex.idZamestnance = '$idZamestnance'
                AND Za.idZamestnance = U.idZamestnance
                AND U.idExpo = Ex.idExpo
                AND U.date = CURDATE()";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}
else if(@$_GET['animalDONE']){

    $query = "  SELECT
                 Za.jmeno  as jmeno,
                    Za.prijmeni as prijmeni,
                    Zv.jmeno  as jmenoZvire,
                    D.druhoveJmeno   as druh,
                    D.rodoveJmeno   as rod,
                    U.idZvire as id,
                    U.date    as datum,
                    U.idKrmeni as idKrmeni,
                    Ex.druh as druhExpo,
                    Ex.jmeno as jmenoExpo

                FROM Expo Ex, Zvire Zv, Zamestnanci Za, (SELECT * FROM (SELECT * FROM (SELECT * FROM Krmeni ORDER BY Krmeni.date DESC) tmp GROUP BY idZvire) T ) U, Druh D
                WHERE Zv.idZamestnance = '$idZamestnance'
                AND Zv.idDruh = D.idDruh
                AND Ex.idExpo = Zv.idExpo
                AND Za.idZamestnance = U.idZamestnance
                AND U.idZvire = Zv.idZvire
                AND U.date = CURDATE()";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}
?>

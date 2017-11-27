<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 27-11-2017
#
require '../query/connect.php';

header('Content-Type: text/html; charset=utf-8');

if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['zamestnanci']) {
    exit;
}

else {
    $query =
    "   SELECT *
        FROM (
            SELECT *
            FROM Zamestnanci
            NATURAL JOIN Osetrovatel
            UNION
            SELECT *
            FROM Zamestnanci
            NATURAL JOIN Uklizec
        ) AS T WHERE idZamestnance ='" . $_GET['id'] . "'";

    $ses_sql = mysqli_query($db, $query);

    $myArray = array();

    $row = mysqli_fetch_array($ses_sql,MYSQL_ASSOC);
}

?>

<div class="col-xs-12 container">
    <form class="mt20">

        <div class="form-group row">
            <div class="col-xs-1">
                <label for="ex1">Titul</label>
                <input class="form-control" id="ex1" type="text" value=<? echo $row['titul']; ?>>
            </div>
            <div class="col-xs-2">
                <label for="ex1">Jméno</label>
                <input class="form-control" id="ex1" type="text" value=<? echo $row['jmeno']; ?>>
            </div>
            <div class="col-xs-2">
                <label for="ex2">Příjmení</label>

                <input class="form-control" id="ex2" type="text" value=<? echo $row['prijmeni']; ?>>
            </div>
            <div class="col-xs-2">
                <label for="ex2">Datum narození</label>
                <input class="form-control" id="ex3" type="date" placeholder="DD/MM/RRRR" value=<? echo $row['narozeni'];?>>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-1">
                <label for="ex1">Login</label>
                <input class="form-control" id="ex1" type="text" value=<? echo $row['login']; ?>>
            </div>
            <div class="col-xs-4">
                <label for="ex1">Email</label>
                <input class="form-control" id="ex1" type="text" value=<? echo $row['mail']; ?>>
            </div>
            <div class="col-xs-2">
                <label for="ex2">Rodné číslo</label>
                <input class="form-control" id="ex3" type="text" value=<? echo $row['rodneCislo'];?>>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-7">
                <label for="ex1">Vzdelani</label>
                <input class="form-control" id="ex1" type="text" value=<? echo $row['vzdelani']; ?>>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-3">
            </div>
            <div class="col-xs-2">
                <label for="ex1">Smlouva</label>
                <input class="form-control" id="ex1" type="date" value=<? echo $row['smlouva']; ?>>
            </div>

            <div class="col-xs-2 ">
                <label for="ex1">Plat</label>
                <input class="form-control" id="ex1" type="number" value=<? echo $row['login']; ?>>
            </div>

        </div>

    </form>

</div>

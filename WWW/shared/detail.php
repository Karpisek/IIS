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

$changed = false;


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

if (isset($_POST['Update'])) {
    echo "ano";

}

?>

    <div class="col-xs-12" id="detail" style="background-color: rgba(120, 120, 120, 0.1)">
        <form class="mt20">
            <div class="form-group row">
                <div class="col-xs-2">
                    <label for="ex1">Titul</label>
                    <input class="form-control userForm" maxlength="5" type="text" value=<? echo $row['titul']; ?>>
                </div>
                <div class="col-xs-2">
                    <label for="ex1">Jméno</label>
                    <input class="form-control userForm" maxlength="10" type="text" value=<? echo $row['jmeno']; ?>>
                </div>
                <div class="col-xs-2">
                    <label for="ex2">Příjmení</label>

                    <input class="form-control userForm" id="ex2" type="text" value=<? echo $row['prijmeni']; ?>>
                </div>
                <div class="col-xs-3">
                    <label for="ex2">Datum narození</label>
                    <input class="form-control userForm" id="ex3" type="date" placeholder="DD/MM/RRRR" value=<? echo $row['narozeni'];?>>
                </div>

                <div class="col-xs-3">
                    <div class="col-xs-1"></div>
                    <input type="button" class="btn btn-warning col-xs-fluid" name="login" style="margin-left:5px" value="Update" id="updateBut">
                    <input type="button" class="btn btn-danger col-xs-fluid" name="login" style="margin-left:5px" value="Kick">
                </div>


            </div>

            <div class="form-group row">
                <div class="col-xs-3">
                    <label for="ex1">Login</label>
                    <input class="form-control userForm" id="ex1" type="text" value=<? echo $row['login']; ?>>
                </div>
                <div class="col-xs-3">
                    <label for="ex1">Email</label>
                    <input class="form-control userForm" id="ex1" type="text" value=<? echo $row['mail']; ?>>
                </div>
                <div class="col-xs-3">
                    <label for="ex2">Rodné číslo</label>
                    <input class="form-control userForm" id="ex3" type="text" value=<? echo $row['rodneCislo'];?>>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-9">
                    <label for="ex1">Vzdelani</label>
                    <input class="form-control userForm" id="ex1" type="text" value=<? echo $row['vzdelani']; ?>>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-3"></div>
                <div class="col-xs-3">
                    <label for="ex1">Smlouva</label>
                    <input class="form-control userForm" id="ex1" type="date" value=<? echo $row['smlouva']; ?>>
                </div>

                <div class="col-xs-3 ">
                    <label for="ex1">Plat</label>
                    <input class="form-control userForm" id="ex1" type="number" value=<? echo $row['plat']; ?>>
                </div>
            </div>


        </form>
    </div>


<script src="js/detail.js">

</script>

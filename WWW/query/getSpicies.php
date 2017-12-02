<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 30-11-2017
require 'connect.php';

if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss") {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}


else {
    $spicies = array();

    $query = "SELECT rodoveJmeno, druhoveJmeno, idDruh FROM Druh ORDER BY rodoveJmeno";

    $result = mysqli_query($db, $query);

    $druh = array();

    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
            $druh[] = $row;
    }

    echo json_encode($druh);
}

?>

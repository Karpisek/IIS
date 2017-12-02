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

    $expo = mysqli_real_escape_string($db,$_GET['idExpo']);

    $query =
    "   SELECT COUNT( Z.idExpo ) AS pocet, E.max AS max
        FROM Zvire AS Z, Expo AS E
        WHERE Z.idExpo = E.idExpo
        AND E.idExpo ='$expo'";

    $ses_sql = mysqli_query($db, $query);

    $pocet = array();

    while($row = mysqli_fetch_array($ses_sql,MYSQL_ASSOC)) {
            $pocet[] = $row;
    }

    echo json_encode($pocet);
}
?>

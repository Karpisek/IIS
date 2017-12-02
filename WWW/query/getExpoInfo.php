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

else {
    $idExpo = mysqli_real_escape_string($db,$_GET['idExpo']);

    $query =
    "   SELECT *
        FROM Expo
        WHERE idExpo = '$idExpo'
        ORDER BY druh;";

    $ses_sql = mysqli_query($db, $query);

    echo json_encode(mysqli_fetch_array($ses_sql,MYSQL_ASSOC));
}
?>

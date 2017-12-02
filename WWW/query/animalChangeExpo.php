<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   30-11-2017
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

    $idExpo = mysqli_real_escape_string($db,$_POST['idExpo']);
    $idZvire = mysqli_real_escape_string($db,$_POST['idZvire']);

    $query =
    "   UPDATE Zvire SET idExpo=(SELECT idExpo FROM Expo WHERE idExpo='$idExpo') WHERE idZvire = '$idZvire'; ";

    $ses_sql = mysqli_query($db, $query);
}
?>

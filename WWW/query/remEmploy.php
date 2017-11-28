<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   28-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 28-11-2017

if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['zamestnanci']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

else {
    /*
    $login = mysqli_real_escape_string($db,$_POST['login']);

    $query =
    "DELETE from zamestnanci where login='$login';
    DELETE from ";

    $ses_sql = mysqli_query($db, $query);

    $myArray = array();

    while($row = mysqli_fetch_array($ses_sql,MYSQL_ASSOC)) {
            $myArray[] = $row;
    }
    echo json_encode($myArray);
    */
}

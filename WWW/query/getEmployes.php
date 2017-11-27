<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 27-11-2017
require 'connect.php';

if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['zamestnanci']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
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
        ) AS T";

    $ses_sql = mysqli_query($db, $query);

    $myArray = array();

    while($row = mysqli_fetch_array($ses_sql,MYSQL_ASSOC)) {
            $myArray[] = $row;
    }
    echo json_encode($myArray);
}
?>

<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   25-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 26-11-2017

    include_once 'query/connect.php';

    if(!isset($_SESSION)){
        session_start();
    }

    $user_check = $_SESSION['login_user'];

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
        ) AS T
        WHERE login =  '$user_check' ";

    $ses_sql = mysqli_query($db, $query);

    $user_info = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

    if(!@$_SESSION['login_user']){
        header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
    }

?>

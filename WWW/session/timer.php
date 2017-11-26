<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 26-11-2017

    session_start();
    echo $timestamp = time() - $_SESSION['timestamp'];
    //echo $timestamp = date('H:i:s');



    if($timestamp > 20) {

        echo"<script>alert('15 Minutes over!');</script>";
        session_destroy();
        header("location: index.php");
    }
?>

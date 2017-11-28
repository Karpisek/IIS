<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 28-11-2017

include_once "session/session.php";
include_once "shared/navbar.php";

if(!@$_SESSION['expozice']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

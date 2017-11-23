<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   22-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 22-11-2017


$db_name = 'xkarpi05';
$db_pass = 'ke4ehaba';
$db_host = 'localhost';
$db_database = "xkarpi05";
$db = mysqli_connect($db_host, $db_name, $db_pass, $db_database);

//kontrola pripojeni
if(!$db) {
    die("Nepovedlo se pripojit k DB");
}

?>

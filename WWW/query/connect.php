<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   22-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 25-11-2017


$db_name = 'xkolar64';
$db_pass = 'ejumhur7';
$db_host = 'localhost';
$db_database = "xkolar64";
$db = mysqli_connect($db_host, $db_name, $db_pass, $db_database);

//nastaveni UTF-8
mysqli_query($db, "SET NAMES 'utf8'");

//kontrola pripojeni
if(!$db) {
    die("Nepovedlo se pripojit k DB");
}

?>

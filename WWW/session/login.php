<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   22-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 02-12-2017

//include_once "head.php";
include_once "query/connect.php";

 $error = 0;

 if(!isset($_SESSION)){
     session_start();
 }

if (isset($_POST['login'])) {

   $myusername = mysqli_real_escape_string($db,$_POST['name']);
   $mypassword = mysqli_real_escape_string($db,$_POST['password']);

   $hashed = hash("sha256", $mypassword);

   $sql = "SELECT user FROM login WHERE user='$myusername' AND pass='$hashed'";
   $result = mysqli_query($db, $sql);

   $count = mysqli_num_rows($result);

   // If result matched $myusername and $mypassword, table row must be 1 row
   //
   if($count == 1) {
      $row = mysqli_fetch_array($result,MYSQL_ASSOC);

      $_SESSION['login_user'] = $myusername;
      $_SESSION['timestamp'] = time();

      header("location: home.php");
   }else {
       echo '<script type="text/javascript">',
            'infoPanel("Špatné uživatelské jméno či heslo", "alert-danger");',
            '</script>';
   }
}
?>

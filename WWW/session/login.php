<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   22-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 26-11-2017

//include_once "head.php";
include_once "query/connect.php";

session_start();

if (isset($_POST['login'])) {

   $myusername = mysqli_real_escape_string($db,$_POST['name']);
   $mypassword = mysqli_real_escape_string($db,$_POST['password']);

   $hashed = hash("sha256", $mypassword);

   $sql = "SELECT user FROM login WHERE user='$myusername' AND pass='$hashed'";
   $result = mysqli_query($db, $sql);

   $count = mysqli_num_rows($result);

   // If result matched $myusername and $mypassword, table row must be 1 row

   if($count == 1) {
      $_SESSION['login_user'] = $myusername;
      $_SESSION['timestamp'] = time();
      $_SESSION['zamestnanci'] = true;
      $_SESSION['expozice'] = true;
      $_SESSION['zvirata'] = true;
      $_SESSION['krmeni'] = true;

      header("location: home.php");
   }else {
       $error = "Incorrect username or password";
   }
}

?>
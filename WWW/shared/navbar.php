<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   25-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 28-11-2017

header('Content-Type: text/html; charset=utf-8');

require "session/logout.php";

function authCheck() {
    if(@$_SESSION['zamestnanci']) {
        echo '<li';
        if($_SERVER['REQUEST_URI'] == "/~xkarpi05/employes.php") {
            echo ' class="active"';
        }
        echo'><a href="employes.php">Zaměstnanci</a></li>';
    }
    if(@$_SESSION['zvirata']) {
        echo '<li';
        if($_SERVER['REQUEST_URI'] == "/~xkarpi05/animals.php") {
            echo ' class="active"';
        }
        echo '><a href="animals.php" onclick="click(this)" >Zvířata</a></li>';
    }
    if(@$_SESSION['expozice']) {
        echo '<li';
        if($_SERVER['REQUEST_URI'] == "/~xkarpi05/expo.php") {
            echo ' class="active"';
        }
        echo '><a href="expo.php">Expozice</a></li>';
    }
    if(@$_SESSION['krmeni']) {
        echo '<li';
        if($_SERVER['REQUEST_URI'] == "/~xkarpi05/food.php") {
            echo ' class="active"';
        }
        echo '><a href="food.php">Krmení</a></li>';
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Infomacni system pro ZOO</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>




        <link rel="stylesheet" href="css/style.css">



    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">IS Zoo Olešňany</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav" id = "navbar">
                        <?php authCheck(); ?>
                    </ul>

                <?php
                    if(isset($_SESSION['login_user'])) { ?>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <p class="navbar-text"><span class="glyphicon glyphicon-user"></span><?php echo " ".$user_info['jmeno']." ".$user_info['prijmeni'] ?></p>
                        </li>
                        <li class="container-fluid">
                            <form method="post">
                                    <button type="submit" class="btn navbar-btn btn-danger" name="logout"> <i class="glyphicon glyphicon-off mr10"></i>Logout</button>
                            </form>
                        </li>
                    </ul>

                <? } ?>
                </div>



            </div>
        </nav>

        <div class="infoBox col-xs-12">
            <div class="col-md-5"></div>
            <div class="alert col-xs-12 col-md-2" id="infoMessage"></div>
        </div>

        <? if(isset($_SESSION['login_user'])) { ?>
            <div class="container w50 alert alert-danger paddingOff">
                <b id="timestamp" hidden="true">5m 0s</b>
                <script src="js/timer.js"></script>
            </div>
        <? } ?>


    <script src="js/infobox.js"></script>
    </body>

</html>

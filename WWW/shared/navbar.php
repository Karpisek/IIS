<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   25-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 26-11-2017

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

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
        <div class="container-fluid">
            <div class="container col-md-11 col-sm-11 col-xs-1">
            </div>
            <div class="container col-md-1 col-sm-1 col-xs-1">
                <div class="container w50 alert alert-danger paddingOff">
                    <b id="timestamp">5m 0s</b>
                </div>
            </div>
        </div>

        <? if(isset($_SESSION['login_user'])) { ?> <script src="js/timer.js"></script> <? } ?>

    </body>

</html>

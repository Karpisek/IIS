<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   25-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 01-12-2017

header('Content-Type: text/html; charset=utf-8');

require "session/logout.php";

function authCheck() {
    if(@$_SESSION['auth']) {
        if($_SESSION['auth'] == "boss") {
            echo '<li';
            if($_SERVER['REQUEST_URI'] == "/~xkarpi05/employes.php") {
                echo ' class="active"';
            }
            echo'><a href="employes.php">Zaměstnanci</a></li>';
        }
        if($_SESSION['auth'] == "boss") {
            echo '<li';
            if($_SERVER['REQUEST_URI'] == "/~xkarpi05/animals.php") {
                echo ' class="active"';
            }
            echo '><a href="animals.php" onclick="click(this)" >Zvířata</a></li>';
        }
        if($_SESSION['auth'] == "boss") {
            echo '<li';
            if($_SERVER['REQUEST_URI'] == "/~xkarpi05/expo.php") {
                echo ' class="active"';
            }
            echo '><a href="expo.php">Expozice</a></li>';
        }
        if($_SESSION['auth'] == 'boss' || $_SESSION['auth'] == 'osetrovatel') {
            echo '<li';
            if($_SERVER['REQUEST_URI'] == "/~xkarpi05/food.php") {
                echo ' class="active"';
            }
            echo '><a href="food.php">Krmení</a></li>';
        }
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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

        </script>




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
                            <p class="navbar-text"><span class="glyphicon glyphicon-user"></span><?php echo " ".$_SESSION['jmeno']." ".$_SESSION['prijmeni'] ?></p>
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
            <noscript>
                <div class="alert-danger" style="height: 80px;">
                    <center style="">
                        <br>
                        Váš JavaScript je vypnutý, pro správné fungování informačního systému jej prosím zapněte.
                        <br>Pokud si nevíte rady, postupujte prosím podle pokynů pod tímto odkazem: <a href="http://www.enable-javascript.com/" target="_blank"> zde lze nalézt návod </a>.
                    </center>

                </div>

            </noscript>
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

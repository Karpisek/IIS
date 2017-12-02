<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   25-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 02-12-2017

include_once "session/session.php";
include_once "shared/navbar.php";

if(@$_SESSION['auth'] == 'boss') {
    ?>
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4 panel panel-default" style="padding: 10px">

                <h2>Vítejte v IS pro Zoo</h2> 
                <br>jste přihlášen jako Vedoucí,
                <br>tudíž máte přistup ke všem důležitým záložkám, např. pro správu zvířat, nebo zaměstnanců

        </div>
    </div>


    <?
}
else {
    ?>


    <body>

        <div class="row" >
            <div class="col-xs-4" style="height: 500p" id="todo">
                <div class="col-xs-10 col-xs-offset-1" style="height: 80px">
                    <center>
                        <i class="glyphicon todoExpo glyphicon-remove" style="color:red; font-size: 50px" ></i>
                    </center>
                </div>
            </div>


            <div class="col-xs-4" style="height: 500px;" id="today">
                <div class="col-xs-10 col-xs-offset-1" style="height: 80px">
                    <center>
                        <i class="glyphicon glyphicon-time" style="color:orange; font-size: 50px" ></i>
                    </center>
                </div>
            </div>
            <div class="col-xs-4" style="height: 500px" id="done">
                <div class="col-xs-10 col-xs-offset-1" style="height: 80px">
                    <center>
                        <i class="glyphicon glyphicon-ok" style="color:green; font-size: 50px" ></i>
                    </center>
                </div>
            </div>
        </div>



    <script src="js/work.js">

    </script>
    </body>
    <?
}
?>

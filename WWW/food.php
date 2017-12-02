<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 01-12-2017

include_once "session/session.php";
include_once "shared/navbar.php";
include_once 'shared/foodModal.php';
include_once 'shared/foodInfo.php';
include_once 'shared/search.php';
include_once "query/pushFood.php";


if(!@$_SESSION['login_user']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

<body>
    <div class="row">
        <div id="tableBox" class="col-sx-12 col-md-offset-1 col-md-10">
            <table class="table table-hover col-sx-12">
            <thead>
              <tr>
                <th class="col-xs-3">Název</th>
                <th class="col-xs-1">Typ</th>
                <th class="col-xs-1">Množství</th>
                <th class="col-xs-1"></th>
                <th class="col-xs-2">Trvanlivost</th>
                <th class="col-xs-2">Pořízeno</th>
                <th class="col-xs-1"></th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>
            <tbody id="table" class="">

            </tbody>
            <tfoot id="footer">
                <tr>
                    <td colspan="10">
                        <div class="row">
                            <div class="col-xs-offset-11 col-xs-1">
                                <button class="btn btn-success" id="plusBut" data-toggle="modal" data-target="#foodModal">
                                    <div class="glyphicon glyphicon-plus" style="font-size: 20px;">

                                    </div>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
          </tfoot>
          </table>
        </div>
        <div class="container col-md-1"></div>
    </div>
</div>


<script src="js/food.js"></script>

</body>

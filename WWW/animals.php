<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 02-12-2017

include_once "session/session.php";
include_once "shared/navbar.php";
include_once "shared/animalModal.php";
include_once "shared/animalInfo.php";
include_once "query/pushAnimal.php";
include_once 'shared/search.php';

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
                <th class="col-xs-1">Druh</th>
                <th class="col-xs-2"></th>
                <th class="col-xs-1"></th>
                <th class="col-xs-1"></th>
                <th class="col-xs-1"></th>
                <th class="col-xs-5"></th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>
            <tbody id="table" class="">

            </tbody>
            <tfoot id="footer">
                <tr>
                    <td colspan="7">
                        <div class="row">
                            <div class="col-xs-offset-11 col-xs-1">
                                <button class="btn btn-success" id="plusBut" data-toggle="modal" data-target="#animalInfo">
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


<script src="js/animals.js"></script>

</body>

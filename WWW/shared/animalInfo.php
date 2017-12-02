<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   29-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 01-12-2017
if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss") {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

<!-- Modal -->
<div id="animalShow" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">
            <div class="row">
                <div id='sPohlavi' class="col-xs-1">

                    <i class="fa fa fa-venus" style="font-size:18px; width:21px"></i>

                </div>
                <div class="col-xs-6">
                    <span id="sTitulek">Bobr jemný</span>
                </div>
            </div>




        </h4>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-2">
                <strong>Výskyt</strong>
            </div>
            <div id='sVyskyt' class="col-xs-10">
                jižní Amerika
            </div>
        </div>
        <div class="row" style="">
            <div class="col-xs-2">
                <strong>Původ</strong>
            </div>
            <div id='sPuvod' class="col-xs-10">
                ZOO Lešná
            </div>
        </div>
        <div class="row" style="">
            <div class="col-xs-2">
                <strong>Narozen</strong>
            </div>
            <div id='sNarozeni' class="col-xs-10">
                11.12.1995
            </div>
        </div>
        <div class="row" style="">
            <div class="col-xs-2">
                <strong>Jméno</strong>
            </div>
            <i id='sJmeno' class="col-xs-10">
                ťuťík
            </i>
        </div>
        <div class="row" style="">
            <div class="col-xs-2">
                <strong>Strava</strong>
            </div>
            <i id='sStrava' class="col-xs-10">
                <i class="glyphicon glyphicon-leaf"></i>
            </i>
        </div>
      </div>
      <div class="modal-body">

          tady budou informace o kontrolach


              </div>






              <div class="modal-footer">
                  <form method="post" action="">
                      <div class="form-group">
                          <button id="kickBut" type="submit" class="btn btn-danger kickBut" name="removeAnimal" value="">Odstranit</button>
                      </div>
                  </form>
              </div>
          </form>
          </div>
      </div>

    </div>
</div>

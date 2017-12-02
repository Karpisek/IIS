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
<div id="expoShow" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">
            <div class="row">
                <div class="col-xs-offset-1 col-xs-6">
                    <span id="sTitulek"></span>
                </div>
            </div>




        </h4>
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-2">
                <strong>Kapacita</strong>
            </div>
            <div id='sKapacita' class="col-xs-10">

            </div>
        </div>
        <div class="row" style="">
            <div class="col-xs-2">
                <strong>Správa</strong>
            </div>
            <div id='sPracovnik' class="col-xs-10">

            </div>
        </div>
    </div>
      <div class="modal-body">

          tady budou informace o uklidech


              </div>

              <div class="modal-footer">
                  <form method="post" action="">
                      <div class="form-group">
                          <button id="kickBut" type="submit" class="btn btn-danger" name="removeExpo" value="">Odstranit</button>
                      </div>
                  </form>

              </div>
          </form>
          </div>
      </div>

    </div>
</div>

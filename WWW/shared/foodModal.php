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

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss" && $_SESSION['auth'] != 'osetrovatel') {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

<!-- Modal -->
<div id="foodModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><center id="titule">Přidání krmení</center></h4>
      </div>
      <div class="modal-body">


          <form id="foodInfo" data-toggle="validator" role="form" method="post" action="">
                  <div class="form-group">
                      <label for="druh">Typ krmení</label>
                      <div class="form-inline row">
                          <div class="form-group col-xs-4">
                              <div class="checkbox col-xs-12">
                                  <label><input id="druh" type="checkbox" name="novyDruh"> Nový typ krmení</label>
                              </div>
                          </div>
                      </div>
                      <div class="form-inline row">
                          <div class="form-group col-xs-5 staryDruh">
                              <select class="form-control" name="old" id="druhStary">

                              </select>
                          </div>
                          <div class="form-group col-xs-4 novyExpo">
                              <input type="text" class="form-control novyDruh" placeholder="Typ krmiva" name="new">
                          </div>
                          <div class="form-group col-xs-6">
                              <div id="strava" class="btn btn-default novyDruh"><i class="glyphicon glyphicon-leaf"></i></div>
                              <input id="hStrava" type="text" hidden="true" value="B" name="strava">
                          </div>

                      </div>
                </div>



                  <div class="form-group row">
                      <div class="form-group col-xs-4">
                          <label for="jmeno">Množství</label>
                          <input type="number" class="form-control" placeholder="Množství" name="mnozstvi" id="max" required>
                      </div>

                      <div class="form-group col-xs-4">
                          <label for="jmeno">Trvanlivost</label>
                          <input type="date" class="form-control" placeholder="Množství" name="trvanlivost" id="max" required>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <div class="form-group">
                      <button type="submit" class="btn btn-success"  data-toggle="modal" data-backdrop="static" name="addFood" value="true" >Přidat</button>
                  </div>
              </div>
          </form>
          </div>
      </div>

    </div>
</div>

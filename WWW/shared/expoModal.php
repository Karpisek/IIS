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
<div id="expoInfo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><center id="titule">Přidání expozice</center></h4>
      </div>
      <div class="modal-body">


          <form id="animalInfo" data-toggle="validator" role="form" method="post" action="">
                  <div class="form-group">
                      <label for="druh">Typ expozice</label>
                      <div class="form-inline row">
                          <div class="form-group col-xs-4">
                              <div class="checkbox col-xs-12">
                                  <label><input id="typ" type="checkbox" name="novyDruh"> Nový typ expozice</label>
                              </div>
                          </div>
                      </div>
                      <div class="form-inline row">
                          <div class="form-group col-xs-4">
                              <input type="text" class="form-control" placeholder="Jméno expozice" name="jmeno">
                          </div>
                          <div class="form-group col-xs-4 staryExpo">
                              <select class="form-control" name="typExpo" id="expoStary">

                              </select>
                          </div>
                          <div class="form-group col-xs-4 novyExpo">
                              <input type="text" class="form-control" placeholder="Typ expozice" name="typ">
                          </div>

                      </div>
                </div>



                  <div class="form-group row">
                      <div class="form-group col-xs-4">
                          <label for="jmeno">Maximální počet zvířat</label>
                          <input type="number" class="form-control" placeholder="Kapacita" name="max" id="max" required>
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="form-group col-xs-6">
                          <label for="osetrovatel">Přiřazený pracovník</label>
                          <select class="form-control" name="osetrovatel" id="osetrovatel">

                          </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <div class="form-group">
                      <button type="submit" class="btn btn-success"  data-toggle="modal" data-backdrop="static" name="addExpo" value="true" >Přidat</button>
                  </div>
              </div>
          </form>
          </div>
      </div>

    </div>
</div>

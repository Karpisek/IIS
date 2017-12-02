<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   29-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 30-11-2017
if(!@$_SESSION){
    session_start();
}

if(!@$_SESSION['auth'] || $_SESSION['auth'] != "boss") {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

<!-- Modal -->
<div id="animalInfo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><center id="titule">Přidání zvířete</center></h4>
      </div>
      <div class="modal-body">


          <form id="animalInfo" data-toggle="validator" role="form" method="post" action="">
                  <div class="form-group">
                      <label for="druh">Druh</label>
                      <div class="form-inline row">
                          <div class="form-group col-xs-4">
                              <div class="checkbox">
                                  <label><input id="druh" type="checkbox" name="novyDruh"> Přidání nového druhu</label>
                              </div>
                          </div>
                      </div>
                      <div class="form-inline row staryDruh">
                          <div class="form-group col-xs-4">
                              <select class="form-control" name="druh" id="druhStary">

                              </select>
                          </div>
                      </div>
                      <div class="form-inline row novyDruh">
                          <div class="form-group col-xs-4">
                              <input type="text" class="form-control" placeholder="Rodové jméno" name="rodoveJmeno">
                          </div>
                          <div class="form-group col-xs-4">

                                <input type="text" class="form-control" placeholder="Druhové jméno" name="druhoveJmeno">
                            </div>

                              <div class="form-group col-xs-1">



                                  <div id="strava" class="btn btn-default"><i class="glyphicon glyphicon-leaf"></i></div>
                                  <input id="hStrava" type="text" hidden="true" value="B" name="strava">

                          </div>

                          <div class="form-group col-xs-3">
                              <select class="form-control" name="lokace">
                                  <option value="Severní Amerika">Severní Amerika</option>
                                  <option value="Jižní Amerika">Jižní Amerika</option>
                                  <option value="Asie">Asie</option>
                                  <option value="Afrika">Afrika</option>
                                  <option value="Evropa">Evropa</option>
                                  <option value="Antarktida">Antarktida</option>
                              </select>
                          </div>


                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="form-group col-xs-6">
                          <label for="jmeno">Jméno</label>
                          <input type="text" class="form-control" placeholder="Jméno" name="jmeno" id="jmeno" required>
                      </div>

                      <div class="form-group col-xs-6">
                          <label for="puvod">Původ</label>
                          <input type="text" class="form-control" placeholder="Původ" name="puvod" id="puvod">
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="form-group col-xs-4">
                          <label for="narozeni">Narozen</label>
                          <input type="text" class="form-control" placeholder="RRRR/MM/DD" name="narozeni" id="narozeni" required>
                      </div>

                      <div class="form-group col-xs-2">
                          <div class="btn btn-info" id="pohlavi" style="margin-top: 25px"><i class="fa fa fa-mars" style="font-size:18px; width:21px"></i></div>
                          <input id="hType" type="text" hidden="true" value="M" name="pohlavi">
                      </div>
                  </div>

                  <div class="form-group row">

                      <div class="form-group col-xs-6">
                          <label for="osetrovatel">Ošetřovatel</label>
                          <select class="form-control" name="osetrovatel" id="osetrovatel">

                          </select>
                      </div>

                      <div class="form-group col-xs-6">
                          <label for="narozei">Expozice</label>
                          <select class="form-control" name="expo" id="expo">

                          </select>
                      </div>
                  </div>








              </div>
              <div class="modal-footer">
                  <div class="form-group">
                      <button type="submit" class="btn btn-success"  data-toggle="modal" data-backdrop="static" name="addAnimal" value="true" >Přidat</button>
                  </div>
              </div>
          </form>
          </div>
      </div>

    </div>
</div>

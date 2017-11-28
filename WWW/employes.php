<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 28-11-2017

include_once "session/session.php";
include_once "shared/navbar.php";

if(!@$_SESSION['zamestnanci']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

<body>
    <? include 'shared/search.php' ?>
    <div class="row">
        <div id="tableBox" class="col-sx-12 col-md-offset-1 col-md-10">
            <table class="table table-hover col-sx-12">
            <thead>
              <tr>
                <th class="col-xs-1">Titul</th>
                <th class="col-xs-3">Jméno</th>
                <th class="col-xs-3">Příjmení</th>
                <th class="col-xs-3">Email</th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>
            <tbody id="table" class="">

            </tbody>
            <tfoot id="footer">
                <tr>
                    <td colspan="5">
                        <div class="row">
                            <div class="col-xs-offset-11 col-xs-1">
                                <button class="btn btn-success" id="plusBut" data-toggle="modal" data-target="#addEmp" data-backdrop="static">
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

<!-- Modal -->
<div id="addEmp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="height: 450px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><center>Přidání zaměstnance</center></h4>
      </div>
      <div class="modal-body" style="height: 200px;">
          <form id="newEmpForm">
              <div class="form-group">
                  <label>Jméno</label>
                  <div class="form-row">
                    <div class="col-xs-3">
                        <input type="text" class="form-control" placeholder="Titul" name="titul">
                    </div>
                    <div class="col-xs-3">
                      <input type="text" class="form-control" placeholder="Jméno" name="jmeno">
                    </div>

                    <div class="col-xs-6">
                      <input type="text" class="form-control" placeholder="Příjmení" name="prijmeni">
                    </div>
                  </div>
              </div>

              <div class="form-group"  style="margin-top: 50px">
                  <label>Datum narození a rodné číslo</label>
                  <div class="form-group-row">
                      <div class="col-xs-6">
                        <input type="date" class="form-control" placeholder="Datum narození" name="narozeni">
                      </div>
                      <div class="col-xs-6">
                        <input type="number" class="form-control" placeholder="Rodné číslo" name="rodneCislo">
                      </div>
                  </div>
              </div>

              <div class="form-group" style="margin-top: 50px">
                  <label>Email</label>
                  <div class="form-group-row">
                      <div class="col-xs-12">
                        <input type="email" class="form-control" placeholder="example@gmail.com" name="email">
                      </div>
                  </div>
              </div>


              <div class="form-group" style="margin-top: 50px">

            <label>Smlouva</label>
              <div class="form-row">

                <div class="col-xs-4">
                  <input type="date" class="form-control" placeholder="Smlouva" name="smlouva" required>
                </div>
                <div class="col-xs-3">
                  <input type="number" class="form-control" placeholder="Plat" name="plat">
                </div>
                <div class="col-xs-offset-1 col-xs-4">
                    <select class="form-control">
                        <option value="osetrovate">Ošetřovatel</option>
                        <option value="pomoc">Pomocná síla</option>
                    </select>
                </div>
              </div>
                </div>

            </form>
      </div>
      <div class="modal-footer" style="margin-top: 120px">
          <input type="submit" class="btn btn-success"  data-toggle="modal" data-backdrop="static" id="newEmpBut" value="Save">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>


<div id="setLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="height: 290px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><center>Vytvoření loginu</center></h4>
      </div>
      <div class="modal-body" style="height: 200px;">
          <form id="setLoginForm">
              <div class="form-group">
                  <label>Login</label>
                  <div class="form-row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" placeholder="login" name="login" required>
                    </div>
                  </div>
              </div>

              <div class="form-group"  style="margin-top: 60px">
                  <label>Heslo</label>
                  <div class="form-group-row">
                      <div class="col-xs-6">
                        <input type="password" class="form-control" placeholder="Nové heslo" name="heslo" required>
                      </div>
                      <div class="col-xs-6">
                        <input type="password" class="form-control form-control-warning" placeholder="Znovu pro kontrolu" required>
                      </div>
                  </div>
              </div>

              <div class="form-group" style="margin-top: 50px">
            </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" id="setLoginBut">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>

<script src="js/employes.js"></script>

</body>

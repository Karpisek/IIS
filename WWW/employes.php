<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 01-12-2017

include_once "session/session.php";
include_once "shared/navbar.php";
include_once "query/pushEmploy.php";
include_once 'shared/search.php';

if(!(@$_SESSION['auth'] == 'boss')) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>

<body>
    <div class="row">
        <div id="tableBox" class="col-sx-12 col-md-offset-1 col-md-10">
            <table class="table table-hover col-sx-12">
            <thead>
              <tr>
                <th class="col-xs-1">Titul</th>
                <th class="col-xs-2">Jméno</th>
                <th class="col-xs-3">Příjmení</th>
                <th class="col-xs-3">Email</th>
                <th class="col-xs-2"></th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>
            <tbody id="table" class="">

            </tbody>
            <tfoot id="footer">
                <tr>
                    <td colspan="6">
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

<!-- POTREBA UDELAT VALIDACI pomoci pattern="^[_A-z0-9]{1,}$" http://1000hz.github.io/bootstrap-validator/ -->
<!-- Modal -->
<div id="addEmp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><center>Přidání zaměstnance</center></h4>
      </div>
      <div class="modal-body">


          <form id="newEmpForm" data-toggle="validator" role="form" method="post" action="">
              <div class="group-inline row">
                  <div class="form-group col-xs-2">
                      <label for="titul">Titul</label>
                      <input type="text" class="form-control" placeholder="Titul" name="titul" id="titul">
                  </div>

                  <div class="form-group col-xs-5">
                      <label for="jmeno">Jméno</label>
                      <input type="text" class="form-control"  placeholder="Jméno" name="jmeno" id="jmeno" required autofocus>
                      <div class="help-block with-errors">Minimum of 6 characters</div>
                  </div>

                  <div class="form-group col-xs-5">
                      <label for="prijmeni">Příjmení</label>
                      <input type="text" class="form-control" placeholder="Příjmení" name="prijmeni" id="prijmeni" required>
                  </div>
              </div>



              <div class="group-inline row">
                  <div class="form-group col-xs-6 ">
                      <label for="narozeni">Datum narození</label>
                      <input type="date" class="form-control" placeholder="DD/MM/RRRR" name="narozeni" id="narozeni" required>
                  </div>
                  <div class="form-group col-xs-6 ">
                      <label for="rc">Rodné číslo</label>
                      <input type="number" class="form-control" placeholder="Rodné číslo" id="rc" name="rodneCislo">
                  </div>
              </div>


              <div class="form-group has-feedback">
                  <label for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control" placeholder="example@gmail.com" id="email" name="email">
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              </div>

              <div class="group-inline row">
                  <div class="form-group col-xs-5 ">
                      <label for="smlouva">Smlouva</label>
                      <input type="date" class="form-control" placeholder="Smlouva" id="smlouva" name="smlouva">
                  </div>

                  <div class="form-group col-xs-4 ">
                      <label for="plat">Plat</label>
                      <input type="number" class="form-control" placeholder="Plat" name="plat" id="plat">
                  </div>

                  <div class="form-group col-xs-3">
                      <label for="osetrovatel">Pracovní poměr</label>
                      <select class="form-control" id="osetrovatel" name="specializace">
                          <option value="osetrovatel">Ošetřovatel</option>
                          <option value="pomoc">Pomocná síla</option>
                          <option value="boss">Vedoucí</option>
                      </select>
                  </div>
              </div>




              <div class="group-inline row">
                  <div class="form-group col-xs-3">
                      <label for="login">Login</label>
                      <input type="text" class="form-control" placeholder="login" name="login" required>
                  </div>
              </div>

              <div class="group-inline row">
                  <div class="form-group col-xs-6">
                      <label for="pass">Heslo</label>
                      <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" name="heslo" required>
                      <div class="help-block">Minimálně 6 písmen</div>
                  </div>
                  <div class="form-group col-sm-6">
                      <label for="pass">Znovu</label>
                      <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Upsala, Hesla se neshodují" placeholder="Confirm" required>
                      <div class="help-block with-errors"></div>
                  </div>
              </div>


              <div class="modal-footer">
                  <div class="form-group">
                      <button type="submit" class="btn btn-success" name="addEmp" value="true" >Submit</button>
                  </div>
              </div>
          </form>
          </div>
      </div>

    </div>
</div>

<script src="js/employes.js"></script>

</body>

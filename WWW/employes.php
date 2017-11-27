<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 27-11-2017

include_once "session/session.php";
include_once "shared/navbar.php";

if(!@$_SESSION['zamestnanci']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>


<body>

    <? include 'shared/search.php' ?>

    <!--
    <div class="container col-xs-12">
        <table class="table table-hover">
        <thead>
          <tr>
            <th class="col-xs-1">Titul</th>
            <th class="col-xs-2">Jméno</th>
            <th class="col-xs-3">Příjmení</th>
            <th class="col-xs-3">Email</th>
            <th class="col-xs-2"></th>
          </tr>
        </thead>
        <tbody id="table">
        </tbody>
      </table>
    </div>

    <script src="js/employes.js"></script>
    -->

    <table border="0">
  <tr  class="header expand">
      <th colspan="2">Header <span class="sign"></span></th>
  </tr>
  <tr>
    <td>data</td>
    <td>data</td>
  </tr>
  <tr>
    <td>data</td>
    <td>data</td>
  </tr>
  <tr  class="header expand">
    <th colspan="2">Header <span class="sign"></span></th>
  </tr>
  <tr>
    <td>date</td>
    <td>data</td>
  </tr>
  <tr>
    <td>data</td>
    <td>data</td>
  </tr>
  <tr>
    <td>data</td>
    <td>data</td>
  </tr>
</table>

<script type="text/javascript">
$('.header').click(function(){
 $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
});
</script>

</body>

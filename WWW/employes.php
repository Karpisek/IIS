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

    <div class="container">
        <table class="table table-striped">
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

</body>

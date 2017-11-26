<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 26-11-2017

include_once "session/session.php";
include_once "shared/navbar.php";

if(!@$_SESSION['zamestnanci']) {
    header("location: http://www.stud.fit.vutbr.cz/~xkarpi05/index.php");
}

?>


<body>
    <div class="container">
        <table class="table table-striped">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="table">
        </tbody>
      </table>
    </div>




    <script src="js/employes.js"></script>
</body>

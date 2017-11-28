<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   22-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 28-11-2017
include_once "shared/navbar.php";
include_once 'session/login.php'; // Includes Login Script


if(isset($_SESSION['login_user'])){
    header("location: home.php");
}

?>

<!DOCTYPE html>
<html>
    <body>
        <div class="outer">
            <div class="middle">
                <div class="inner">

                    <div class="container col-md-offset-4 col-md-4 login_panel padding">
                        <div class="panel col-md-offset-2 col-md-8 padding">
                            <form method="post" action="" data-toggle="validator" role="form">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="name" placeholder="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" required>
                                    </div>
                                    <div class="input-group mt5">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="password" required>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary col-md-offset-4 col-md-4"  name="login" value="Log in">


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>

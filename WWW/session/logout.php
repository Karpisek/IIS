<?php
# @Author: Miroslav Karpíšek <miro>
# @Date:   22-11-2017
# @Email:  karpisek.m@email.cz
# @Project: IFJ
# @Last modified by:   miro
# @Last modified time: 27-11-2017

if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['logout'])) {
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header("location: /~xkarpi05/index.php");
}

?>

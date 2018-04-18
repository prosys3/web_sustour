<?php

$login = '<a class="btn btn-light ml-2" href="login.php" role="button"><i class="material-icons">lock</i> Login</a>';
$logout = '<button class="btn btn-light ml-2" type="submit" name="logout" role="button"><i class="material-icons">face</i> Logout</button>';

$form = '<div style="display: inline-block;">
            <form method="post">
                <input type="hidden">' . $logout . '
            </form>
        </div>';

if ( isset( $_SESSION['login_email']) ) {

    echo $form;

    if ( isset( $_POST['logout'] ) ) {

        session_destroy();
        header('Refresh: 0; URL=../login.php');

    }

} else {

    echo $login;

}


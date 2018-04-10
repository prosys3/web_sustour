<?php

require_once ("rsc/import/php/dbconfig.php");
require ("rsc/import/php/functions/functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myemail = mysqli_real_escape_string($con,$_POST['email']);
    $pwhash = mysqli_real_escape_string($con,$_POST['password']);

    $pwverify = PwCheck($myemail, $pwhash);

    if ($pwverify == true) {

        $sql = "SELECT User_ID FROM user_data WHERE User_Email = '$myemail'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);


        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            session_start();
            $_SESSION['login_email'] = $myemail;


            print("<META HTTP-EQUIV='Refresh'CONTENT='0;URL=index.php'>");
        } else {
            $error = "Your Login Name or Password is invalid!";
            echo "<div style='text-align: center;'><h1 style='color: black'>{$error}</h1></div>";
            header('Refresh: 3; URL=login.html');
        }
    } else {
        $error = "Your Login Name or Password is invalid!";
        echo "<div style='text-align: center;'><h1 style='color: black'>{$error}</h1></div>";
        header('Refresh: 3; URL=login.html');
    }
}

?>

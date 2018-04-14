
<?php

require_once ("../dbconfig.php");
require("rsc/import/php/functions/functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myemail = mysqli_real_escape_string($con,$_POST['email']);
    $pw = mysqli_real_escape_string($con,$_POST['password']);

    $pwhash = md5($pw);
    $pwverify = PwCheck($myemail, $pwhash);

    if ($pwverify == true) {

        $sql = "SELECT User_ID FROM user_data WHERE User_Email = '$myemail'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);


        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {

            $sql = "SELECT * FROM user_data WHERE User_Email = '$myemail'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $myfullname = $row['User_Name_First'] . " " . $row['User_Name_Last'] ;
            $myusertype = $row['User_Type'];
            $mycompany = $row['User_Company'];
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['login_email'] = $myemail;
            $_SESSION['login_name'] = $myfullname;
            $_SESSION['user_type'] = $myusertype;
            $_SESSION['user_company'] = $mycompany;

            if ( $_SESSION['user_type'] < 4 ) {
                header('Refresh: 0; URL=index.php');
            } else {
                header('Refresh: 0; URL=../index.php');
            }

        } else {
            $error = "Your Login Name or Password is invalid!";
            echo "<div style='text-align: center;'><h1 style='color: black'>{$error}</h1></div>";
            header('Refresh: 3; URL=../login.php');
        }
    }
    else {
        $error = "Your Login Name or Password is invalid!";
        echo "<div style='text-align: center;'><h1 style='color: black'>{$error}</h1></div>";
        header('Refresh: 3; URL=../login.php');
    }
}

?>

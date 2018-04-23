<?php
require_once("../dbconfig.php");


if(isset($_POST['submit_user_update'])) {

    $id = $_SESSION['tempID'];



    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $passw = mysqli_real_escape_string($con, $_POST['pass']);
    $usertype = mysqli_real_escape_string($con, $_POST['type']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $comp = mysqli_real_escape_string($con, $_POST['company']);

    $pwhash = md5($_POST['pass']);

    if ( empty($passw)) {
        $sql = "UPDATE `User_Data` SET User_Name_First   =  '$fname',
                                        User_Name_Last   =  '$lname',
                                        User_Type        =  '$usertype',
                                        User_Email       =  '$email', 
                                        User_Company     =  '$comp'
                                    WHERE User_ID        =  '$id'";


    } else {
        $sql = "UPDATE `User_Data` SET User_Name_First   =  '$fname',
                                        User_Name_Last   =  '$lname',
                                        User_Password    =  '$pwhash',
                                        User_Type        =  '$usertype',
                                        User_Email       =  '$email',
                                        User_Company     =  '$comp'
                                   WHERE User_ID         =  '$id'";
    }


    if (mysqli_query($con, $sql)) {

        echo "<div style='text-align: center;'><h1 style='color: black'>User Updated!</h1></div>";
        header("Refresh:2; url=user_list.php");
    } else {
        die("Error: " . mysqli_sqlstate($con));
    }
}
    mysqli_close($con);
    ?>

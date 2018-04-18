<?php  session_start(); ?>
<?php

if(isset($_POST['submit_user'])) {

    require_once ("../dbconfig.php");

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $passw = mysqli_real_escape_string($con, $_POST['pass']);
    $usertype = mysqli_real_escape_string($con, $_POST['usertype']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $comp = mysqli_real_escape_string($con, $_POST['company']);

    if (empty($fname) || empty($lname) ||  empty($email) || empty($passw) || empty($usertype) || empty($phone) || empty($comp)) {
        header("Location: RegisterPage.php");
        exit();

    } elseif (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
        header("Location: RegisterPage.php?signup=invalid");
        exit();

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: RegisterPage.php?signup=email");
        exit();

    } else {

        $sql = "SELECT * FROM User_Data WHERE User_Email ='$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);


        if ($resultCheck > 0) {
            header("Location: RegisterPage.php?signup=usertaken");
            exit();
        } else {

            // password hash
            $pwhash = md5($_POST['pass']);

            $sqql = "INSERT INTO `User_Data`(User_Name_First, User_Name_Last, User_Email, User_Password, User_Type, User_Phone, User_Company) 
                     VALUES ('$fname', '$lname', '$email', '$pwhash', '$usertype', '$phone', '$comp');";
        }
    }
    if (mysqli_query($con, $sqql)) {

        echo "<div style='text-align: center;'><h1 style='color: black'>User Created!</h1></div>";
        header("Refresh:3; url=index.php");
    } else {
        die("Error: " . mysqli_sqlstate($con));
    }

    mysqli_close($con);

} else {
    header("Location: RegisterPage.php");
    exit();
}

?>
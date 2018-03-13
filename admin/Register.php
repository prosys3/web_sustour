<?php

if(isset($_POST['submit'])) {

    require_once ("dbconfig.php");

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $usern = mysqli_real_escape_string($con, $_POST['useracc']);
    $passw = mysqli_real_escape_string($con, $_POST['pass']);
    $usertype = mysqli_real_escape_string($con, $_POST['usertype']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $comp = mysqli_real_escape_string($con, $_POST['company']);

    if (empty($fname) || empty($lname) || empty($usern) || empty($passw) || empty($usertype) || empty($email) || empty($phone) || empty($comp)) {
        header("Location: RegisterPage.php");
        exit();

    } elseif (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
        header("Location: RegisterPage.php?signup=invalid");
        exit();

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: RegisterPage.php?signup=email");
        exit();

    } else {

        $sql = "SELECT * FROM userdat WHERE User_Name_Account ='$usern'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);


        if ($resultCheck > 0) {
            header("Location: RegisterPage.php?signup=usertaken");
            exit();
        } else {

            // password hash
            $pwhash = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            $sqql = "INSERT INTO `userdat`(User_Name_First, User_Name_Last, User_Name_Account, User_Password, User_Type, User_Email, User_Phone, User_Company) 
                     VALUES ('$fname', '$lname', '$usern', '$pwhash', '$usertype', '$email', '$phone', '$comp');";
        }
    }
    if (mysqli_query($con, $sqql)) {

        echo "<div style='text-align: center;'><h1 style='color: black'>Bruker opprettet!</h1></div>";
        header('Refresh: 3; URL=http://localhost/dashboard/Loginpage.html');
    } else {
        die("Error: " . mysqli_sqlstate($con));
    }

    mysqli_close($con);

} else {
    header("Location: RegisterPage.php");
    exit();
}

?>
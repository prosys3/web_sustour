<?php



function PwCheck($myemail, $pwhash) {

    global $con;

    $sql = "SELECT User_Password FROM userdat WHERE User_Email = '$myemail'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    $pwverify = password_verify($pwhash, $row['User_Password']);

    return $pwverify;
}

?>
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


    <?php function registredMemberCount ($con) 
{
    $sql = "SELECT COUNT(User_ID) FROM user_data";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
?>


    <?php function postCount ($con) 
{
    $sql = "SELECT COUNT(Post_ID) FROM post";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
?>


    <?php function fileCount ($con) 
{
    $sql = "SELECT COUNT(File_ID) FROM file";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
?>
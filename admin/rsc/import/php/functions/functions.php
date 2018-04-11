<?php



function PwCheck ($myemail, $pwhash)
{
    global $con;
    $sql = "SELECT User_Password FROM user_data WHERE User_Email = '$myemail'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $pwverify = password_verify($pwhash, $row['User_Password']);
    return $pwverify;
}



function registredMemberCount ($con)
{
    $sql = "SELECT COUNT(User_ID) FROM user_data";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}



function postCount ($con)
{
    $sql = "SELECT COUNT(Post_ID) FROM post";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}



function fileCount ($con)
{
    $sql = "SELECT COUNT(File_ID) FROM file";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}



function fillUserList()
{

    global $con;

    $query = "SELECT * FROM user_data";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {

        echo "<tr >";
        echo "<td >" . $row['User_Name_First'] . " " . $row['User_Name_Last'] . "</td >";
        echo "<td >" . $row['User_Email'] . "</td >";
        $tempQuery = "SELECT * FROM user_type where " . $row['User_Type'] . " = User_Type_ID";
        $tempRes = mysqli_query($con, $tempQuery);
        $tempRow = mysqli_fetch_array($tempRes);
        echo "<td >" . $tempRow['User_Type_Name'] . "</td >";
        echo '<td ><a class="btn btn-default" href = "edit.php" > Edit</a > <a class="btn btn-danger" href = "#" > Delete</a ></td >';
        echo "</tr>";
    }

}

?>
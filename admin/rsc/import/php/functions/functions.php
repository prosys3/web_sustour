<?php



function PwCheck ($myemail, $pwhash)
{
    global $con;
    $sql = "SELECT User_Password FROM User_Data WHERE User_Email = '$myemail'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    if ($pwhash == $row['User_Password']) {
        return true;
    } else {
        return false;
    }

}



/*
 * A BETTER COUNTER!
 *
 * Usage:
 * --
 * Count users: counter($con, users);
 * Count posts: counter($con, posts);
 * Count files: counter($con, files);
 * */
function counter ($con, $whatToCount) {

    $input = null;

    switch ($whatToCount) {

        case "users": $input = "User_ID) FROM user_data";
        break;

        case "posts": $input = "Post_ID) FROM post";
        break;

        case "files": $input = "File_ID) FROM file";
        break;

        default: die;

    }

    $sql = "SELECT COUNT(" . $input;
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];

}




function registredMemberCount ($con)
{
    $sql = "SELECT COUNT(User_ID) FROM User_Data";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}



function postCount ($con)
{
    $sql = "SELECT COUNT(Post_ID) FROM Post";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}



function fileCount ($con)
{
    $sql = "SELECT COUNT(File_ID) FROM File";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}


function postTitle ($con)
{
	$id = $_GET["id"];
    $sql = "SELECT Post_Title FROM Post Where Post_ID = $id ";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function postText ($con)
{
	$id = $_GET["id"];
    $sql = "SELECT Post_Text FROM Post Where Post_ID = $id ";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}


function postTag ($con)
{

	global $con;
	$id = $_GET["id"];

    $tempQuery = "SELECT * FROM Post where Post_ID = $id";
    $tempRes = mysqli_query($con, $tempQuery);

	while ($row = mysqli_fetch_array($tempRes)) {

    $sql = "SELECT * FROM Tags WHERE " . $row['Post_Tag'] . " = Tag_ID ";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_array($result);
    if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
 
 }
    return $rows['Tag_Name'];   
}



function fillUserList()
{

    global $con;

    $query = "SELECT * FROM User_Data";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {

        echo "<tr >";
        echo "<td >" . $row['User_Name_First'] . " " . $row['User_Name_Last'] . "</td >";
        echo "<td >" . $row['User_Email'] . "</td >";
        $tempQuery = "SELECT * FROM User_Type where " . $row['User_Type'] . " = User_Type_ID";
        $tempRes = mysqli_query($con, $tempQuery);
        $tempRow = mysqli_fetch_array($tempRes);
        echo "<td >" . $tempRow['User_Type_Name'] . "</td >";
        echo '<td ><a class="btn btn-default" href = "edit.php" > Edit</a > <a class="btn btn-danger" href = "#" > Delete</a ></td >';
        echo "</tr>";

    }

}

?>
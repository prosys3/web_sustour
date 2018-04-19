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
 * Count users: counter("users");
 * Count posts: counter("posts");
 * Count files: counter("files");
 * */
function counter ($whatToCount) {

    global $con;

    switch ($whatToCount) {

        case "users": $input = "User_ID) FROM User_Data";
        break;

        case "posts": $input = "Post_ID) FROM Post";
        break;

        case "files": $input = "File_ID) FROM File";
        break;

        default: die;

    }

    $sql = "SELECT COUNT(" . $input;
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    return $row[0];

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

    // Check if any posts were received:
    if ( $result == null ){
        alert("There are no users", "warning");
        exit();
    }

    while ($row = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>" . $row['User_Name_First'] . " " . $row['User_Name_Last'] . "</td>";
        echo "<td>" . $row['User_Email'] . "</td>";
        $tempQuery = "SELECT * FROM User_Type where " . $row['User_Type'] . " = User_Type_ID";
        $tempRes = mysqli_query($con, $tempQuery);
        $tempRow = mysqli_fetch_array($tempRes);
        echo "<td>" . $tempRow['User_Type_Name'] . "</td >";
        echo '<td><a class="btn btn-dark" href = "user_edit.php?id=' . $row['User_ID'] . '"' . '> Edit </a ><a class="btn btn-danger ml-2" href = "#" > Delete</a ></td >';
        echo "</tr>";

    }

}

function alert($message, $category){

    $html = '<div class="alert alert-'.$category.'" role="alert">'.$message.'</div>';
    echo $html;

}










// Populate the post table
function populate_post_table(){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    // HTML template:
    $table_start = '
                            <table class="table table-striped">
                            
                                <thead>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Date created</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                
                                <tbody>';
    $table_row_start = '<tr>';
    $table_col_start = '<td>';
    $table_col_end = '</td>';
    $table_row_end = '</tr>';
    $table_end = '
                                </tbody>
                            </table>';

    // Predefined queries:


    // Create SQL query i accordance with user type:
    if ( $user_type <= 2 ) {
        $sql = "SELECT * FROM Post ORDER BY Post_Date_Created DESC";
    } else {

        $sql = "SELECT * FROM Post WHERE Post_Author = " . $user_id . "AND Post_Private = 0 ORDER BY Post_Date_Created DESC";
    }

    // Get user data:
    $data_user = mysqli_query($con, $sql);

    // Check if any posts were received:
    if ( $data_user == null ){
        alert("You have no posts", "warning");
        exit();
    }

    // Populate table:
    echo $table_start;

    while ( $row = mysqli_fetch_array($data_user) ) {

        $post_id = $row['Post_ID'];
        $post_title = $row['Post_Title'];
        $post_author_id = $row['Post_Author'];

        $post_author_query = mysqli_query($con, "SELECT User_Name_First FROM User_Data WHERE User_ID = " . $post_author_id);
        while ( $row_author = mysqli_fetch_array( $post_author_query ) ){
            $post_author = $row_author['User_Name_First'];
        }
        $post_created = $row['Post_Date_Created'];
        $post_category_id = $row['Post_Category'];
        $row_category_id = mysqli_query($con, "SELECT Category_Name FROM Categories WHERE Category_ID = " . $post_category_id);
        while ( $row_category = mysqli_fetch_array( $row_category_id ) ){
            $post_category = $row_category['Category_Name'];
        }

        echo $table_row_start;

        // Post title:
        echo $table_col_start;
        echo $post_title;
        echo $table_col_end;

        // Post author:
        echo $table_col_start;
        echo $post_author;
        echo $table_col_end;

        // Post category:
        echo $table_col_start;
        echo $post_category;
        echo $table_col_end;

        // Post date created:
        echo $table_col_start;
        echo $post_created;
        echo $table_col_end;

        // Post action:
        echo $table_col_start;
        echo '<a class="btn btn-secondary" href="post_edit.php?id='.$post_id.'">Edit</a>';
        echo $table_col_end;

        echo $table_row_end;

    }

    echo $table_end;

}











// Populate the post table
function populate_user_table(){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $session_user_id = $_SESSION['user_id'];
    $session_user_type = $_SESSION['user_type'];

    // HTML template:
    $table_start = '
                            <table class="table table-striped">
                            
                                <thead>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">User type</th>
                                    <th scope="col">Action</th>
                                </thead>
                                
                                <tbody>';
    $table_row_start = '<tr>';
    $table_col_start = '<td>';
    $table_col_end = '</td>';
    $table_row_end = '</tr>';
    $table_end = '
                                </tbody>
                            </table>';


    // Create SQL query i accordance with user type:
    if ( $session_user_type <= 2 ) {
        // Only Root and Administrator users can see Root users.
        $sql = "SELECT * FROM User_Data ORDER BY User_ID DESC";
    } else {
        // If user is Moderator or less, they cannot see Root users.
        $sql = "SELECT * FROM User_Data WHERE User_Type > 1 ORDER BY User_ID DESC";
    }

    // Get user data:
    $data_user = mysqli_query($con, $sql);

    // Check if any posts were received:
    if ( $data_user == null ){
        alert("There are no users.", "warning");
        exit();
    }

    // Populate table:
    echo $table_start;

    while ( $row = mysqli_fetch_array($data_user) ) {

        // The listed user's ID:
        $user_id = $row['User_ID'];

        // The listed user's full name:
        $user_name = $row['User_Name_First'] . ' ' . $row['User_Name_Last'];

        // The listed user's company affiliation:
        $user_company_id = $row['User_Company'];
        $user_company_query = mysqli_query($con, 'SELECT Company_Name FROM Company WHERE Company_ID = ' . $user_company_id);
        while ( $user_company_row = mysqli_fetch_array( $user_company_query ) ){
            $user_company = $user_company_row['Company_Name'];
        }

        // The listed user's email:
        $user_email = $row['User_Email'];

        // The listed user's phone number:
        $user_phone = $row['User_Phone'];

        // The listed user's access level:
        $user_type_id = $row['User_Type'];
        $user_type_query = mysqli_query($con, 'SELECT User_Type_Name FROM User_Type WHERE User_Type_ID = ' . $user_type_id);
        while ( $user_type_row = mysqli_fetch_array( $user_type_query ) ){
            $user_type = $user_type_row['User_Type_Name'];
        }

        echo $table_row_start;

        // User name:
        echo $table_col_start;
        echo $user_name;
        echo $table_col_end;

        // User company:
        echo $table_col_start;
        echo $user_company;
        echo $table_col_end;

        // User email:
        echo $table_col_start;
        echo $user_email;
        echo $table_col_end;

        // User phone:
        echo $table_col_start;
        echo $user_phone;
        echo $table_col_end;

        // User type:
        echo $table_col_start;
        echo $user_type;
        echo $table_col_end;

        // Action:
        echo $table_col_start;

        // Root can edit and delete all except other Root:
        if ( $session_user_type == 1 && $user_type > 1 ) {
            echo '<a class="btn btn-secondary" href="user_edit.php?id='.$user_id.'">Edit</a>';
            echo '<a class="btn btn-error" href="user_edit.php?id='.$user_id.'">Delete</a>';
        } elseif ( $session_user_type == 1 && $user_type < 2 ) {
            echo '<a class="btn btn-secondary" href="user_edit.php?id='.$user_id.'">Edit</a>';
        }

        // Administrators can edit and delete all except Root:
        if ( $session_user_type == 2 && $user_type > 1 ) {
            echo '<a class="btn btn-secondary" href="user_edit.php?id='.$user_id.'">Edit</a>';
            echo '<a class="btn btn-error" href="user_edit.php?id='.$user_id.'">Delete</a>';
        } elseif ( $session_user_type == 2 && $user_type < 2 ) {
            echo '<span class="badge badge-secondary">Restricted</span>';
        }

        // Moderators can edit own user only:
        if ( $session_user_type == 3 && $session_user_id == $user_id ) {
            echo '<a class="btn btn-secondary" href="user_edit.php?id='.$user_id.'">Edit</a>';
        } elseif ( $session_user_type == 3 && $session_user_id !== $user_id ) {
            echo '<span class="badge badge-secondary">Restricted</span>';
        }

        // Users can edit own user only:
        if ( $session_user_type == 4 ) {
            echo '<span class="badge badge-secondary">Restricted</span>';
        }

        echo $table_col_end;

        echo $table_row_end;

    }

    echo $table_end;

}
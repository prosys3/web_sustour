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
function populate_post_table($number_of_rows, $order_by, $asc_desc){

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
                                    <th scope="col">Operation</th>
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

        if ( isset($number_of_rows) && $number_of_rows > 0 ) {
            $sql = "SELECT * FROM Post ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM Post ORDER BY ".$order_by." ".$asc_desc;
        }

    } else {

        if ( isset($number_of_rows) && $number_of_rows > 0 ) {
            $sql = "SELECT * FROM Post WHERE Post_Author = " . $user_id . "AND Post_Private = 0 ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM Post WHERE Post_Author = " . $user_id . "AND Post_Private = 0 ORDER BY ".$order_by." ".$asc_desc;
        }

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

        $post_author_query = mysqli_query($con, "SELECT CONCAT(User_Name_First, ' ', User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = " . $post_author_id);
        while ( $row_author = mysqli_fetch_array( $post_author_query ) ){
            $post_author = $row_author['User_Name'];
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
        echo '<a class="btn btn-success" href="post_edit.php?id='.$post_id.'">Edit</a>';
        echo $table_col_end;

        echo $table_row_end;

    }

    echo $table_end;

}











// Populate the post table
function populate_user_table($number_of_rows, $order_by, $asc_desc){

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
                                    <th scope="col">Operation</th>
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
        if ( isset($number_of_rows) && $number_of_rows > 0 ){
            $sql = "SELECT * FROM User_Data ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM User_Data ORDER BY ".$order_by." ".$asc_desc;
        }
    } else {
        // If user is Moderator or less, they cannot see Root users.
        if ( isset($number_of_rows) && $number_of_rows > 0 ){
            $sql = "SELECT * FROM User_Data WHERE User_Type > 1 ORDER BY".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM User_Data WHERE User_Type > 1 ORDER BY".$order_by." ".$asc_desc;
        }
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
            echo '<a class="btn btn-success" href="user_edit.php?id='.$user_id.'">Edit</a>';
            echo '<a class="btn btn-error" href="user_edit.php?id='.$user_id.'">Delete</a>';
        } elseif ( $session_user_type == 1 && $user_type < 2 ) {
            echo '<a class="btn btn-secondary" href="user_edit.php?id='.$user_id.'">Edit</a>';
        }

        // Administrators can edit and delete all except Root:
        if ( $session_user_type == 2 && $user_type > 1 ) {
            echo '<a class="btn btn-success" href="user_edit.php?id='.$user_id.'">Edit</a>';
            echo '<a class="btn btn-error" href="user_edit.php?id='.$user_id.'">Delete</a>';
        } elseif ( $session_user_type == 2 && $user_type < 2 ) {
            echo '<span class="badge badge-secondary">Restricted</span>';
        }

        // Moderators can edit own user only:
        if ( $session_user_type == 3 && $session_user_id == $user_id ) {
            echo '<a class="btn btn-success" href="user_edit.php?id='.$user_id.'">Edit</a>';
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










// Populate the post table
function populate_file_table($number_of_rows, $order_by, $asc_desc){


    global $con;
    global $_SESSION;




    // Preliminary data:
    $session_user_id = $_SESSION['user_id'];
    $session_user_type = $_SESSION['user_type'];




    // HTML template:
    $table_start = '
                            <table class="table table-striped">
                            
                                <thead>
                                    <th scope="col">File name</th>
                                    <th scope="col">Uploaded by</th>
                                    <th scope="col">Uploaded</th>
                                    <th scope="col">File type</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Operation</th>
                                </thead>
                                
                                <tbody>';
    $table_row_start = '<tr>';
    $table_col_start = '<td>';
    $table_col_end = '</td>';
    $table_row_end = '</tr>';
    $table_end = '
                                </tbody>
                            </table>';




    // Create SQL query in accordance with user type:
    if ( $session_user_type < 4 ) {
        // Only moderators and above can see this table.
        if ( isset($number_of_rows) && $number_of_rows > 0 ){
            $sql = "SELECT * FROM File ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM File ORDER BY ".$order_by." ".$asc_desc;
        }
    } else {
        // Users cannot see this table.
        alert("There are no files for you to see.", "warning");
        exit();
    }




    // Get file data:
    $data_files = mysqli_query($con, $sql);




    // Check if any files exist:
    if ( $data_files == null ){
        alert("There are no files for you to see.", "warning");
        exit();
    }




    // Start table:
    echo $table_start;




    while ( $row = mysqli_fetch_array($data_files) ) {

        // === Getting the data from DB ===

            // The listed file's ID:
            $file_id = $row['File_ID'];


            // The listed user's full name:
            $file_name = $row['File_Name'];


            // The listed file's author:
            $file_author_id = $row['File_Author'];
            $file_author_query = mysqli_query($con, 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = ' . $file_author_id);
            while ( $file_author_row = mysqli_fetch_array( $file_author_query ) ){
                $file_author = $file_author_row['User_Name'];
            }


            // The listed file's upload date:
            $file_date = $row['File_Uploaded'];


            // The listed file's URL:
            $file_URL = $row['File_URL'];


            // The listed file's category:
            $file_category_id = $row['File_Category'];
            $file_category_query = mysqli_query($con, 'SELECT Category_Name FROM Categories WHERE Category_ID = ' . $file_category_id);
            while ( $file_category_row = mysqli_fetch_array( $file_category_query ) ){
                $file_category = $file_category_row['Category_Name'];
            }


            // The listed file's file type:
            $file_type_id = $row['File_Type'];
            $file_type_query = mysqli_query($con, 'SELECT File_Type_Name FROM File_Type WHERE File_Type_ID = ' . $file_type_id);
            while ( $file_type_row = mysqli_fetch_array( $file_type_query ) ){
                $file_type = $file_type_row['File_Type_Name'];
            }




        // === Populating the table rows ===

            // Table row start:
            echo $table_row_start;


            // File name:
            echo $table_col_start;
            echo $file_name;
            echo $table_col_end;


            // File author:
            echo $table_col_start;
            echo $file_author;
            echo $table_col_end;


            // File upload date:
            echo $table_col_start;
            echo $file_date;
            echo $table_col_end;


            // File Type:
            echo $table_col_start;
            echo $file_type;
            echo $table_col_end;


            // File category:
            echo $table_col_start;
            echo $file_category;
            echo $table_col_end;


            // Operation:
            echo $table_col_start;
            // Root and Administrator can CRUD all files:
            if ( $session_user_type < 3 ) {

                echo '<a class="btn btn-primary" href="'.$file_URL.'">Download</a>';
                echo '<a class="btn btn-danger ml-2" href="#">Delete</a>';

            }
            // Moderators can CRUD own files only:
            if ( $session_user_type == 3 && $session_user_id == $file_author_id ) {

                echo '<a class="btn btn-primary" href="'.$file_URL.'">Download</a>';
                echo '<a class="btn btn-danger ml-2" href="#">Delete</a>';

            } elseif ( $session_user_type == 3 && $session_user_id !== $file_author_id ) {

                echo '<span class="badge badge-secondary">Restricted</span>';

            }
            // Users can edit own user only:
            if ( $session_user_type == 4 ) {
                echo '<span class="badge badge-secondary">Restricted</span>';
            }
            echo $table_col_end;


            // Table row end:
            echo $table_row_end;

    }




    // End table:
    echo $table_end;

}
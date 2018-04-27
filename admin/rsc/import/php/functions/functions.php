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

        case "activities": $input = "Activities_ID) FROM Activities";
        break;

        case "event": $input = "Event_ID) FROM Event";
        break;

        case "category": $input = "Category_ID) FROM Category";
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






function alert($message, $category){

    $html = '<div class="alert alert-'.$category.'" role="alert">'.$message.'</div>';
    echo $html;

}










// Populate the post table
function populate_post_table($number_of_rows, $order_by, $asc_desc){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $current_user_id = $_SESSION['user_id'];
    $current_user = $_SESSION['user_type'];

    // Access level:
    $root   = 1;
    $admin  = 2;
    $mod    = 3;
    $user   = 4;

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


    // Create SQL query i accordance with user type:
    if ( $current_user == $root || $current_user == $admin || $current_user == $mod ) {

        $access_granted = true;

        if ( isset($number_of_rows) && $number_of_rows > 0 ) {
            $sql = "SELECT * FROM Post ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM Post ORDER BY ".$order_by." ".$asc_desc;
        }

    } else {

        $access_granted = false;

    }

    // Get user data:
    $result = mysqli_query($con, $sql);

    // Check if any posts were received:
    if ( $result->num_rows > 0 ){

        // Populate table:
        echo $table_start;

        while ( $row = mysqli_fetch_array($result) ) {

            // Get primary data:
            $post_id = $row['Post_ID'];
            $post_title = $row['Post_Title'];
            $post_author_id = $row['Post_Author'];
            $post_created = $row['Post_Date_Created'];

            // Get secondary data (Author name, full):
            $post_author_query = mysqli_query($con, "SELECT CONCAT(User_Name_First, ' ', User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = ".$post_author_id);
            while ( $row_author = mysqli_fetch_array( $post_author_query ) ){
                $post_author = $row_author['User_Name'];
            }

            // Get secondary data (Category name:)
            $post_category_id = $row['Post_Category'];
            $row_category_id = mysqli_query($con, "SELECT Category_Name FROM Category WHERE Category_ID = ".$post_category_id);
            while ( $row_category = mysqli_fetch_array( $row_category_id ) ){
                $post_category = $row_category['Category_Name'];
            }

            // Predefined action buttons:
            $btn_edit = '<a class="dropdown-item" href="post_edit.php?id='.$post_id.'"><i class="material-icons">create</i> Edit</a>';
            $btn_delete = '<div class="dropdown-divider"></div><a class="dropdown-item" href="delete.php?object=post&id='.$post_id.'"><i class="material-icons">delete</i>Delete</a>';
            $restricted = '<span class="dropdown-item badge badge-warning"><i class="material-icons">lock</i> Restricted</span>';


            // === SECURITY CHECK === :
            // Check if the post is yours:
            if ($current_user_id == $post_author_id){

                // You can do whatever to your own shit!


            // Check if post is someone else's:
            } elseif($current_user_id != $post_author_id) {

                // Root administrators:
                if ($current_user == $root){

                    // Unlimited access!


                // Administrators
                } elseif ($current_user == $admin){

                    // Unlimited access!


                // Moderators:
                } elseif ($current_user == $mod){

                    // Moderators can not edit/delete anyone else's posts:
                    $btn_edit = '';
                    $btn_delete = $restricted;


                // Regular users:
                } elseif ($current_user == $user){

                    // Regular users can not edit/delete anyone else's posts:
                    $btn_edit = '';
                    $btn_delete = $restricted;

                }

            }


            // Start the the table:
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

            // Operation:
            echo $table_col_start;

            echo '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.$btn_delete.'
                </div>
            </div>
            ';

            echo $table_col_end;

            echo $table_row_end;

        }

        echo $table_end;

    } elseif ( $result->num_rows < 1 ) {

        // No posts are available:
        alert("You have no posts", "warning");
    }

}











function populate_activities_table($number_of_rows, $order_by, $asc_desc){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $user_id = $_SESSION['user_id'];
    $current_user = $_SESSION['user_type'];

    // Access level:
    $root = 1;
    $admin = 2;
    $mod = 3;
    $user = 4;

    // HTML template:
    $table_start = '
                            <table class="table table-striped">
                            
                                <thead>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
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


    // Create SQL query i accordance with user type:
    if ( $current_user == $root || $current_user == $admin || $current_user == $mod ) {

        $access_granted = true;

        if ( isset($number_of_rows) && $number_of_rows > 0 ) {
            $sql = "SELECT * FROM Activities ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM Activities ORDER BY ".$order_by." ".$asc_desc;
        }

    } else {

        $access_granted = false;

    }

    // Get user data:
    $result = mysqli_query($con, $sql);
    // Check if any posts were received:
    if ( $result !== null ){

        // Populate table:
        echo $table_start;

        while ( $row = mysqli_fetch_array($result) ) {

            // Get primary data:
            $activities_id = $row['Activities_ID'];
            $activities_title = $row['Activities_Title'];
            $activities_author_id = $row['Activities_Author'];
            $activities_created = $row['Activities_Created'];

            // Get secondary data (Author name, full):
            $activities_author_query = mysqli_query($con, "SELECT CONCAT(User_Name_First, ' ', User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = ".$activities_author_id);
            while ( $row_author = mysqli_fetch_array( $activities_author_query ) ){
                $activities_author = $row_author['User_Name'];
            }

            // Predefined action buttons:
            $btn_edit = '<a class="dropdown-item" href="activities_edit.php?id='.$activities_id.'"><i class="material-icons">create</i> Edit</a>';
            $btn_delete = '<a class="dropdown-item" href="delete.php?object=activities&id='.$activities_id.'"><i class="material-icons">delete</i>Delete</a>';

            // Start the the table:
            echo $table_row_start;

            // Post title:
            echo $table_col_start;
            echo $activities_title;
            echo $table_col_end;

            // Post author:
            echo $table_col_start;
            echo $activities_author;
            echo $table_col_end;


            // Post date created:
            echo $table_col_start;
            echo $activities_created;
            echo $table_col_end;

            // Operation:
            echo $table_col_start;
            // Root and Administrator can CRUD all files:
            if ( $current_user == $root || $current_user == $admin ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'<div class="dropdown-divider"></div>'.$btn_delete.'
                  </div>
                </div>
                ';

            }
            // Moderators can CRUD own files only:
            if ( $current_user == $mod && $user_id == $activities_author_id ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'<div class="dropdown-divider"></div>'.$btn_delete.'
                  </div>
                </div>
                ';

            } elseif ( $current_user == $mod && $user_id !== $activities_author_id ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'
                  </div>
                </div>
                ';

            }
            // Users can edit own user only:
            if ( $current_user == $user ) {
                echo '<span class="badge badge-secondary">Restricted</span>';
            }
            echo $table_col_end;

            echo $table_row_end;

        }

        echo $table_end;

    } elseif ( $result == null ) {

        // No posts are available:
        alert("You have no posts", "warning");
    }

}











// Populate the post table
// Usage: If $number_of_rows is set to 0, all rows will be displayed.
function populate_user_table($number_of_rows = 0, $order_by, $asc_desc){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $current_user_id = $_SESSION['user_id'];
    $current_user = $_SESSION['user_type'];

    // Access levels:
    $root   = 1;
    $admin  = 2;
    $mod    = 3;
    $user   = 4;

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
    if ($current_user == $root || $current_user == $admin) {
        // Only Root and Administrator users can see Root users.
        if ($number_of_rows > 0) {
            $sql = 'SELECT * FROM User_Data ORDER BY '.$order_by .' '.$asc_desc.' LIMIT 0,'.$number_of_rows;
        } else {
            $sql = 'SELECT * FROM User_Data ORDER BY '.$order_by.' '.$asc_desc;
        }
    } else {
        // If user is Moderator or user, they cannot see Root users.
        if ($number_of_rows > 0) {
            $sql = 'SELECT * FROM User_Data WHERE User_Type > 1 ORDER BY '.$order_by.' '.$asc_desc.' LIMIT 0,'.$number_of_rows;
        } else {
            $sql = 'SELECT * FROM User_Data WHERE User_Type > 1 ORDER BY '.$order_by.' '.$asc_desc;
        }
    }

    // Get user data:
    $data_user = mysqli_query($con, $sql);

    // Check if any posts were received:
    if( $data_user !== null ){

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

            // Predefined action buttons:
            $btn_edit = '<a class="dropdown-item" href="user_edit.php?id='.$user_id.'"><i class="material-icons">create</i> Edit</a>';
            $btn_delete = '<div class="dropdown-divider"></div><a class="dropdown-item" href="delete.php?object=user&id='.$user_id.'"><i class="material-icons">delete</i>Delete</a>';
            $restricted = '<span class="dropdown-item badge badge-warning"><i class="material-icons">lock</i> Restricted</span>';


            // === SECURITY CHECK === :
            // Check if user is you:
            if ($current_user_id == $user_id){

                // You should not be able to delete yourself:
                $btn_delete = '';


            // Check if user is someone else:
            } elseif($current_user_id != $user_id) {

                // Root administrators:
                if ($current_user == $root){

                    // Unlimited access!


                // Administrators
                } elseif ($current_user == $admin){

                    // Admin cannot edit or delete root, nor other admins:
                    if ($user_type_id == $root || $user_type_id = $admin){
                        $btn_edit = '';
                        $btn_delete = $restricted;
                    }


                // Moderators:
                } elseif ($current_user == $mod){

                    // Moderators can not edit or delete anyone else:
                    $btn_edit = '';
                    $btn_delete = $restricted;


                // Regular users:
                } elseif ($current_user == $user){

                    // Regular users can not edit or delete anyone else:
                    $btn_edit = '';
                    $btn_delete = $restricted;

                }

            }

            // Predefine drop-down:
            $dropdown = '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.$btn_delete.'
                </div>
            </div>
            ';

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

            echo $dropdown;

            echo $table_col_end;

            echo $table_row_end;

        }

        echo $table_end;

    } elseif ( $data_user == null ){
        alert("There are no users.", "warning");
    }

}





function populate_public_file_table($number_of_rows, $order_by, $asc_desc){


    global $con;
    global $_SESSION;

    if( !isset($_SESSION['login']) ){

        // Preliminary data:
        $current_user = 0;
        $current_user_id = 0;

        $root = 1;
        $admin = 2;
        $mod = 3;
        $user = 4;


        // HTML template:
        $table_start = '
                            <table class="table table-striped">
                            
                                <thead class="thead-dark">
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


        // Check whether there is anything to show:
        $sql = 'SELECT * FROM File WHERE File_Private = 0';
        $result = mysqli_query($con, $sql);


        // Create SQL query in accordance with user type:
        if ($result->num_rows > 0) {

            if ($current_user == $root || $current_user == $admin || $current_user == $mod) {
                // Only moderators and above can see this table.
                if (isset($number_of_rows) && $number_of_rows > 0) {
                    $sql = "SELECT * FROM File WHERE File_Private = 0 ORDER BY " . $order_by . " " . $asc_desc . " LIMIT 0," . $number_of_rows;
                } else {
                    alert("There are no files suited for you to see.", "warning");
                }
            }


            // Get file data:
            $data_files = mysqli_query($con, $sql);


            // Start table:
            echo $table_start;


            while ($row = mysqli_fetch_array($data_files)) {

                // === Getting the data from DB ===

                // The listed file's ID:
                $file_id = $row['File_ID'];


                // The listed user's full name:
                $file_name = $row['File_Name'];


                // The listed file's author:
                $file_author_id = $row['File_Author'];
                $file_author_query = mysqli_query($con, 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = ' . $file_author_id);
                while ($file_author_row = mysqli_fetch_array($file_author_query)) {
                    $file_author = $file_author_row['User_Name'];
                }


                // The listed file's upload date:
                $file_date = $row['File_Uploaded'];


                // The listed file's URL:
                $file_URL = $row['File_URL'];


                // The listed file's category:
                $file_category_id = $row['File_Category'];
                $file_category_query = mysqli_query($con, 'SELECT Category_Name FROM Category WHERE Category_ID = ' . $file_category_id);
                while ($file_category_row = mysqli_fetch_array($file_category_query)) {
                    $file_category = $file_category_row['Category_Name'];
                }


                // The listed file's file type:
                $file_type_id = $row['File_Type'];
                $file_type_query = mysqli_query($con, 'SELECT File_Type_Extension FROM File_Type WHERE File_Type_ID = ' . $file_type_id);
                while ($file_type_row = mysqli_fetch_array($file_type_query)) {
                    $file_type = strtoupper($file_type_row['File_Type_Extension']);
                }


                // Predefined action buttons:
                $btn_download = '<a class="dropdown-item" href="' . $file_URL . '"><i class="material-icons">file_download</i> Download</a>';

                $restricted = '<span class="dropdown-item badge badge-warning"><i class="material-icons">lock</i> Restricted</span>';


                // === SECURITY CHECK === :
                // Check if the file is yours:
                if ($current_user_id == $file_author_id) {

                    // You can do whatever to your own shit!


                    // Check if file is someone else's:
                } elseif ($current_user_id != $file_author_id) {

                    // Root administrators:
                    if ($current_user == $root) {

                        // Unlimited access!


                        // Administrators:
                    } elseif ($current_user == $admin) {

                        // Unlimited access!


                        // Moderators:
                    } elseif ($current_user == $mod) {

                        // Moderators can download other's files:


                        // Regular users:
                    } elseif ($current_user == $user) {


                    }

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
                echo '
            
                <div >
                    ' . $btn_download . '
                </div>
            </div>
            ';
                echo $table_col_end;


                // Table row end:
                echo $table_row_end;

            }


            // End table:
            echo $table_end;


            // There are no files in the database:
        } elseif ($result->num_rows < 1) {

            alert('There are no files in the database.', 'info');

        }




    } else {

        // Preliminary data:
        $current_user_id = $_SESSION['user_id'];
        $current_user = $_SESSION['user_type'];
        $root = 1;
        $admin = 2;
        $mod = 3;
        $user = 4;


        // HTML template:
        $table_start = '
                            <table class="table table-striped">
                            
                                <thead class="thead-dark">
                                    <th scope="col">File name</th>
                                    <th scope="col">Uploaded by</th>
                                    <th scope="col">Uploaded</th>
                                    <th scope="col">File type</th>
                                    <th scope="col">Category</th>
                                    <th scope="co1">Private?</th>
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


        // Check whether there is anything to show:
        $sql = 'SELECT * FROM File';
        $result = mysqli_query($con, $sql);


        // Create SQL query in accordance with user type:
        if ($result->num_rows > 0) {

            if ($current_user == $root || $current_user == $admin || $current_user == $mod) {
                // Only moderators and above can see this table.
                if (isset($number_of_rows) && $number_of_rows > 0) {
                    $sql = "SELECT * FROM File ORDER BY " . $order_by . " " . $asc_desc . " LIMIT 0," . $number_of_rows;
                } else {
                    $sql = "SELECT * FROM File ORDER BY " . $order_by . " " . $asc_desc;
                }
            } else {
                // Users cannot see this table.
                alert("There are no files suited for you to see.", "warning");

            }


            // Get file data:
            $data_files = mysqli_query($con, $sql);


            // Start table:
            echo $table_start;


            while ($row = mysqli_fetch_array($data_files)) {

                // === Getting the data from DB ===

                // The listed file's ID:
                $file_id = $row['File_ID'];

                $private = $row['File_Private'];


                // The listed user's full name:
                $file_name = $row['File_Name'];


                // The listed file's author:
                $file_author_id = $row['File_Author'];
                $file_author_query = mysqli_query($con, 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = ' . $file_author_id);
                while ($file_author_row = mysqli_fetch_array($file_author_query)) {
                    $file_author = $file_author_row['User_Name'];
                }


                // The listed file's upload date:
                $file_date = $row['File_Uploaded'];



                // The listed file's URL:
                $file_URL = $row['File_URL'];


                // The listed file's category:
                $file_category_id = $row['File_Category'];
                $file_category_query = mysqli_query($con, 'SELECT Category_Name FROM Category WHERE Category_ID = ' . $file_category_id);
                while ($file_category_row = mysqli_fetch_array($file_category_query)) {
                    $file_category = $file_category_row['Category_Name'];
                }


                // The listed file's file type:
                $file_type_id = $row['File_Type'];
                $file_type_query = mysqli_query($con, 'SELECT File_Type_Extension FROM File_Type WHERE File_Type_ID = ' . $file_type_id);
                while ($file_type_row = mysqli_fetch_array($file_type_query)) {
                    $file_type = strtoupper($file_type_row['File_Type_Extension']);
                    // is the Listed File Private?

                }


                // Predefined action buttons:
                $btn_download = '<a class="dropdown-item" href="' . $file_URL . '"><i class="material-icons">file_download</i> Download</a>';



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

                // Private?
                $yes = "Yes";
                $no = "No";
                echo $table_col_start;
                if ($private == 1) {
                    echo $yes;
                } else  {
                    echo $no;
                }
                echo $table_col_end;


                // Operation:
                echo $table_col_start;
                echo '
                <div>' . $btn_download . '</div>
                ';
                echo $table_col_end;


                // Table row end:
                echo $table_row_end;

            }


            // End table:
            echo $table_end;


            // There are no files in the database:
        } elseif ($result->num_rows < 1) {

            alert('There are no files in the database.', 'info');

        }

    }

}






// Populate the post table
function populate_file_table($number_of_rows, $order_by, $asc_desc){


    global $con;
    global $_SESSION;




    // Preliminary data:
    $current_user_id    = $_SESSION['user_id'];
    $current_user       = $_SESSION['user_type'];
    $root   = 1;
    $admin  = 2;
    $mod    = 3;
    $user   = 4;




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




    // Check whether there is anything to show:
    $sql = 'SELECT * FROM File';
    $result = mysqli_query($con,$sql);




    // Create SQL query in accordance with user type:
    if ( $result->num_rows > 0 ){

        if ( $current_user == $root || $current_user == $admin || $current_user == $mod ) {
            // Only moderators and above can see this table.
            if ( isset($number_of_rows) && $number_of_rows > 0 ){
                $sql = "SELECT * FROM File ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
            } else {
                $sql = "SELECT * FROM File ORDER BY ".$order_by." ".$asc_desc;
            }
        } else {
            // Users cannot see this table.
            alert("There are no files suited for you to see.", "warning");

        }



        // Get file data:
        $data_files = mysqli_query($con, $sql);




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
            $file_category_query = mysqli_query($con, 'SELECT Category_Name FROM Category WHERE Category_ID = ' . $file_category_id);
            while ( $file_category_row = mysqli_fetch_array( $file_category_query ) ){
                $file_category = $file_category_row['Category_Name'];
            }


            // The listed file's file type:
            $file_type_id = $row['File_Type'];
            $file_type_query = mysqli_query($con, 'SELECT File_Type_Extension FROM File_Type WHERE File_Type_ID = ' . $file_type_id);
            while ( $file_type_row = mysqli_fetch_array( $file_type_query ) ){
                $file_type = strtoupper($file_type_row['File_Type_Extension']);
            }


            // Predefined action buttons:
            $btn_download = '<a class="dropdown-item" href="'.$file_URL.'"><i class="material-icons">file_download</i> Download</a>';
            $btn_delete = '<div class="dropdown-divider"></div><a class="dropdown-item" href="delete.php?object=file&id='.$file_id.'"><i class="material-icons">delete</i>Delete</a>';
            $restricted = '<span class="dropdown-item badge badge-warning"><i class="material-icons">lock</i> Restricted</span>';


            // === SECURITY CHECK === :
            // Check if the file is yours:
            if ($current_user_id == $file_author_id){

                // You can do whatever to your own shit!


            // Check if file is someone else's:
            } elseif($current_user_id != $file_author_id) {

                // Root administrators:
                if ($current_user == $root){

                    // Unlimited access!


                // Administrators:
                } elseif ($current_user == $admin){

                    // Unlimited access!


                // Moderators:
                } elseif ($current_user == $mod){

                    // Moderators can download other's files:
                    $btn_delete = '';


                    // Regular users:
                } elseif ($current_user == $user){

                    // Moderators can download other's files:
                    $btn_delete = '';

                }

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
            echo '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_download.$btn_delete.'
                </div>
            </div>
            ';
            echo $table_col_end;


            // Table row end:
            echo $table_row_end;

        }




        // End table:
        echo $table_end;




    // There are no files in the database:
    } elseif ($result->num_rows < 1) {

        alert('There are no files in the database.', 'info');

    }

}











// Populate the event table
function populate_event_table($number_of_rows, $order_by, $asc_desc){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $user_id = $_SESSION['user_id'];
    $current_user = $_SESSION['user_type'];

    // Access level:
    $root = 1;
    $admin = 2;
    $mod = 3;
    $user = 4;

    // HTML template:
    $table_start = '
                            <table class="table table-striped">
                            
                                <thead>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Author</th>
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
    if ( $current_user == $root || $current_user == $admin || $current_user == $mod ) {

        $access_granted = true;

        if ( isset($number_of_rows) && $number_of_rows > 0 ) {
            $sql = "SELECT * FROM Event ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM Event ORDER BY ".$order_by." ".$asc_desc;
        }

    } else {

        $access_granted = false;

    }

    // Get user data:
    $result = mysqli_query($con, $sql);

    // Check if any posts were received:
    if ( $result !== null ){

        // Populate table:
        echo $table_start;

        while ( $row = mysqli_fetch_array($result) ) {

            // Get primary data:
            $event_id = $row['Event_ID'];
            $event_title = $row['Event_Name'];
            $event_location = $row['Event_Location'];
            $event_author_id = $row['Event_Author'];
            $event_date = $row['Event_Date'];

            // Get secondary data (Author name, full):
            $event_author_query = mysqli_query($con, "SELECT CONCAT(User_Name_First, ' ', User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = ".$event_author_id);
            while ( $row_author = mysqli_fetch_array( $event_author_query ) ){
                $event_author = $row_author['User_Name'];
            }



            // Predefined action buttons:
            $btn_edit = '<a class="dropdown-item" href="event_edit.php?id='.$event_id.'"><i class="material-icons">create</i> Edit</a>';
            $btn_delete = '<a class="dropdown-item" href="delete.php?object=event&id='.$event_id.'"><i class="material-icons">delete</i>Delete</a>';

            // Start the the table:
            echo $table_row_start;

            // Event title:
            echo $table_col_start;
            echo $event_title;
            echo $table_col_end;

            // Event date:
            echo $table_col_start;
            echo $event_date;
            echo $table_col_end;

            // Event location:
            echo $table_col_start;
            echo $event_location;
            echo $table_col_end;

            // Event author:
            echo $table_col_start;
            echo $event_author;
            echo $table_col_end;

            // Operation:
            echo $table_col_start;
            // Root and Administrator can CRUD all files:
            if ( $current_user == $root || $current_user == $admin ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'<div class="dropdown-divider"></div>'.$btn_delete.'
                  </div>
                </div>
                ';

            }
            // Moderators can CRUD own files only:
            if ( $current_user == $mod && $user_id == $event_author_id ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'<div class="dropdown-divider"></div>'.$btn_delete.'
                  </div>
                </div>
                ';

            } elseif ( $current_user == $mod && $user_id !== $event_author_id ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'
                  </div>
                </div>
                ';

            }
            // Users can edit own user only:
            if ( $current_user == $user ) {
                echo '<span class="badge badge-secondary">Restricted</span>';
            }
            echo $table_col_end;

            echo $table_row_end;

        }

        echo $table_end;

    } elseif ( $result == null ) {

        // No posts are available:
        alert("You have no events", "warning");
    }

}










function uploader($fileref, $dir){

    global $con;

    if (isset($_POST['submit'])){

        // Initialize all file data aspects:
        $file_name          = $_FILES[$fileref]['name'];
        $file_name_temp     = $_FILES[$fileref]['tmp_name'];
        $file_size          = $_FILES[$fileref]['size'];
        $file_error         = $_FILES[$fileref]['error'];
        $file_type          = $_FILES[$fileref]['type'];


        // Get data from HTML form:
        $file_alias     = $_POST['alias'];
        $file_category  = $_POST['category'];
        if ( isset($_POST['private']) ){
            $file_private   = 1;
        } else {
            $file_private   = 0;
        }


        // Allowed file types:
        $sql = 'SELECT File_Type_Extension FROM File_Type';
        $result = mysqli_query($con, $sql);
        $temp_list = '';
        while ( $row = mysqli_fetch_array($result) ){
            $temp_list .= $row['File_Type_Extension'].',';
        }
        $file_extensions_allowed = explode(',', $temp_list);


        // Get file extension from file:
        $file_name_exploded = explode('.', $file_name);
        $file_extension = strtolower( end($file_name_exploded) );


        // Check if file extension is legal:
        if ( in_array( $file_extension, $file_extensions_allowed ) ) {

            // Check for file error:
            if ( $file_error === 0 ) {

                // Check file size:
                if ( $file_size < 67108864 ) {

                    // Generate random file name:
                    $prefix = random_int(10,99);
                    $file_name_new = uniqid($prefix, true).'.'.$file_extension;

                    // Initialize file destination:
                    $file_destination = '../'.$dir.'/'.$file_name_new;
                    $file_db_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'], 2).'/'.$dir.'/'.$file_name_new;

                    // Get file extension ID from DB:
                    $sql = 'SELECT File_Type_ID FROM File_Type WHERE File_Type_Extension = "'.$file_extension.'"';
                    $result = mysqli_query($con, $sql);
                    while ( $row = mysqli_fetch_array($result) ){
                        $file_extension_id = $row['File_Type_ID'];
                    }

                    // Try to upload the file:
                    move_uploaded_file($file_name_temp, $file_destination);
                    chmod($file_destination, 0777);

                    // Insert file data into DB:
                    $sql =  'INSERT INTO File (File_Name, File_Type, File_Size, File_Author, File_Uploaded, File_URL, File_Category, File_Private) VALUES';
                    $sql .= ' ("'.$file_alias.'",'.$file_extension_id.','.$file_size.','.$_SESSION['user_id'].',CURDATE(),"'.$file_db_url.'",'.$file_category.','.$file_private.');';
                    mysqli_query($con, $sql);

                    // Page redirect:
                    alert('File uploaded', 'success');

                    // File is too big.
                } else {

                    echo 'Your file is too big.';

                }

                // File error occurred:
            } else {

                echo 'There was an error uploading your file.';

            }

            // File is illegal:
        } else {

            echo 'Illegal file type: ' . $file_extension;

        }

    }

}










function publish_post($name_attribute, $fileref = 0, $dir = 0){


    // Set DB connection global;
    global $con;




    // Check if a post has been submitted:
    if (isset($_POST[$name_attribute])){

        // Assign post variables:
        $post_title = $_POST['title'];
        $post_text = $_POST['editor1'];
        $post_date = 'CURDATE()';
        $post_author = $_SESSION['user_id'];
        $post_category = $_POST['category'];
        if (isset($_POST['privacy'])){
            $post_privacy = 1;
        } else {
            $post_privacy = 0;
        }


        // Check if post has featured image:
        if ( $_FILES[$fileref]['error'] == UPLOAD_ERR_OK ){


            // Assign file variables:
            $file_name          = $_FILES[$fileref]['name'];
            $file_name_temp     = $_FILES[$fileref]['tmp_name'];
            $file_size          = $_FILES[$fileref]['size'];
            $file_error         = $_FILES[$fileref]['error'];
            $file_type          = $_FILES[$fileref]['type'];


            // Create an array of allowed file types:
            $allowed_files = array('jpg','jpeg','png');


            // Check if file is allowed:
            $file_name_exploded = explode('.', strtolower($file_name));
            $file_extension = end($file_name_exploded);
            if ( in_array( $file_extension, $allowed_files) ){


                // Check if file size is allowed:
                if ($file_size < 5242880){


                    // Check if image file is actually an image:
                    $img_check = exif_imagetype($file_name_temp);
                    if ($img_check !== false){


                        // Create new file name:
                        $prefix = random_int(10,99);
                        $file_name_new = uniqid($prefix, true).'.'.$file_extension;


                        // Create file URL for database:
                        $file_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'],2).'/'.$dir.'/'.$file_name_new;


                        // Assign new file name with a file destination:
                        $file_destination = '../'.$dir.'/'.$file_name_new;


                        // Upload the file:
                        move_uploaded_file($file_name_temp, $file_destination);


                        // CHMOD the file:
                        chmod($file_destination, 0777);


                        // Check if file was successfully uploaded:
                        if (is_file($file_destination)){
                            $status_file = 1;
                        } else {
                            $status_file = 0;
                        }


                    // Supposedly a fake image (malicious):
                    } else {

                        $status_file = 'fake';

                    }


                // File is too big:
                } else {

                    $status_file = 'big';

                }


            // File is illegal:
            } else {

                $status_file = 'illegal';

            }


        // Post does not have featured image:
        } else {

            $status_file = 'n';

        } // End of featured image section:




        // Generate SQL in accordance with featured image existence:
        if ($status_file === 1){

            // Has featured image:
            $sql =  'INSERT INTO Post (Post_Title,Post_Image_Featured,Post_Text,Post_Date_Created,Post_Author,Post_Category,Post_Private) VALUES ';
            $sql .= '("'.$post_title.'","'.$file_url.'","'.$post_text.'",'.$post_date.','.$post_author.','.$post_category.','.$post_privacy.');';

        } elseif ($status_file === 'n'){

            // Has not featured image:
            $sql =  'INSERT INTO Post (Post_Title,Post_Text,Post_Date_Created,Post_Author,Post_Category,Post_Private) VALUES ';
            $sql .= '("'.$post_title.'","'.$post_text.'",'.$post_date.','.$post_author.','.$post_category.','.$post_privacy.');';

        }




        // Execute SQL script, only if file status is 1 or n:
        if ($status_file === 1 || $status_file === 'n'){

            mysqli_query($con,$sql);

        }




        // Check if post was created in DB:
        $sql_exist =    'SELECT COUNT(*) AS Existence FROM Post WHERE ';
        $sql_exist .=   'Post_Title = "'.$post_title.'" AND ';
        $sql_exist .=   'Post_Text = "'.$post_text.'" AND ';
        $sql_exist .=   'Post_Author = '.$post_author.' AND ';
        $sql_exist .=   'Post_Category = '.$post_category.' AND ';
        $sql_exist .=   'Post_Private = '.$post_privacy.';';
        $result = mysqli_query($con,$sql_exist);
        $row = mysqli_fetch_array($result);
        if ( $row['Existence'] == 1 ){

            // Post was created in DB:
            $status_db = 1;

        } elseif ( $row['Existence'] == 0 || $row['Existence'] == null ){

            // Post was not created in DB:
            $status_db = 0;

        }




        // Redirect with status codes:
        header('Refresh: 0; URL=post_list.php?created=post&status='.$status_file.$status_db);


    }

}









function post_update($post_id, $submit_name, $fileref, $dir){

    // Set DB connection global;
    global $con;




    // Check if a post has been submitted:
    if (isset($_POST[$submit_name])){

        // Assign post variables:
        $post_title = $_POST['title'];
        $post_text = $_POST['editor1'];
        $post_date = 'CURDATE()';
        $post_author = $_SESSION['user_id'];
        $post_category = $_POST['category'];
        if (isset($_POST['privacy'])){
            $post_privacy = 1;
        } else {
            $post_privacy = 0;
        }


        // Check if post already has featured image:
        $hasimg_query = 'SELECT Post_Image_Featured FROM Post WHERE Post_ID = '.$post_id;
        $hasimg_result = mysqli_query($con,$hasimg_query);
        $hasimg_row = mysqli_fetch_array($hasimg_result);
        if ( strlen($hasimg_row['Post_Image_Featured']) > 2 ){
            $hasimg = true;
            $oldimg = $hasimg_row['Post_Image_Featured'];
        } else {
            $hasimg = false;
        }


        // Check if featured image has been requested:
        if ( $_FILES[$fileref]['error'] == UPLOAD_ERR_OK ){


            // Delete old featured image:
            if ($hasimg){

                // Convert url to real path:
                $oldfile = realpath($oldimg);

                // Check if file exists:
                if ( file_exists($oldfile) ){

                    unlink($oldfile);

                }

            }


            // Assign file variables:
            $file_name          = $_FILES[$fileref]['name'];
            $file_name_temp     = $_FILES[$fileref]['tmp_name'];
            $file_size          = $_FILES[$fileref]['size'];
            $file_error         = $_FILES[$fileref]['error'];
            $file_type          = $_FILES[$fileref]['type'];


            // Create an array of allowed file types:
            $allowed_files = array('jpg','jpeg','png');


            // Check if file is allowed:
            $file_name_exploded = explode('.', strtolower($file_name));
            $file_extension = end($file_name_exploded);
            if ( in_array( $file_extension, $allowed_files) ){


                // Check if file size is allowed:
                if ($file_size < 5242880){


                    // Check if image file is actually an image:
                    $img_check = exif_imagetype($file_name_temp);
                    if ($img_check !== false){


                        // Create new file name:
                        $prefix = random_int(10,99);
                        $file_name_new = uniqid($prefix, true).'.'.$file_extension;


                        // Create file URL for database:
                        $file_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'],2).'/'.$dir.'/'.$file_name_new;


                        // Assign new file name with a file destination:
                        $file_destination = '../'.$dir.'/'.$file_name_new;


                        // Upload the file:
                        move_uploaded_file($file_name_temp, $file_destination);


                        // CHMOD the file:
                        chmod($file_destination, 0777);


                        // Check if file was successfully uploaded:
                        if (is_file($file_destination)){
                            $status_file = 1;
                        } else {
                            $status_file = 0;
                        }


                        // Supposedly a fake image (malicious):
                    } else {

                        $status_file = 'fake';

                    }


                    // File is too big:
                } else {

                    $status_file = 'big';

                }


                // File is illegal:
            } else {

                $status_file = 'illegal';

            }


            // Post does not have featured image:
        } else {

            $status_file = 'n';

        } // End of featured image section:




        // Generate SQL in accordance with featured image existence:
        if ($status_file === 1){

            // Has featured image:
            $sql =      'UPDATE Post SET ';
            $sql .=     'Post_Title = "'.$post_title.'", ';
            $sql .=     'Post_Image_Featured = "'.$file_url.'", ';
            $sql .=     'Post_Text = "'.$post_text.'", ';
            $sql .=     'Post_Author = '.$post_author.', ';
            $sql .=     'Post_Category = '.$post_category.', ';
            $sql .=     'Post_Private = '.$post_privacy.' ';
            $sql .=     'WHERE Post_ID = '.$post_id.';';

            echo htmlspecialchars($sql).'<hr>';

        } elseif ($status_file === 'n'){

            // Has featured image:
            $sql =      'UPDATE Post SET ';
            $sql .=     'Post_Title = "'.$post_title.'", ';
            $sql .=     'Post_Text = "'.$post_text.'", ';
            $sql .=     'Post_Author = '.$post_author.', ';
            $sql .=     'Post_Category = '.$post_category.', ';
            $sql .=     'Post_Private = '.$post_privacy.' ';
            $sql .=     'WHERE Post_ID = '.$post_id.';';

            echo htmlspecialchars($sql).'<hr>';

        }




        // Execute SQL script, only if file status is 1 or n:
        if ($status_file === 1 || $status_file === 'n'){

            mysqli_query($con,$sql);

        }




        // Check if post was created in DB:
        $sql_exist =    'SELECT COUNT(*) AS Existence FROM Post WHERE ';
        $sql_exist .=   'Post_Title = "'.$post_title.'" AND ';
        $sql_exist .=   'Post_Text = "'.$post_text.'" AND ';
        $sql_exist .=   'Post_Author = '.$post_author.' AND ';
        $sql_exist .=   'Post_Category = '.$post_category.' AND ';
        $sql_exist .=   'Post_Private = '.$post_privacy.';';
        $result = mysqli_query($con,$sql_exist);
        $row = mysqli_fetch_array($result);
        if ( $row['Existence'] == 1 ){

            // Post was created in DB:
            $status_db = 1;

        } elseif ( $row['Existence'] == 0 || $row['Existence'] == null ){

            // Post was not created in DB:
            $status_db = 0;

        }




        // Redirect with status codes:
        header('Refresh: 0; URL=post_list.php?updated=post&status='.$status_file.$status_db);


    }

}










function populate_category_selection($name, $post_id = 0){

    global $con;

    // Echo the start of the HTML string:
    echo '<label>Category</label><select id="'.$name.'" name="'.$name.'" class="form-control">';

    // Generate SQL for getting all categories:
    $sql = "SELECT * FROM Category ORDER BY Category_ID DESC";

    // Run SQL:
    $result = mysqli_query($con, $sql);

    // Check if post id is defined:
    if ($post_id > 0){
        $catecory_query = 'SELECT Post_Category FROM Post WHERE Post_ID = '.$post_id;
        $dategory_data = mysqli_query($con,$catecory_query);
        $category_row = mysqli_fetch_array($dategory_data);
        $category_id = $category_row['Post_Category'];
    }

    // Output all rows:
    while ( $row = mysqli_fetch_array($result) ){

        if ( $row['Category_ID'] == $category_id ){
            echo '<option value="' . $row['Category_ID'] . '" selected>' . $row['Category_Name'] . '</option>';
        } else {
            echo '<option value="' . $row['Category_ID'] . '">' . $row['Category_Name'] . '</option>';
        }

    }

    // Echo the end of the HTML string:
    echo '</select>';

}










function populate_privacy_checkbox($name, $post_id = 0){

    global $con;


    // Empty variable in case of post not being private:
    $checked = '';


    // Check whether the post_id variable has been used:
    if (isset($post_id) > 0){

        // Get the post private value:
        $sql = 'SELECT Post_Private FROM Post WHERE Post_ID = '.$post_id;
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);

        if ($row['Post_Private'] == 1){

            // The post is checked as private:
            $checked = 'checked';

        }

    }


    // Echoing the HTML code for the checkbox:
    echo '
    <label class="mb-3" for="'.$name.'">
        <input id="'.$name.'" name="'.$name.'" type="checkbox" '.$checked.'>&nbsp;&nbsp;Private post
    </label>
    ';

}










function populate_featured_image($post_id){

    global $con;

    // Check whether post has a featured image:
    $img_query = 'SELECT Post_Image_Featured FROM Post WHERE Post_ID = '.$post_id;
    $img_result = mysqli_query($con,$img_query);
    $img_row = mysqli_fetch_array($img_result);

    if ( strlen($img_row['Post_Image_Featured']) > 1 ){

        // Post has featured image:
        $img_url = $img_row['Post_Image_Featured'];

        // Echo the label:
        echo '<label>Current featured image</label><br>';

        // Start:
        $html = "
            <div class=\"w-100\">
                <div class=\"border rounded\" 
                    style=\"
                        width:200px;
                        height:150px;
                        background-image:url('".$img_url."');
                        background-size:cover;\">
                </div>
            </div>
        ";

        // Echo the featured image:
        echo $html;

    }

}










function format_bytes($bytes,$precision){

    // Create array of units:
    $unit = array('KB','MB','GB');

    if ($bytes >= 1024 && $bytes < 1024000){
        $index = 0;
        $bytes /= 1024;
    } elseif ($bytes >= 1024000 && $bytes < 1024000000){
        $index = 1;
        $bytes /= 1024000;
    } elseif ($bytes >= 1024000000 && $bytes < 1024000000000){
        $index = 2;
        $bytes /= 1024000000;
    }

    return round($bytes,$precision).' '.$unit[$index];

}










function populate_user_type_selection($name, $user_id = 0){


    global $con;


    // Security wall:
    $current_user = $_SESSION['user_type'];
    $root = 1; $admin = 2; $mod = 3; $user = 4;

    if ($current_user == $root){

        // Generate SQL for getting all user types:
        $user_type_query = "SELECT * FROM User_Type ORDER BY User_Type_ID DESC";

    } elseif ($current_user == $admin){

        // Generate SQL for getting all user types:
        $user_type_query = "SELECT * FROM User_Type WHERE User_Type_ID > 1 ORDER BY User_Type_ID DESC";

    } elseif ($current_user == $mod || $current_user == $user){

        $readonly = true;

        // Generate SQL for getting user types ranging from Moderators to users:
        $user_type_query = 'SELECT * FROM User_Type WHERE User_Type_ID = '.$current_user;

    }


    // Run SQL:
    $user_type_result = mysqli_query($con, $user_type_query);



    // Check if user ID parameter is set:
    if ($user_id > 0){

        // Get user type ID:
        $user_query = 'SELECT User_Type FROM User_Data WHERE User_ID = '.$user_id;
        $user_result = mysqli_query($con,$user_query);
        $user_array = mysqli_fetch_array($user_result);
        $user_type_id = $user_array['User_Type'];

    }

    // Label is echoed regardless:
    echo '<label for="'.$name.'" class="text-muted">User type:</label>';

    // If read-only:
    if ($current_user == $mod || $current_user == $user){

        if ($readonly === true){

            $row = mysqli_fetch_array($user_type_result);
            echo '<input class="form-control" type="text" placeholder="User type" readonly value="'.$row['User_Type_Name'].'">';
            echo '<input class="form-control" type="hidden" id="'.$name.'" name="'.$name.'" placeholder="User type" readonly value="'.$row['User_Type_ID'].'">';

        }

    } else {

        // Echo the start of the HTML string:
        echo '<select id="'.$name.'" name="'.$name.'" class="form-control">';

        // Output all rows:
        while ( $row = mysqli_fetch_array($user_type_result) ){

            if ( $row['User_Type_ID'] == $user_type_id ){
                echo '<option value="' . $row['User_Type_ID'] . '" selected>' . $row['User_Type_Name'] . '</option>';
            } else {
                echo '<option value="' . $row['User_Type_ID'] . '">' . $row['User_Type_Name'] . '</option>';
            }

        }

        // Echo the end of the HTML string:
        echo '</select>';

    }


}










function populate_user_company_selection($name, $user_id = 0){


    global $con;


    // Echo the start of the HTML string:
    echo '<label for="'.$name.'" class="text-muted">User company:</label><select id="'.$name.'" name="'.$name.'" class="form-control">';


    // Generate SQL for getting all user types:
    $user_company_query = "SELECT * FROM Company ORDER BY Company_ID DESC";


    // Run SQL:
    $user_company_result = mysqli_query($con, $user_company_query);


    // Check if user ID is set:
    if ($user_id > 0){

        // Get user type ID:
        $user_query = 'SELECT User_Company FROM User_Data WHERE User_ID = '.$user_id;
        $user_result = mysqli_query($con,$user_query);
        $user_array = mysqli_fetch_array($user_result);
        $user_company_id = $user_array['User_Company'];

    }


    // Output all rows:
    while ( $row = mysqli_fetch_array($user_company_result) ){

        if ( $row['Company_ID'] == $user_company_id ){
            echo '<option value="' . $row['Company_ID'] . '" selected>' . $row['Company_Name'] . '</option>';
        } else {
            echo '<option value="' . $row['Company_ID'] . '">' . $row['Company_Name'] . '</option>';
        }

    }


    // Echo the end of the HTML string:
    echo '</select>';


}


function populate_event_company_selection($name, $event_id = 0){


    global $con;


    // Echo the start of the HTML string:
    echo '<label for="'.$name.'" class="text-muted">Event company:</label><select id="'.$name.'" name="'.$name.'" class="form-control">';


    // Generate SQL for getting all Company:
    $event_company_query = "SELECT * FROM Company ORDER BY Company_ID DESC";


    // Run SQL:
    $event_company_result = mysqli_query($con, $event_company_query);


    // Check if event ID is set:
    if ($event_id > 0){

        // Get user type ID:
        $event_query = 'SELECT Event_Company FROM Event WHERE Event_ID = '.$event_id;
        $event_result = mysqli_query($con,$event_query);
        $event_array = mysqli_fetch_array($event_result);
        $event_company_id = $event_array['Event_Company'];

    }


    // Output all rows:
    while ( $row = mysqli_fetch_array($event_company_result) ){

        if ( $row['Company_ID'] == $event_company_id ){
            echo '<option value="' . $row['Company_ID'] . '" selected>' . $row['Company_Name'] . '</option>';
        } else {
            echo '<option value="' . $row['Company_ID'] . '">' . $row['Company_Name'] . '</option>';
        }

    }


    // Echo the end of the HTML string:
    echo '</select>';


}










function user_update($user_id,$submit_name){

    global $con;

    // Check if user update has been submitted:
    if (isset($_POST[$submit_name])){


        // Get current user's level:
        $current_user_id = $_SESSION['user_id'];
        $current_user = $_SESSION['user_type'];


        // Define levels:
        $root   = 1;
        $admin  = 2;
        $mod    = 3;
        $user   = 4;


        // Get data from submit form:
        $user_fname     = $_POST['fname'];
        $user_lname     = $_POST['lname'];
        $user_password  = $_POST['password'];
        $user_type      = $_POST['type'];
        $user_email     = $_POST['email'];
        $user_phone     = $_POST['phone'];
        $user_company   = $_POST['company'];


        // Prepare password and email:
        if (strlen($_POST['password']) > 0){
            echo $user_password;
            $user_password = md5($user_password);
        }
        $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);


        // Get existing data:
        $sql_user_update =  'UPDATE User_Data SET ';
        $sql_user_update .= 'User_Name_First    = "'.$user_fname.'", ';
        $sql_user_update .= 'User_Name_Last     = "'.$user_lname.'", ';
        $sql_user_update .= 'User_Password      = "'.$user_password.'", ';
        $sql_user_update .= 'User_Type          = '.$user_type.', ';
        $sql_user_update .= 'User_Email         = "'.$user_email.'", ';
        $sql_user_update .= 'User_Phone         = "'.$user_phone.'", ';
        $sql_user_update .= 'User_Company       = '.$user_company.' ';
        $sql_user_update .= 'WHERE User_ID      = '.$user_id.';';

        echo $sql_user_update;


        // === SECURITY WALL === :

        // Check if user is you:
        if ($current_user_id == $user_id){

            // Update is allowed:
            mysqli_query($con,$sql_user_update);

        // Check if user is someone else:
        } elseif ($current_user_id != $user_id){

            // Root:
            if ($current_user == $root){

                // Update is allowed:
                mysqli_query($con,$sql_user_update);

            // Administrator:
            } elseif ($current_user == $admin){

                if ($user_type != $root){
                    // Update is allowed:
                    mysqli_query($con,$sql_user_update);
                }

            // Moderator:
            } elseif ($current_user == $mod){

                // Hell no!

            } elseif ($current_user == $user){

                // Hell no!

            }

        }


        // Check if user was successfully updated:
        if (mysqli_affected_rows($con) == 1){

            // Injection was successful:
            $status_db = 1;

        } else {

            // Injection was unsuccessful:
            $status_db = 0;

        }

//        echo ' Status: '.mysqli_affected_rows($con);

        // Redirect to
        header('Refresh: 0; URL=user_list.php?updated=user&status='.$status_db);

    }

}










// Create user:
function create_user($submit_name){

    global $con;

    if (isset($_POST[$submit_name])){

        // Build SQL statement:
        $sql_create =   'INSERT INTO User_Data (';
        $sql_create .=  'User_Name_First, ';
        $sql_create .=  'User_Name_Last, ';
        $sql_create .=  'User_Password, ';
        $sql_create .=  'User_Type, ';
        $sql_create .=  'User_Email, ';
        $sql_create .=  'User_Phone, ';
        $sql_create .=  'User_Company) ';
        $sql_create .=  'VALUES (';
        $sql_create .=  '"'.mysqli_real_escape_string($con,$_POST['fname']).'", ';
        $sql_create .=  '"'.mysqli_real_escape_string($con,$_POST['lname']).'", ';
        $sql_create .=  '"'.md5(mysqli_real_escape_string($con,$_POST['password'])).'", ';
        $sql_create .=  '"'.mysqli_real_escape_string($con,$_POST['type']).'", ';
        $sql_create .=  '"'.mysqli_real_escape_string($con,filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)).'", ';
        $sql_create .=  '"'.mysqli_real_escape_string($con,$_POST['phone']).'", ';
        $sql_create .=  '"'.mysqli_real_escape_string($con,$_POST['company']).'");';


        // Echo statement for debug purposes:
//        echo $sql_create;


        // Inject data into DB:
        mysqli_query($con,$sql_create);


        // Check if user creation was successful:
        if (mysqli_affected_rows($con) == 1){

            // Success:
            $status_db = 1;

        } elseif (mysqli_affected_rows($con) != 1){

            // Error:
            $status_db = 0;

        }


        // Redirect to user list page:
        header('Refresh: 0; URL=user_list.php?created=user&status='.$status_db);

    }
}


   
    // Update Event
    function event_update($event_id, $submit_name){

    // Set DB connection global;
    global $con;

    // Check if a event has been submitted:
    if (isset($_POST[$submit_name])){

        // Assign event variables:
        $event_title = $_POST['title'];
        $event_text = $_POST['eventtext'];
        $event_date = $_POST['date'];
        $event_start = $_POST['starttime'];
        $event_end = $_POST['endtime'];
        $event_loc = $_POST['location'];
        $event_company = $_POST['company'];
       



            $sql =      'UPDATE Event SET ';
            $sql .=     'Event_Name = "'.$event_title.'", ';
            $sql .=     'Event_Text = "'.$event_text.'", ';
            $sql .=     'Event_Date = "'.$event_date.'", ';
            $sql .=     'Event_Start = "'.$event_start.'", ';
            $sql .=     'Event_End = "'.$event_end.'", ';
            $sql .=     'Event_Location = "'.$event_loc.'", ';
            $sql .=     'Event_Company = '.$event_company.' ';
            $sql .=     'WHERE Event_ID = '.$event_id.';';

            mysqli_query($con,$sql);



        // Check if event was created in DB:
        $sql_exist =    'SELECT COUNT(*) AS Existence FROM Event WHERE ';
        $sql_exist .=   'Event_Name = "'.$event_title.'" AND ';
        $sql_exist .=   'Event_Text = "'.$event_text.'" AND ';
        $sql_exist .=   'Event_Date = "'.$event_date.'" AND ';
        $sql_exist .=   'Event_Start = "'.$event_start.'" AND ';
        $sql_exist .=   'Event_End = "'.$event_end.'" AND ';
        $sql_exist .=   'Event_Location = "'.$event_loc.'" AND ';
        $sql_exist .=   'Event_Company = "'.$event_company.'";';
        $result = mysqli_query($con,$sql_exist);
        $row = mysqli_fetch_array($result);
        if ( $row['Existence'] == 1 ){

            // event was created in DB:
            $status_db = 1;

        } elseif ( $row['Existence'] == 0 || $row['Existence'] == null ){

            // event was not created in DB:
            $status_db = 0;

        }


       

        // Redirect with status codes:
        header('Refresh: 3; URL=event_list.php?updated=event&status='.$status_db);


    }

}

function publish_event($name_attribute)
{


    // Set DB connection global;
    global $con;


    // Check if a event has been submitted:
    if (isset($_POST[$name_attribute])) {

        // Assign event variables:
        $event_title = $_POST['title'];
        $event_text = $_POST['eventtext'];
        $event_date = $_POST['date'];
        $event_start = $_POST['starttime'];
        $event_end = $_POST['endtime'];
        $event_loc = $_POST['location'];
        $event_company = $_POST['company'];
        $event_author = $_SESSION['user_id'];


        $sql = 'INSERT INTO Event (Event_Name, Event_Text, Event_Date, 
                        Event_Start, Event_End, Event_Location, Event_Company, Event_Author)
                        VALUES ';
        $sql .= '("' . $event_title . '", "';
        $sql .= $event_text . '", "';
        $sql .= $event_date . '", "';
        $sql .= $event_start . '", "';
        $sql .= $event_end . '", "';
        $sql .= $event_loc . '", ';
        $sql .= $event_company . ', ';
        $sql .= $event_author . ');';
        mysqli_query($con, $sql);


        // Check if event was created in DB:
        $sql_exist = 'SELECT COUNT(*) AS Existence FROM Event WHERE ';
        $sql_exist .= 'Event_Name = "' . $event_title . '" AND ';
        $sql_exist .= 'Event_Text = "' . $event_text . '" AND ';
        $sql_exist .= 'Event_Date = "' . $event_date . '" AND ';
        $sql_exist .= 'Event_Start = "' . $event_start . '" AND ';
        $sql_exist .= 'Event_End = "' . $event_end . '" AND ';
        $sql_exist .= 'Event_Location = "' . $event_loc . '" AND ';
        $sql_exist .= 'Event_Company = "' . $event_company . '";';
        $result = mysqli_query($con, $sql_exist);
        $row = mysqli_fetch_array($result);
        if ($row['Existence'] == 1) {

            // event was created in DB:
            $status_db = 1;

        } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

            // event was not created in DB:
            $status_db = 0;

        }

       

        // Redirect with status codes:
        header('Refresh: 0; URL=event_list.php?created=event&status=' . $status_db);


    }
}


    function publish_activities($activities_name) {


        // Set DB connection global;
        global $con;


        // Check if a event has been submitted:
        if (isset($_POST[$activities_name])) {

            // Assign Activity variables:
            $activities_title = $_POST['title'];
            $activities_text = $_POST['activitiestext'];
            $activities_author = $_SESSION['user_id'];


            $sql =      'INSERT INTO Activities (Activities_Title, Activities_Text, Activities_Created, 
                        Activities_Author)
                        VALUES ';
            $sql .=     '("'.$activities_title.'", "';
            $sql .=     $activities_text.'", ';
            $sql .=     'CURDATE(), ';
            $sql .=     ''.$activities_author.')';


            mysqli_query($con,$sql);




            // Check if event was created in DB:
            $sql_exist = 'SELECT COUNT(*) AS Existence FROM Activities WHERE ';
            $sql_exist .= 'Activities_Title = "' . $activities_title . '" AND ';
            $sql_exist .= 'Activities_Text = "' . $activities_text . '" AND ';
            $sql_exist .= 'Activities_Author = ' . '"'.$activities_author.'"';

            $result = mysqli_query($con, $sql_exist);
            $row = mysqli_fetch_array($result);
            if ($row['Existence'] == 1) {

                // event was created in DB:
                $status_db = 1;

            } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

                // event was not created in DB:
                $status_db = 0;

            }



            // Redirect with status codes:
           header('Refresh: 0; URL=activities_list.php?created=activities&status=' . $status_db);


        }
    }

function activities_update($activities_id, $submit_name){

    // Set DB connection global;
    global $con;

    // Check if a event has been submitted:
    if (isset($_POST[$submit_name])){

        // Assign event variables:
        $activities_title = $_POST['title'];
        $activities_text = $_POST['activitiestext'];
        $activities_author = $_SESSION['user_id'];





        $sql =      'UPDATE Activities SET ';
        $sql .=     'Activities_Title = "'.$activities_title.'", ';
        $sql .=     'Activities_Text = "'.$activities_text.'", ';
        $sql .=     'Activities_Created = CURDATE(), ';
        $sql .=     'Activities_Author = "'.$activities_author.'" ';
        $sql .=     'WHERE Activities_ID = '.$activities_id.';';

        mysqli_query($con,$sql);



        // Check if event was created in DB:
        $sql_exist =    'SELECT COUNT(*) AS Existence FROM Activities WHERE ';
        $sql_exist .=   'Activities_Title = "'.$activities_title.'" AND ';
        $sql_exist .=   'Activities_Text = "'.$activities_text.'"';

        $result = mysqli_query($con,$sql_exist);
        $row = mysqli_fetch_array($result);
        if ( $row['Existence'] == 1 ){

            // event was created in DB:
            $status_db = 1;

        } elseif ( $row['Existence'] == 0 || $row['Existence'] == null ){

            // event was not created in DB:
            $status_db = 0;

        }


       

        // Redirect with status codes:
       header('Refresh: 0; URL=activities_list.php?updated=activities&status='.$status_db);


    }

}







// Populate the category table
function populate_category_table($number_of_rows, $order_by, $asc_desc){

    global $con;
    global $_SESSION;

    // Preliminary data:
    $user_id = $_SESSION['user_id'];
    $current_user = $_SESSION['user_type'];

    // Access level:
    $root = 1;
    $admin = 2;
    $mod = 3;
    $user = 4;

    // HTML template:
    $table_start = '
                            <table class="table table-striped">
                            
                                <thead>
                                    <th scope="col">Name</th>
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
    if ( $current_user == $root || $current_user == $admin || $current_user == $mod ) {

        $access_granted = true;

        if ( isset($number_of_rows) && $number_of_rows > 0 ) {
            $sql = "SELECT * FROM Category WHERE Category_ID > 1 ORDER BY ".$order_by." ".$asc_desc." LIMIT 0,".$number_of_rows;
        } else {
            $sql = "SELECT * FROM Category WHERE Category_ID > 1 ORDER BY ".$order_by." ".$asc_desc;
        }

    } else {

        $access_granted = false;

    }

    // Get user data:
    $result = mysqli_query($con, $sql);

    // Check if any posts were received:
    if ( $result !== null ){

        // Populate table:
        echo $table_start;

        while ( $row = mysqli_fetch_array($result) ) {

            // Get primary data:
            $category_id = $row['Category_ID'];
            $category_title = $row['Category_Name'];

            // Predefined action buttons:
            $btn_edit = '<a class="dropdown-item" href="category_edit.php?id='.$category_id.'"><i class="material-icons">create</i> Edit</a>';
            $btn_delete = '<a class="dropdown-item" href="delete.php?object=category&id='.$category_id.'"><i class="material-icons">delete</i>Delete</a>';

            // Start the the table:
            echo $table_row_start;

            // Category name:
            echo $table_col_start;
            echo $category_title;
            echo $table_col_end;



            // Operation:
            echo $table_col_start;
            // Root and Administrator can CRUD all files:
            if ( $current_user == $root || $current_user == $admin || $current_user == $mod ) {

                echo '
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.$btn_edit.'<div class="dropdown-divider"></div>'.$btn_delete.'
                  </div>
                </div>
                ';
            }

             // Users can edit own user only:
            if ( $current_user == $user ) {
                echo '<span class="badge badge-secondary">Restricted</span>';
            }

            echo $table_col_end;
            echo $table_row_end;
        }

        echo $table_end;

    } elseif ( $result == null ) {

        // No posts are available:
        alert("You have no categories", "warning");
    }

}

function publish_category($submit_name)
{


    // Set DB connection global;
    global $con;


    // Check if a category has been submitted:
    if (isset($_POST[$submit_name])) {

        // Assign category variables:
        $category_name = $_POST['title'];



        $sql = 'INSERT INTO Category (Category_Name)
                        VALUES ';
        $sql .= '("' . $category_name . '");';

        mysqli_query($con, $sql);


        // Check if category was created in DB:
        $sql_exist = 'SELECT COUNT(*) AS Existence FROM Category WHERE ';
        $sql_exist .= 'Category_Name = "' . $category_name . '";';
        $result = mysqli_query($con, $sql_exist);
        $row = mysqli_fetch_array($result);
        if ($row['Existence'] == 1) {

            // category was created in DB:
            $status_db = 1;

        } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

            // category was not created in DB:
            $status_db = 0;

        }



        // Redirect with status codes:
        header('Refresh: 0; URL=category_list.php?created=category&status=' . $status_db);


    }
}

 // Update Event
    function category_update($category_id, $submit_name){

    // Set DB connection global;
    global $con;

    // Check if a event has been submitted:
    if (isset($_POST[$submit_name])){

         // Assign category variables:
        $category_name = $_POST['title'];
       



            $sql =      'UPDATE Category SET ';
            $sql .=     'Category_Name = "'. $category_name.'" ';
            $sql .=     'WHERE Category_ID = '.$category_id.';';

            mysqli_query($con,$sql);



        // Check if category was created in DB:
        $sql_exist = 'SELECT COUNT(*) AS Existence FROM Category WHERE ';
        $sql_exist .= 'Category_Name = "' . $category_name . '";';
        $result = mysqli_query($con, $sql_exist);
        $row = mysqli_fetch_array($result);
        if ($row['Existence'] == 1) {

            // category was created in DB:
            $status_db = 1;

        } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

            // category was not created in DB:
            $status_db = 0;

        }


       // Redirect with status codes:
        header('Refresh: 0; URL=category_list.php?updated=category&status=' . $status_db);


    }

}
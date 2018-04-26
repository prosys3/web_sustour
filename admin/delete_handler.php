<?php


// Preliminary PHP code:
include '../dbconfig.php';
include 'rsc/import/php/functions/functions.php';


// Security - Check whether user is logged in:
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}




// Check if a delete request has been sent:
if ( isset($_POST['delete'], $_GET['object'], $_GET['id']) ){


    // Create empty status variables:
    $status_db      = '';
    $status_file    = '';


    // Check whether the request is for a file:
    if ( $_GET['object'] == 'file' ){

        // The object is a file:
        $object = $_GET['object'];

        // Get file id:
        $file_id = $_GET['id'];

        // Get file URL from DB
        $file_query = 'SELECT File_URL FROM File WHERE File_ID = '.$file_id;
        $file_result = mysqli_query($con,$file_query);
        $file_array = mysqli_fetch_array($file_result);

        // Convert file URL to file path:
        $file_name = basename($file_array['File_URL'], PHP_URL_PATH);
        $file_dir = dirname($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'],2).DIRECTORY_SEPARATOR.basename(dirname($file_array['File_URL']));
        $file_path = $file_dir.DIRECTORY_SEPARATOR.$file_name;

        // Delete file from file server:
        unlink($file_path);

        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM File WHERE File_ID = '.$file_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM File WHERE File_ID = '.$file_id;

        // Delete the following session data:




    // Check whether the request is for a post:
    } elseif ( $_GET['object'] == 'post' ){

        // The object is a post:
        $object = $_GET['object'];

        // Backup post id for later existence check:
        $post_id = $_GET['id'];

        // Check whether a post has a featured image:
        $img_query = 'SELECT Post_Image_Featured FROM Post WHERE Post_ID = '.$post_id;
        $img_result = mysqli_query($con,$img_query);
        $img_array = mysqli_fetch_array($img_result);

        if ( strlen($img_array['Post_Image_Featured']) == 0 ){

            // Post has no featured image:
            $has_image = false;

        } elseif ( strlen($img_array['Post_Image_Featured']) > 0 ){

            // Post has featured image:
            $has_image = true;

            // Convert file URL to file path:
            $file_name = basename($img_array['Post_Image_Featured'], PHP_URL_PATH);
            $file_dir = dirname($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'],2).DIRECTORY_SEPARATOR.basename(dirname($img_array['Post_Image_Featured']));
            $file_path = $file_dir.DIRECTORY_SEPARATOR.$file_name;

            // Delete featured image:
            unlink($file_path);

        }

        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM Post WHERE Post_ID = '.$post_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM Post WHERE Post_ID = '.$post_id;




    // Check whether the request is for a user:
    } elseif ( $_GET['object'] == 'user' ){

        // The object a user:
        $object = $_GET['object'];

        // Backup user ID for later existence check:
        $user_id = $_GET['id'];

        //Sets all posts, events, activities and files uploaded to default user(Deleted User)
        $sqlp            =      'SELECT * FROM Post WHERE Post_Author = ' .$user_id;
        $sqlp_res        =      mysqli_query($con,$sqlp);
        if (mysqli_num_rows($sqlp_res) > 0) {
            $sql_post        =      'UPDATE Post SET Post_Author = 1 ';
            $sql_post        .=     'WHERE Post_Author = '.$user_id.'; ';
            $result = mysqli_query($con,$sql_post);
            if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
        }

        $sqle            =      'SELECT * FROM Event WHERE Event_Author = ' .$user_id;
        $sqle_res        =      mysqli_query($con,$sqle);
        if (mysqli_num_rows($sqle_res) > 0) {
            $sql_event       =      'UPDATE Event SET Event_Author = 1 ';
            $sql_event       .=     'WHERE Event_Author = '.$user_id.'; ';
            mysqli_query($con,$sql_event);
        }


        $sqla            =      'SELECT * FROM Activities WHERE Activities_Author = ' .$user_id;
        $sqla_res        =      mysqli_query($con,$sqla);
        if (mysqli_num_rows($sqla_res) > 0) {
            $sql_activity    =      'UPDATE Activities SET Activities_Author = 1 ';
            $sql_activity    .=     'WHERE Activities_Author = '.$user_id.'; ';
            mysqli_query($con,$sql_activity);
        }

        $sqlf            =      'SELECT * FROM File WHERE File_Author = ' .$user_id;
        $sqlf_res        =      mysqli_query($con,$sqlf);
        if (mysqli_num_rows($sqlf_res) > 0) {
            $sql_file        =      'UPDATE File SET File_Author = 1 ';
            $sql_file        .=     'WHERE File_Author = '.$user_id.'; ';
            mysqli_query($con,$sql_file);
        }

        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM User_Data WHERE User_ID = '.$user_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM User_Data WHERE User_ID = '.$user_id;


     } elseif ( $_GET['object'] == 'event' ){

        // The object is a event:
        $object = $_GET['object'];

        // Backup event id for later existence check:
        $event_id = $_GET['id'];


        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM Event WHERE Event_ID = '.$event_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM Event WHERE Event_ID = '.$event_id;



     } elseif ( $_GET['object'] == 'activities' ){

        // The object is a event:
        $object = $_GET['object'];

        // Backup event id for later existence check:
        $activities_id = $_GET['id'];


        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM Activities WHERE Activities_ID = '.$activities_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM Activities WHERE Activities_ID = '.$activities_id;



    }




    // === COMMON DELETE SECTION === :




    // Run SQL for termination of objects:
    mysqli_query($con,$sql_delete);




    // For debugging:
//    echo mysqli_error($con);
//    echo '<hr>';
//    print_r(mysqli_error_list($con));
//    echo '<hr>';
//    echo mysqli_errno($con);




    // Existence check of file:
    if ($object == 'file'){

        // Check if file was deleted from file server:
        if ( !file_exists($file_path) ){

            // Success: File is gone.
            $status_file = "1";

        } elseif ( file_exists($file_path) ){

            // Error: File still exists:
            $status_file = "0";

        }

    }




    // If object is a post and has image:
    if ($object == 'post'){

        if ($has_image === true){

            // Check if file was deleted from file server:
            if ( !file_exists($file_path) ){

                // Success: File is gone.
                $status_file = "1";

            } elseif ( file_exists($file_path) ){

                // Error: File still exists:
                $status_file = "0";

            }

        }

    }




    // Check if post does not have featured image attached:
    if ($object == 'post'){

        if ($has_image === false){

            // File code is irrelevant:
            $status_file = "n";

        }

    }




    // Check if object row was deleted from database:
    if ( mysqli_affected_rows($con) == 1 ){

        // Success: Object is deleted from database:
        $status_db = "1";

    } elseif ( mysqli_affected_rows($con) != 1 ){

        // Error: Object still exist in the database:
        $status_db = "0";

    }



    // Redirect back to file list with some data:
    header('Refresh: 0; URL='.$object.'_list.php?deleted='.$object.'&status='.$status_file.$status_db);





// Delete request has not been sent:
} else {

    // Echo error alert:
    alert('Global $_POST sessions were not set.', 'danger');

}
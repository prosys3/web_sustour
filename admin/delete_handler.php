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
if ( isset($_POST['delete']) ){


    // Check whether the request is for a file:
    if ( isset($_SESSION['delete_file_id']) ){

        // The object to delete is a file:
        $object = 'file';

        // Backup file id for later existence check:
        $file_id = $_SESSION['delete_file_id'];

        // Convert file URL to file path:
        $path = $_SERVER['DOCUMENT_ROOT'].parse_url($_SESSION['delete_file_url'], PHP_URL_PATH);

        // Delete file from file server:
        unlink($path);

        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM File WHERE File_ID = '.$file_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM File WHERE File_ID = '.$file_id;

        // Delete the following session data:
        unset($_SESSION['delete_file_id']);
        unset($_SESSION['delete_file_url']);




    // Check whether the request is for a post:
    } elseif ( isset($_SESSION['delete_post_id']) ){

        // The object to delete is a post:
        $object = 'post';

        // Backup post id for later existence check:
        $post_id = $_SESSION['delete_post_id'];

        // Check whether a post has a featured image:
        $sql_featured_exist = 'SELECT Post_Image_Featured FROM Post WHERE Post_ID = '.$post_id;
        $result = mysqli_query($con,$sql_featured_exist);
        if ( mysqli_fetch_array($result) == null ){

            // Post has no featured image:
            $has_image = false;

        } elseif ( mysqli_fetch_array($result) !== null ){

            // Post has featured image:
            $has_image = true;

            // Get featured image URL:
            $row = mysqli_fetch_array($result);
            $featured_url = $row['Post_Image_Featured'];

            // Convert file URL to file path:
            $path = $_SERVER['DOCUMENT_ROOT'].parse_url($featured_url, PHP_URL_PATH);

            // Delete featured image:
            unlink($path);

        }

        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM Post WHERE File_ID = '.$post_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM Post WHERE Post_ID = '.$post_id;

        // Delete the following session data:
        unset($_SESSION['delete_post_id']);




    // Check whether the request is for a user:
    } elseif ( isset($_SESSION['delete_user_id']) ){

        // The object to delete is a user:
        $object = 'user';

        // Backup user ID for later existence check:
        $user_id = $_SESSION['delete_user_id'];

        // Generate SQL (delete):
        $sql_delete = 'DELETE FROM User_Data WHERE User_ID = '.$user_id;

        // Generate SQL (existence):
        $sql_exist = 'SELECT * FROM User_Data WHERE User_ID = '.$user_id;

        // Delete the following session data:
        unset($_SESSION['delete_user_id']);

    }




} else {

    // Echo error alert:
    alert('Global $_POST sessions were not set.', 'danger');
    exit();

}




// Run SQL termination:
mysqli_query($con,$sql_delete);




// Existence check of file:
if ( $object === 'file' || $has_image === true ){

    // Check if file was deleted from file server:
    if ( !file_exists($path) ){

        // Success: File is gone.
        $status_file = "1";

    } elseif ( file_exists($path) ){

        // Error: File still exists:
        $status_file = "0";

    }

}




// Check if post does not have featured image attached:
if ( $has_image === false ){

    // File code is irrelevant:
    $status_file = "n";

}




// Check if file was deleted from database:
$result = mysqli_query($con, $sql_exist);
if ( mysqli_fetch_array($result) == false ){

    // Success: File is deleted from database:
    $status_db = "1";

} elseif ( mysqli_fetch_array($result) == true ){

    // Error: File still exist in the database:
    $status_db = "0";

}




// Redirect back to file list with some data:
header('Refresh: 0; URL=file_list.php?deleted='.$object.'&status='.$status_file.$status_db);
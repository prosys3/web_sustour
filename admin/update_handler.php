<?php


// Preliminary PHP code:
include '../dbconfig.php';
include 'rsc/import/php/functions/functions.php';


// Security - Check whether user is logged in:
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}




// Check if there is something to create:
if (isset($_GET['object'])){


    // Check if object is post:
    if ($_GET['object'] == 'post'){

        // The object to create is a post:
        $object = 'post';

        // Get variables from url:
        $post_id = $_GET['id'];
        $submit_name = $_GET['name'];
        $fileref = $_GET['fileref'];
        $upload_dir = $_GET['dir'];

        // This function redirects automatically:
        post_update($post_id,$submit_name,$fileref,$upload_dir);

    }


    // TODO: Create handler for user:
    if ($_GET['object'] == 'user'){

        // The object is a user:
        $object = 'user';

        // Get variables from URL:
        $user_id = $_GET['id'];
        $submit_name = $_GET['name'];

        // This function redirects automatically:
        user_update($user_id,$submit_name);

    }

        // Check if object is event:
    if ($_GET['object'] == 'event'){

        // The object to create is a event:
        $object = 'event';

        // Get variables from url:
        $event_id = $_GET['id'];
        $submit_name = $_GET['name'];

        // This function redirects automatically:
        event_update($event_id,$submit_name);

    }

    if ($_GET['object'] == 'activities'){

        // The object to create is a event:
        $object = 'activities';

        // Get variables from url:
        $activities_id = $_GET['id'];
        $submit_name = $_GET['name'];

        // This function redirects automatically:
        activities_update($activities_id,$submit_name);

    }

}
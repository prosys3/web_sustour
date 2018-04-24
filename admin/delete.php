<?php

// Preliminary PHP code:
include '../dbconfig.php';
include 'rsc/import/php/functions/functions.php';

// Security - Check whether user is logged in:
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}

// HTML - Head and header:
include 'rsc/import/php/components/head_dashboard.php';
include 'rsc/import/php/components/header_dashboard.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->

<?php

    // Check incoming object is defined:
    if (isset($_GET['object'], $_GET['id'])){

        // Check the nature of the incoming object:
        if ($_GET['object'] == 'file'){

            // It is a file!
            $object = 'file';

            // Get the file id:
            $file_id = $_GET['id'];

        } elseif ($_GET['object'] == 'post'){

            // It is a post:
            $object = 'post';

            // Get the post id:
            $post_id = $_GET['id'];

        } elseif ($_GET['object'] == 'user'){

            // It is a user:
            $object = 'user';

            // Get the user id:
            $user_id = $_GET['id'];

        } elseif ($_GET['object'] == 'activities') {
            // it's an activity
            $object = 'activities';

            // get the activity id
            $activities_id = $_GET['id'];

        } elseif ($_GET['object'] == 'event'){

            // It is an event:
            $object = 'event';

            // Get the event id:
            $event_id = $_GET['id'];

        }

    }




    // If object is file:
    if ($object === 'file'){

        // Get file data from DB:
        $file_data_query        = 'SELECT * FROM File WHERE File_ID = '.$file_id;
        $file_data_result       = mysqli_query($con,$file_data_query);
        $file_data_array        = mysqli_fetch_array($file_data_result);

        // Assign primary data to variables:
        $file_name              = $file_data_array['File_Name'];
        $file_type_id           = $file_data_array['File_Type'];
        $file_size              = $file_data_array['File_Size'];
        $file_author_id         = $file_data_array['File_Author'];
        $file_date              = $file_data_array['File_Uploaded'];
        $file_url               = $file_data_array['File_Name'];
        $file_category_id       = $file_data_array['File_Category'];
        $file_private           = $file_data_array['File_Private'];

        // Get secondary data:
        $file_type_query        = 'SELECT * FROM File_Type WHERE File_Type_ID = '.$file_type_id;
        $file_author_query      = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS Name FROM User_Data WHERE User_ID = '.$file_author_id;
        $file_category_query    = 'SELECT Category_Name FROM Category WHERE Category_ID = '.$file_category_id;
        $file_type_result       = mysqli_query($con,$file_type_query);
        $file_author_result     = mysqli_query($con,$file_author_query);
        $file_category_result   = mysqli_query($con,$file_category_query);
        $file_type_array        = mysqli_fetch_array($file_type_result);
        $file_author_array      = mysqli_fetch_array($file_author_result);
        $file_category_array    = mysqli_fetch_array($file_category_result);

        // Assign secondary data to variables:
        $file_type              = '('.strtoupper($file_type_array['File_Type_Extension']).') '.$file_type_array['File_Type_Name'];
        $file_author            = $file_author_array['Name'];
        $file_category          = $file_category_array['Category_Name'];

        // Fix file privacy badge:
        if ($file_private == 1){
            $file_privacy = '<span class="badge badge-secondary"><i class="material-icons">lock</i> Private</span>';
        } elseif ($file_private == 0){
            $file_privacy = '<span class="badge badge-success">Public</span>';
        }

        // Create HTML template:
        $html_object_info = '
        
            <div class="table-responsive">
                <table class="table table-sm table-striped small text-muted table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>File name</td>
                        <td>'.$file_name.'</td>
                    </tr>
                    <tr>
                        <td>File type:</td>
                        <td>'.$file_type.'</td>
                    </tr>
                    <tr>
                        <td>File category</td>
                        <td>'.$file_category.'</td>
                    </tr>
                    <tr>
                        <td>Uploaded by</td>
                        <td>'.$file_author.'</td>
                    </tr>
                    <tr>
                        <td>Uploaded</td>
                        <td>'.$file_date.'</td>
                    </tr>
                    <tr>
                        <td>File size</td>
                        <td>'.format_bytes($file_size,2).'</td>
                    </tr>
                    <tr>
                        <td>File privacy</td>
                        <td>'.$file_privacy.'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        ';

    }




    // If object is user:
    if ($object === 'user'){}




    // If object is post:
    if ($object === 'post'){

        // Get post data from DB:
        $post_data_query = 'SELECT * FROM Post WHERE Post_ID = '.$post_id;
        $post_data_result = mysqli_query($con,$post_data_query);
        $post_data_array = mysqli_fetch_array($post_data_result);

        // Assign primary data to variables:
        $post_title = $post_data_array['Post_Title'];
        $post_text = $post_data_array['Post_Text'];
        $post_date = $post_data_array['Post_Date_Created'];
        $post_author_id = $post_data_array['Post_Author'];
        $post_category_id = $post_data_array['Post_Category'];
        $post_private = $post_data_array['Post_Private'];

        // Get secondary data from DB:
        $post_author_query = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS Name FROM User_Data WHERE User_ID = '.$post_author_id;
        $post_category_query = 'SELECT Category_Name FROM Category WHERE Category_ID = '.$post_category_id;
        $post_author_result = mysqli_query($con,$post_author_query);
        $post_category_result = mysqli_query($con,$post_category_query);
        $post_author_array = mysqli_fetch_array($post_author_result);
        $post_category_array = mysqli_fetch_array($post_category_result);

        // Assign secondary data to variables:
        $post_author = $post_author_array['Name'];
        $post_category = $post_category_array['Category_Name'];

        // Fix post privacy badge:
        if ($post_private == 1){
            $post_privacy = '<span class="badge badge-secondary"><i class="material-icons">lock</i> Private</span>';
        } elseif ($post_private == 0){
            $post_privacy = '<span class="badge badge-success">Public</span>';
        }

        // Create HTML template:
        $html_object_info = '
        
            <div class="table-responsive">
                <table class="table table-sm table-striped small text-muted table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Post title</td>
                        <td>'.$post_title.'</td>
                    </tr>
                    <tr>
                        <td>Author:</td>
                        <td>'.$post_author.'</td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td>'.$post_date.'</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>'.$post_category.'</td>
                    </tr>
                    <tr>
                        <td>Post privacy</td>
                        <td>'.$post_privacy.'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        ';

    }

    if ($object === 'activities') {

        // Get post data from DB:
        $activities_data_query = 'SELECT * FROM Activities WHERE Activities_ID = '.$activities_id;
        $activities_data_result = mysqli_query($con,$activities_data_query);
        $activities_data_array = mysqli_fetch_array($activities_data_result);

        // Assign primary data to variables:
        $activities_title = $activities_data_array['Activities_Title'];
        $activities_text = $activities_data_array['Activities_Text'];
        $activities_date = $activities_data_array['Activities_Created'];
        $activities_author_id = $activities_data_array['Activities_Author'];



        // Get secondary data from DB:
        $activities_author_query = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS Name FROM User_Data WHERE User_ID = '.$activities_author_id;
        $activities_author_result = mysqli_query($con,$activities_author_query);
        $activities_author_array = mysqli_fetch_array($activities_author_result);


        // Assign secondary data to variables:
        $activities_author = $activities_author_array['Name'];




        // Create HTML template:
        $html_object_info = '
        
            <div class="table-responsive">
                <table class="table table-sm table-striped small text-muted table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Post title</td>
                        <td>'.$activities_title.'</td>
                    </tr>
                    <tr>
                        <td>Author:</td>
                        <td>'.$activities_author.'</td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td>'.$activities_date.'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        ';
    }

    // If object is event:
    if ($object === 'event'){

    // Get event data from DB:
        $event_data_query = 'SELECT * FROM Event WHERE Event_ID = '.$event_id;
        $event_data_result = mysqli_query($con,$event_data_query);
        $event_data_array = mysqli_fetch_array($event_data_result);

        // Assign primary data to variables:
        $event_title = $event_data_array['Event_Name'];
        $event_location = $event_data_array['Event_Location'];
        $event_text = $event_data_array['Event_Text'];
        $event_date = $event_data_array['Event_Date'];
        $event_author_id = $event_data_array['Event_Author'];
        $event_company_id = $event_data_array['Event_Company'];

         // Get secondary data from DB:
        $event_author_query = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS Name FROM User_Data WHERE User_ID = '.$event_author_id;
        $event_company_query = 'SELECT Company_Name FROM Company WHERE Company_ID = '.$event_company_id;
        $event_author_result = mysqli_query($con,$event_author_query);
        $event_company_result = mysqli_query($con,$event_company_query);
        $event_author_array = mysqli_fetch_array($event_author_result);
        $event_company_array = mysqli_fetch_array($event_company_result);

        // Assign secondary data to variables:
        $event_author = $event_author_array['Name'];
        $event_company = $event_company_array['Company_Name'];

        // Create HTML template:
        $html_object_info = '

            <div class="table-responsive">
                <table class="table table-sm table-striped small text-muted table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Event name</td>
                        <td>'.$event_title.'</td>
                    </tr>
                    <tr>
                        <td>Author:</td>
                        <td>'.$event_author.'</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>'.$event_date.'</td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td>'.$event_company.'</td>
                    </tr>
                    <tr>
                        <td>Event location</td>
                        <td>'.$event_location.'</td>
                    </tr>
                </tbody>
            </table>
        </div>

        ';

    }

?>

<main>
    <section class="bg-dark py-5">

        <div class="container text-center text-light">

            <h1>Admin dashboard</h1>
            <h2><i class="material-icons">delete_forever</i> Delete <?php echo $object ?></h2>

        </div>

    </section>

    <section class="bg-light py-5">
        <div class="container">

            <div class="row">
                <div class="col-3">
                    <?php include 'rsc/import/php/components/dashboard/dashboard_nav.php' ?>
                </div>


                <div class="col-9">
                    <ul class="list-group">
                        <li class="list-group-item text-light bg-dark"><?php echo ucfirst($object) ?> information</li>
                        <li class="list-group-item">

                            <?php echo $html_object_info ?>

                            <form action="delete_handler.php" method="post" class="mt-5">
                                <input type="hidden">
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">Warning!</h4>
                                    <p>If you delete this <?php echo $object ?>, the <?php echo $object ?> will be permanently gone.</p>
                                    <hr>
                                    <button type="submit" id="delete" name="delete" class="btn btn-dark">Delete</button>
                                </div>
                            </form>

                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </section>
</main>

<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
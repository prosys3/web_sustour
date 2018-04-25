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
            $object_id = $_GET['id'];

        } elseif ($_GET['object'] == 'post'){

            // It is a post:
            $object = 'post';

            // Get the post id:
            $object_id = $_GET['id'];

        } elseif ($_GET['object'] == 'user'){

            // It is a user:
            $object = 'user';

            // Get the user id:
            $object_id = $_GET['id'];

        }

    }




    // If object is file:
    if ($object === 'file'){

        // Get file data from DB:
        $file_data_query        = 'SELECT * FROM File WHERE File_ID = '.$object_id;
        $file_data_result       = mysqli_query($con,$file_data_query);
        $file_data_array        = mysqli_fetch_array($file_data_result);


        // Fix file privacy badge:
        if ($file_data_array['File_Private'] == 1){
            $file_privacy = '<span class="badge badge-secondary"><i class="material-icons">lock</i> Private</span>';
        } elseif ($file_data_array['File_Private'] == 0){
            $file_privacy = '<span class="badge badge-success">Public</span>';
        }


        // Get secondary data (file type):
        $file_type_query        = 'SELECT * FROM File_Type WHERE File_Type_ID = '.$file_data_array['File_Type'];
        $file_type_result       = mysqli_query($con,$file_type_query);
        $file_type_array        = mysqli_fetch_array($file_type_result);


        // Get secondary data (file author):
        $file_author_query      = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS Author FROM User_Data WHERE User_ID = '.$file_data_array['File_Author'];
        $file_author_result     = mysqli_query($con,$file_author_query);
        $file_author_array      = mysqli_fetch_array($file_author_result);


        // Get secondary data (file category):
        $file_category_query    = 'SELECT Category_Name FROM Category WHERE Category_ID = '.$file_data_array['File_Category'];
        $file_category_result   = mysqli_query($con,$file_category_query);
        $file_category_array    = mysqli_fetch_array($file_category_result);


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
                        <td>'.$file_data_array['File_Name'].'</td>
                    </tr>
                    <tr>
                        <td>File type:</td>
                        <td>('.strtoupper($file_type_array['File_Type_Extension']).') '.$file_type_array['File_Type_Name'].'</td>
                    </tr>
                    <tr>
                        <td>File category</td>
                        <td>'.$file_category_array['Category_Name'].'</td>
                    </tr>
                    <tr>
                        <td>Uploaded by</td>
                        <td>'.$file_author_array['Author'].'</td>
                    </tr>
                    <tr>
                        <td>Uploaded</td>
                        <td>'.$file_data_array['File_Uploaded'].'</td>
                    </tr>
                    <tr>
                        <td>File size</td>
                        <td>'.format_bytes($file_data_array['File_Size'],2).'</td>
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
    if ($object === 'user'){


        // Get user data from DB:
        $user_data_query = 'SELECT * FROM User_Data WHERE User_ID = '.$object_id;
        $user_data_result = mysqli_query($con,$user_data_query);
        $user_data_array = mysqli_fetch_array($user_data_result);


        // Get secondary data from DB (user type):
        $user_type_query = 'SELECT User_Type_Name FROM User_Type WHERE User_Type_ID = '.$user_data_array['User_Type'];
        $user_type_result = mysqli_query($con,$user_type_query);
        $user_type_array = mysqli_fetch_array($user_type_result);


        // Get secondary data from DB (user company):
        $user_company_query = 'SELECT * FROM Company WHERE Company_ID = '.$user_data_array['User_Company'];
        $user_company_result = mysqli_query($con,$user_company_query);
        $user_company_array = mysqli_fetch_array($user_company_result);


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
                        <td>Name</td>
                        <td>'.$user_data_array['User_Name_First'].' '.$user_data_array['User_Name_Last'].'</td>
                    </tr>
                    <tr>
                        <td>Company:</td>
                        <td>('.$user_company_array['Company_Acronym'].') '.$user_company_array['Company_Name'].'</td>
                    </tr>
                    <tr>
                        <td>User type:</td>
                        <td>'.$user_type_array['User_Type_Name'].'</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>'.$user_data_array['User_Email'].'</td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td>'.$user_data_array['User_Phone'].'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        ';

    }




    // If object is post:
    if ($object === 'post'){


        // Get post data from DB:
        $post_data_query = 'SELECT * FROM Post WHERE Post_ID = '.$object_id;
        $post_data_result = mysqli_query($con,$post_data_query);
        $post_data_array = mysqli_fetch_array($post_data_result);


        // Fix post privacy badge:
        if ($post_data_array['Post_Private'] == 1){
            $post_privacy = '<span class="badge badge-secondary"><i class="material-icons">lock</i> Private</span>';
        } elseif ($post_data_array['Post_Private'] == 0){
            $post_privacy = '<span class="badge badge-success">Public</span>';
        }


        // Get secondary data from DB:
        $post_author_query = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS Author FROM User_Data WHERE User_ID = '.$post_data_array['Post_Author'];
        $post_category_query = 'SELECT Category_Name FROM Category WHERE Category_ID = '.$post_data_array['Post_Category'];
        $post_author_result = mysqli_query($con,$post_author_query);
        $post_category_result = mysqli_query($con,$post_category_query);
        $post_author_array = mysqli_fetch_array($post_author_result);
        $post_category_array = mysqli_fetch_array($post_category_result);


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
                        <td>'.$post_data_array['Post_Title'].'</td>
                    </tr>
                    <tr>
                        <td>Author:</td>
                        <td>'.$post_author_array['Author'].'</td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td>'.$post_data_array['Post_Date_Created'].'</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>'.$post_category_array['Category_Name'].'</td>
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

?>





<!-- Document start: -->
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
                    <!-- Include dashboard navigaion: -->
                    <?php include 'rsc/import/php/components/dashboard/dashboard_nav.php' ?>
                </div>


                <div class="col-9">
                    <ul class="list-group">
                        <li class="list-group-item text-light bg-dark"><?php echo ucfirst($object) ?> information</li>
                        <li class="list-group-item">

                            <!-- Object information: -->
                            <?php echo $html_object_info ?>

                            <form action="delete_handler.php?object=<?php echo $object ?>&id=<?php echo $object_id ?>" method="post" class="mt-5">
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
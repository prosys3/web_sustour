<?php

// Preliminary PHP code:
include '../dbconfig.php';
include 'rsc/import/php/functions/functions.php';

// Security - Check whether user is logged in:
if( !isset($_SESSION['login']) ){
    header("Location:../login.php")
    ;exit();
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
    if ( isset($_GET['file']) ){
        $object = "file";
    } elseif ( isset($_GET['user']) ){
        $object = "user";
    } elseif ( isset($_GET['post']) ){
        $object = "post";
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

                            <?php

                                // Get all data from selected file:
                                $sql = 'SELECT * FROM File WHERE File_ID = '.$_GET['file'];
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_array($result);

                                // Get file's primary data:
                                $file_id = $row['File_ID'];
                                $file_name = $row['File_Name'];
                                $file_date = $row['File_Uploaded'];
                                $file_author_id = $row['File_Author'];
                                $file_type_id = $row['File_Type'];
                                $file_size = $row['File_Size'];
                                $file_category_id = $row['File_Category'];
                                $file_url = $row['File_URL'];
                                if ( $row['File_Private'] == 1 ){
                                    $file_privacy = '<span class="badge badge-secondary">Private</span>';
                                } else {
                                    $file_privacy = '<span class="badge badge-success">Public</span>';
                                }
                                if ( $file_size < 1024000000 && $file_size >= 1024000 ){
                                    $file_size /= 1024000;
                                    $file_size = round($file_size,2);
                                    $file_size_measure = 'MB';
                                } elseif ( $file_size >= 1024000000 ){
                                    $file_size /= 1024000000;
                                    $file_size = round($file_size,2);
                                    $file_size_measure = 'GB';
                                } elseif ( $file_size < 1024000 ){
                                    $file_size /= 1024;
                                    $file_size = round($file_size,2);
                                    $file_size_measure = 'KB';
                                }

                                // Get file author name:
                                $sql = 'SELECT CONCAT(User_Name_First, " ", User_Name_Last) AS User_Name FROM User_Data WHERE User_ID = '.$file_author_id;
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_array($result);
                                $file_author = $row['User_Name'];

                                // Get file type:
                                $sql = 'SELECT * FROM File_Type WHERE File_Type_ID = '.$file_type_id;
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_array($result);
                                $file_type = strtoupper($row['File_Type_Extension']).' ('.$row['File_Type_Name'].')';

                                // Get file category:
                                $sql = 'SELECT Category_Name FROM Category WHERE Category_ID = '.$file_category_id;
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_array($result);
                                $file_category = $row['Category_Name'];

                                // Session persistence:
                                $_SESSION['delete_file_id'] = $file_id;
                                $_SESSION['delete_file_url'] = $file_url;


                            ?>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">File name</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_name ?></div>
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">Uploaded by</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_author ?></div>
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">Upload date</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_date ?></div>
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">Category</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_category ?></div>
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">File type</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_type ?></div>
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">File type</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_size.' '.$file_size_measure ?></div>
                            </div>

                            <div class="input-group mb-1">
                                <div class="input-group-prepend w-25 d-block">
                                    <span class="input-group-text"">Privacy</span>
                                </div>
                                <div class="form-control" aria-label="Username" aria-describedby="basic-addon1"><?php echo $file_privacy ?></div>
                            </div>

                            <form action="delete_handler.php" method="post" class="mt-5">
                                <input type="hidden">
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">Warning!</h4>
                                    <p>If you delete this file, the file will be permanently gone.</p>
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
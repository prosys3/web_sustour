<?php

    // Preliminary PHP code:
    include '../dbconfig.php';
    include 'rsc/import/php/functions/functions.php';

    // Security - Check whether user is logged in:
    if( !isset($_SESSION['login']) ){
        header("Location:../login.php")
        ;exit();
    } elseif ($_SESSION['user_type'] > 3) {
        header("Location:../index.php");
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

    // Preliminary data:
    $post_id = $_GET['id'];
    $sql = "SELECT * FROM Post WHERE Post_ID = ".$post_id;
    $result = mysqli_query($con, $sql);
    $post_row = mysqli_fetch_array($result);

    $post_title = $post_row['Post_Title'];
    $post_text  = $post_row['Post_Text'];

?>

<main>
    <style type="text/css">
        #cke_25, #cke_31, #cke_24 {
                display: none;
        }
    </style>

    <section class="bg-dark py-5">

        <div class="container text-center text-light">

            <h1>Admin dashboard</h1>

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
                        <li class="list-group-item text-light bg-dark">Post editor</li>
                        <li class="list-group-item">

                            <form method="POST" action="update_handler.php?object=post&id=<?php echo $post_id?>&name=submit&fileref=img&dir=uploads" enctype="multipart/form-data">

                                <!-- Post title: -->
                                <div class="form-group">
                                    <label>Post title</label>
                                    <input type="text" name="title" class="form-control form-text" placeholder="Page Title" value="<?php echo $post_title;?>">
                                </div>


                                <!-- Post text: -->
                                <div class="form-group mt-4">
                                    <textarea name="editor1" class="form-control" placeholder="Page Body"><?php echo $post_text;?></textarea>
                                </div>


                                <!-- Post privacy: -->
                                <div class="form-group mt-4">
                                    <?php
                                    populate_privacy_checkbox('privacy', $post_id);
                                    alert('<i class="material-icons">lock</i> A private post will only be seen by registered users.', 'secondary')
                                    ?>
                                </div>


                                <!-- Post category: -->
                                <div class="form-group mt-4">
                                    <?php populate_category_selection('category', $post_id) ?>
                                </div>


                                <!-- Post featured image: -->
                                <div class="form-group mt-4">
                                    <?php populate_featured_image($post_id) ?>
                                </div>


                                <!-- Upload featured image: -->
                                <div class="form-group mt-4">
                                    <label for="img">Choose a featured image</label><br>
                                    <input id="img" name="img" class="mb-3" type="file">
                                    <?php alert("The image must be either JPG, JPEG, or PNG, and be no more than 5 mb.", "primary") ?>
                                </div>


                                <!-- Post title: -->
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success" name="submit">Update post</button>
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
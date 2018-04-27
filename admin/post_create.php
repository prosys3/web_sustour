<?php

// Preliminary PHP code:
include '../dbconfig.php';
include 'rsc/import/php/functions/functions.php';

// Security - Check whether user is logged in:
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
} elseif ($_SESSION['user_type'] > 3) {
    header("Location:post_list.php");
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

<main>

    <section class="bg-dark py-5">

        <div class="container text-center text-light">

            <h1>Admin dashboard</h1>
            <h2>Create new post</h2>

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

                            <form method="POST" action="create_handler.php?object=post&name=submit&fileref=img&dir=uploads" enctype="multipart/form-data">


                                <!-- Post title: -->
                                <div class="form-group">
                                    <label class="text-dark">Post title</label>
                                    <input type="text" id="title" name="title" class="form-control form-text" placeholder="What's the title of your post?">
                                </div>


                                <!-- Post text: -->
                                <div class="form-group mt-4">
                                    <textarea name="editor1" class="form-control" placeholder="What's on your mind?"></textarea>
                                </div>


                                <!-- Post privacy: -->
                                <div class="form-group mt-4">
                                    <?php
                                    populate_privacy_checkbox('privacy');
                                    alert('<i class="material-icons">lock</i> A private post will only be seen by registered users.', 'secondary');
                                    ?>
                                </div>


                                <!-- Post category: -->
                                <div class="form-group mt-4">
                                    <?php populate_category_selection('category') ?>
                                </div>


                                <!-- Upload featured image: -->
                                <div class="form-group mt-4">
                                    <label for="featured-img">Choose a featured image</label><br>
                                    <input class="form-control mb-3" type="file" name="img" id="img">
                                    <?php alert('<small>Allowed files: JPG, JPEG, and PNG.<br>Max file size: 5MB.</small>', 'primary'); ?>
                                </div>


                                <!-- Publish post button: -->
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success" name="submit">Publish post</button>
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
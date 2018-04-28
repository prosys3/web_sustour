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

<main>

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
                        <li class="list-group-item text-light bg-dark">Category create</li>
                        <li class="list-group-item">

                            <form method="POST" action="create_handler.php?object=category&name=submit" enctype="multipart/form-data">

                                <!-- Event title: -->
                                <div class="form-group">
                                    <label>Category name</label>
                                    <input type="text" name="title" class="form-control form-text" placeholder="What's the name of your category?">
                                </div>
                              <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success" name="submit">Create category</button>
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
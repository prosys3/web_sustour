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
                        <li class="list-group-item text-light bg-dark">Express panel</li>
                        <li class="list-group-item">

                            <div class="row">

                                <div class="col">Edit your own user</div>
                                <div class="col">Create new user</div>

                            </div>

                        </li>
                    </ul>

                </div>
            </div>

            <ul class="list-group mt-5">
                <li class="list-group-item text-light bg-dark">All users</li>
                <li class="list-group-item">

                    <?php populate_user_table(0, "User_ID", "DESC"); ?>

                </li>
            </ul>

        </div>
    </section>
</main>

<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
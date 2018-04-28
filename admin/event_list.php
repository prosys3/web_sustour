<?php

// Preliminary PHP code:
include '../dbconfig.php';
include 'rsc/import/php/functions/functions.php';

// Security - Check whether user is logged in:
if( !isset($_SESSION['login']) ){
    header("Location:../login.php")
    ;exit();
} elseif ( $_SESSION['user_type'] > 3 ) {
    header("Location:../index.php")
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

                                <div class="col"><a href="event_create.php" class="btn btn-primary"><i class="material-icons">create</i> Create new event</a></div>
                                <div class="col"><a href="../events.php" class="btn btn-secondary"><i class="material-icons">chrome_reader_mode</i> View event page</a></div>

                            </div>

                        </li>
                    </ul>

                </div>
            </div>

            <ul class="list-group mt-5">
                <li class="list-group-item text-light bg-dark">All events</li>
                <li class="list-group-item">

                    <?php populate_event_table(0, "Event_Date", "ASC"); ?>

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
<?php

include 'rsc/import/php/components/modals/dialog_updated.php';
include 'rsc/import/php/components/modals/dialog_created.php';
include 'rsc/import/php/components/modals/dialog_deleted.php';

?>

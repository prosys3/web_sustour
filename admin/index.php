<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit();
}
?>
<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

<?php require ('rsc/import/php/functions/functions.php');  ?>
<?php include '../dbconfig.php' ?>

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

                                <div class="col">test</div>
                                <div class="col">test</div>

                            </div>

                        </li>
                    </ul>

                </div>
            </div>

            <ul class="list-group mt-5">
                <li class="list-group-item text-light bg-dark">Latest users</li>
                <li class="list-group-item">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">User type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php fillUserList(); ?>

                        </tbody>
                    </table>

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
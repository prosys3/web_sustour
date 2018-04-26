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

// Preliminary data:
$activities_id = $_GET['id'];
$sql = "SELECT * FROM Activities WHERE Activities_ID = ".$activities_id;
$result = mysqli_query($con, $sql);
$activities_row = mysqli_fetch_array($result);

$activities_title = $activities_row['Activities_Title'];
$activities_text  = $activities_row['Activities_Text'];
$activities_created  = $activities_row['Activities_Created'];
$activities_author  = $activities_row['Activities_Author'];


?>

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
                            <li class="list-group-item text-light bg-dark">Activity editor</li>
                            <li class="list-group-item">

                                <form method="POST" action="update_handler.php?object=activities&id=<?php echo $activities_id?>&name=submit" enctype="multipart/form-data">

                                    <!-- Event title: -->
                                    <div class="form-group">
                                        <label>Activity Title</label>
                                        <input type="text" name="title" class="form-control form-text" placeholder="Page Title" value="<?php echo $activities_title;?>">
                                    </div>



                                    <!-- Post text: -->
                                    <div class="form-group mt-4">
                                        <label>Activity description</label>
                                        <textarea name="eventtext" class="form-control" placeholder="Page Body" style="height: 200px;"><?php echo $activities_text;?></textarea>
                                    </div>


                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success" name="submit">Update event</button>
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
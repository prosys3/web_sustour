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
    $category_id = $_GET['id'];
    $sql = "SELECT * FROM Category WHERE Category_ID = ".$category_id;
    $result = mysqli_query($con, $sql);
    $event_row = mysqli_fetch_array($result);

    $category_title = $event_row['Category_Name'];

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
                        <li class="list-group-item text-light bg-dark">Category editor</li>
                        <li class="list-group-item">

                            <form method="POST" action="update_handler.php?object=category&id=<?php echo $category_id?>&name=submit" enctype="multipart/form-data">

                                <!-- Category title: -->
                                <div class="form-group">
                                    <label>Category name</label>
                                    <input type="text" name="title" class="form-control form-text" placeholder="Page Title" value="<?php echo $category_title;?>">
                                </div>                                                                                                                            
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success" name="submit">Update category</button>
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
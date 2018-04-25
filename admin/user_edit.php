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

// Get primary data:
$user_id = $_GET['id'];
$user_query = 'SELECT * FROM User_Data WHERE User_ID = '.$user_id;
$user_result = mysqli_query($con,$user_query);
$user_array = mysqli_fetch_array($user_result);

// Initialize primary data:
$user_name_first = $user_array['User_Name_First'];
$user_name_last = $user_array['User_Name_Last'];
$user_type_id = $user_array['User_Type'];
$user_email = $user_array['User_Email'];
$user_phone = $user_array['User_Phone'];
$user_company_id = $user_array['User_Company'];

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
                        <li class="list-group-item text-light bg-dark">User editor</li>
                        <li class="list-group-item">

                            <form method="POST" action="update_handler.php?object=user&id=<?php echo $user_id?>&name=submit" enctype="multipart/form-data">


                                <!-- User first name: -->
                                <div class="form-group">
                                    <label for="fname" class="text-muted">First name:</label>
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First name" required value="<?php echo $user_name_first?>">
                                </div>


                                <!-- User last name: -->
                                <div class="form-group">
                                    <label for="lname" class="text-muted">Last name:</label>
                                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last name" required value="<?php echo $user_name_last?>">
                                </div>


                                <!-- User email: -->
                                <div class="form-group">
                                    <label for="email" class="text-muted">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required value="<?php echo $user_email?>">
                                </div>


                                <!-- User phone: -->
                                <div class="form-group">
                                    <label for="phone" class="text-muted">Phone:</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone number" required value="<?php echo $user_phone?>">
                                </div>


                                <!-- User password: -->
                                <div class="form-group">
                                    <label for="password" class="text-muted">Password:</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password">
                                </div>


                                <!-- User type: -->
                                <div class="form-group">
                                    <?php populate_user_type_selection('type',$user_id) ?>
                                </div>


                                <!-- User Company: -->
                                <div class="form-group">
                                    <?php populate_user_company_selection('company',$user_id) ?>
                                </div>


                                <!-- Submit updated user: -->
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
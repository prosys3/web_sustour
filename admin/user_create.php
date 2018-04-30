<?php

    // Preliminary PHP code:
    include '../dbconfig.php';
    include 'rsc/import/php/functions/functions.php';

    // Security - Check whether user is logged in:
    if( !isset($_SESSION['login']) ){
        header("Location:../login.php")
        ;exit();
    } elseif ($_SESSION['user_type'] > 2) {
        header("Location:user_list.php");
        ;exit();
}
?>
<?php
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
                        <li class="list-group-item text-light bg-dark">User create</li>
                        <li class="list-group-item">

            <form action="create_handler.php?object=user&name=submit-user" method="post">

                <!-- First name: -->
                <div class="form-group">
                    <label for="inputNameFirst">First name:</label>
                    <input id="inputNameFirst" name="fname" class="form-control" type="text" placeholder="First name" autofocus required>
                </div>

                <!-- Last name: -->
                <div class="form-group">
                    <label for="inputNameLast">First name:</label>
                    <input id="inputNameLast" name="lname" class="form-control" type="text" placeholder="Last name" required>
                </div>

                <!-- Email address: -->
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input id="inputEmail" name="email" class="form-control" type="email" placeholder="Email address" required>
                </div>

                <!-- Password: -->
                <div class="form-group">
                    <label for="inputPassword">Password:</label>
                    <input id="inputPassword" name="password" class="form-control" type="password" placeholder="Password" required>
                </div>

                <!-- User type: -->
                <div class="form-group">
                    <label for="inputUserType">User type:</label>
                     <?php populate_user_type_selection('type', $user_type_id = 0) ?>
                </div>

                <!-- Phone number: -->
                <div class="form-group">
                    <label for="inputPhone">Phone number:</label>
                    <input id="inputPhone" name="phone" class="form-control" type="tel" placeholder="Phone number">
                </div>

                <!-- User company: -->
                <div class="form-group">
                    <label for="inputCompany">User company</label>
                   <?php populate_user_company_selection('company', $user_id = 0) ?>
                </div>

                <button type="submit" name="submit-user" class="btn btn-primary">Create User</button>


            </form>

           </li>
        </ul>
      </div>
     </div>
    </div>
  </section>

</main


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
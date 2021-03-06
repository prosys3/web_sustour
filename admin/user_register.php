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

    <section class="bg-primary">

        <div class="container text-center">

            <div style="height: 50px"></div>
            <img src="../rsc/img/logo/sustour/logo_symbol_green.svg" width="100" alt="Logo">
            <div style="height: 50px"></div>

        </div>

    </section>

    <hr>

    <section>

        <div class="container">

            <form action="user_register_script.php" method="post">

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
                    <input id="inputPassword" name="pass" class="form-control" type="password" placeholder="Password" required>
                </div>

                <!-- User type: -->
                <div class="form-group">
                    <label for="inputUserType">User type:</label>
                    <select id="inputUserType" name="type" class="form-control">
                    <?php
                        $sql = "SELECT * FROM User_Type ORDER BY User_Type_ID DESC";
                        $result = mysqli_query($con, $sql);

                        while ( $row = mysqli_fetch_array($result) ){
                            echo '<option value="' . $row['User_Type_ID'] . '">' . $row['User_Type_Name'] . '</option>';
                        }
                    ?>
                    </select>
                </div>

                <!-- Phone number: -->
                <div class="form-group">
                    <label for="inputPhone">Phone number:</label>
                    <input id="inputPhone" name="phone" class="form-control" type="tel" placeholder="Phone number">
                </div>

                <!-- User company: -->
                <div class="form-group">
                    <label for="inputCompany">User company</label>
                    <select id="inputCompany" name="company" class="form-control">

                        <?php
                        $sql = "SELECT * FROM Company ORDER BY Company_ID ASC";
                        $result = mysqli_query($con, $sql);

                        while ( $row = mysqli_fetch_array($result) ){
                            echo '<option value="' . $row['Company_ID'] . '">' . $row['Company_Name'] . '</option>';
                        }
                        ?>

                    </select>
                </div>

                <button type="submit" name="submit_user" class="btn btn-primary">Submit</button>

            </form>

        </div>

    </section>

</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
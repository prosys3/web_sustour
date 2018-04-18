<?php
//session_start();
//if(!isset($_SESSION['login'])){
//    header("Location:../login.php");
//    exit();
//}
//?>
<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

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

            <form action="loginscript.php" method="post">

                <!-- First name: -->
                <div class="form-group">
                    <label for="inputNameFirst">First name:</label>
                    <input id="inputNameFirst" class="form-control" type="text" placeholder="First name" autofocus required>
                </div>

                <!-- Last name: -->
                <div class="form-group">
                    <label for="inputNameLast">First name:</label>
                    <input id="inputNameLast" class="form-control" type="text" placeholder="Last name" required>
                </div>

                <!-- Password: -->
                <div class="form-group">
                    <label for="inputPassword">Password:</label>
                    <input id="inputPassword" class="form-control" type="text" placeholder="Password" required>
                </div>

                <!-- User type: -->
                <div class="form-group">
                    <label for="inputUserType">Email address</label>
                    <select id="inputUserType" class="form-control">
                        <option value="1">Root</option>
                        <option value="2">Administrator</option>
                        <option value="3">Moderator</option>
                        <option value="4">User</option>
                    </select>
                </div>

                <!-- Email address: -->
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input id="inputEmail" class="form-control" type="password" placeholder="Email address" required>
                </div>

                <!-- Phone number: -->
                <div class="form-group">
                    <label for="inputPhone">Email address</label>
                    <input id="inputPhone" class="form-control" type="tel" placeholder="Phone number">
                </div>

                <!-- User company: -->
                <div class="form-group">
                    <label for="inputCompany">User company</label>
                    <select id="inputCompany" class="form-control">
                        <option value="1">Company 1</option>
                        <option value="2">Company 2</option>
                        <option value="3">Company 3</option>
                        <option value="4">Company 4</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>

    </section>

</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

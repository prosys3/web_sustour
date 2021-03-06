<?php

    // Preliminary code:
    include 'dbconfig.php';
    include 'admin/rsc/import/php/functions/functions.php';

    // Regular template:
    include 'rsc/import/php/components/head.php';
    include 'rsc/import/php/components/header.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->


<main>

    <section class="bg-light py-5 border-bottom">

        <div class="container text-center">

            <img src="rsc/img/logo/sustour/logo_symbol_green.svg" width="100" alt="Logo">

        </div>

    </section>
    
    <section class="py-5">
        
        <div class="container">

            <form action="admin/user_login_script.php" method="post">

                <!-- Email address: -->
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input id="inputEmail" name="email" class="form-control" type="email" placeholder="Enter email address" autofocus required>
                </div>

                <!-- Password: -->
                <div class="form-group">
                    <label for="inputPassword">Password:</label>
                    <input id="inputPassword" name="password" class="form-control" type="password" placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-dark">Submit</button>

            </form>
            
        </div>
        
    </section>
    
</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
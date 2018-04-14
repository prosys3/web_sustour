<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Register account</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="register.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="admin/registerscript.php" method="post">
    <img class="mb-2" src="rsc/img/logo/sustour/logo_symbol_green.svg" alt="" width="120" height="120">
      <br>
      <h1 class="h3 mb-3 font-weight-normal">Register account</h1>
      <br>
       <!-- First name start -->
      <label for="inputEmail" class="sr-only">First name</label>
	    <input type="text" name="text" id="inputEmail" class="form-control" placeholder="Enter first name" required autofocus>
       <!-- First name start -->
      <br>

      <!-- Last name start -->
      <label for="inputEmail" class="sr-only">Last name</label>
      <input type="text" name="text" id="text" class="form-control" placeholder="Enter last name" required autofocus>
      <!-- Last name stop -->

      <!-- Password start -->
      <label for="inputPassword" class="sr-only">Password</label>
      <br>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Enter password" required>
      <div class="checkbox mb-3">
       <!-- Password stop -->
      
      <!--UserType start -->
      <div class="form-row align-items-center">
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="inlineFormCustomSelect">UserType</label>
      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
        <option selected>Please choose...</option>
        <option value="1">UserTypeOne</option>
        <option value="2">UserTypeTwo</option>
        <option value="3">UserTypeThree</option>
      </select>
    </div>
     <!--UserType stop -->


      <!-- Email start -->
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <!-- Email stop -->


    <!-- Remember me start -->
        <label>
          <input type="checkbox" value="remember-me">Remember me
        </label>
      </div>
    <!-- Remember me stop -->

      <button type="submit" class="btn btn-success btn-lg">Login</button>
      <p class="mt-5 mb-3 text-muted"> &copy; 2017-2018 Sustainable Tourism</p>
    </form>
  </body>
</html>







<!-- ... Your code goes here ... -->


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

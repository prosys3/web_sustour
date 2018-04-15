<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit();
}
?>
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

    <!-- Register account start -->
    <form class="form-signin " action="admin/registerscript.php" method="post">
      <br>
        <h1 class="h3 mb-3 font-weight-normal text-center">Register account</h1>
      <br>
    <!-- Register account stop -->

       <!-- First name start -->
      <div class="form-group justify-content-center">
        <div class="col-xs-3 ">
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
       <br>
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
      <br>

      <!-- Email start -->
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <!-- Email stop -->
      <br>
      <br>
    <!-- Remember me start -->
        <label>
          <input type="checkbox" value="remember-me">Remember me
        </label>
      </div>
       <br>
        <br>
    <!-- Remember me stop -->

      <button type="submit" class="btn btn-success btn-lg">Login</button>
       <br>
       <br>
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

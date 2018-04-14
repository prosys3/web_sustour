<?php include 'rsc/import/php/components/head.php' ?>
<?php include 'rsc/import/php/components/header.php' ?>

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

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="admin/loginscript.php" method="post">
      <img class="mb-2" src="rsc/img/logo/sustour/logo_symbol_green.svg" alt="" width="120" height="120">
      <br>
      <br>
      <h1 class="h3 mb-3 font-weight-normal">Login to Sustainable Tourism</h1>
      <br>
      <label for="inputEmail" class="sr-only">Username</label>
	    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <br>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me">Remember me
        </label>
      </div>

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

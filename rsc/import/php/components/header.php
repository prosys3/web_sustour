<nav id="prosys3-navbar" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">

        <a class="navbar-brand" href="index.php"><img src="rsc/img/logo/sustour/logo_symbol_white.svg" width="30" height="30" alt="Logo symbol"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">

            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                <li class="nav-item"><a class="nav-link" href="activities.php">Activities</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact us</a></li>
            </ul>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </button>
                <div id="prosys3-dropdown-login" class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                    <form class="form-signin">
                        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</nav>





<!-- CUSTOM NAVBAR LOGIN SCREEN: -->
<style>

    /* Setting some useful variables: */
    :root{

        --prosys3-dropdown-signin-width: 250px;
        --prosys3-dropdown-signin-height: 400px;
        --prosys3-navbar-height: 58px;

    }

    /*  */
    #prosys3-dropdown-login.dropdown-menu{

        position: fixed;

        top: calc( 50vh - ( var(--prosys3-dropdown-signin-height) / 1.5 ) );
        left: calc( 50% - ( var(--prosys3-dropdown-signin-width) / 2 ) );

        box-shadow: 0 2px 60px rgba(0,0,0,0.2);

    }
    #prosys3-dropdown-login.dropdown-menu > form.form-signin {

        padding: 30px;

        width: var(--prosys3-dropdown-signin-width);
        height: var(--prosys3-dropdown-signin-height);

    }
    #prosys3-dropdown-login.dropdown-menu > form.form-signin > input[type="email"] {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    #prosys3-dropdown-login.dropdown-menu > form.form-signin > input[type="password"] {
        margin-top: -1px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }


    /* Setting the navbar height in order to compensate for content overlap */
    #prosys3-navbar {

        height: var(--prosys3-navbar-height);

    }
    #prosys3-navbar ~ main {

        margin-top: var(--prosys3-navbar-height);

    }

    /* Adjustment of header logo */
    .img-thumbnail {
    width: 350px;
    height: 200px;
    margin-left: -200px;
    }

     /* Adjustment of sponsor logo in "about.php" */
    .siu-logo {
    width: 140px;
    height: 100px;
    margin-left: 45px;
    }


</style>
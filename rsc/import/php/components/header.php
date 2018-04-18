<nav id="prosys3-navbar" class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="container">

        <a class="navbar-brand" href="index.php"><img src="rsc/img/logo/sustour/logo_symbol_white.svg" width="30" height="30" alt="Logo symbol"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">

            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
                <li class="nav-item"><a class="nav-link" href="activities.php">Activities</a></li>
                <li class="nav-item"><a class="nav-link" href="files.php">Files</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact us</a></li>

            </ul>

            <div>
                <?php include 'rsc/import/php/components/btn_admin.php' ?>
                <a class="btn btn-light" href="login.php" role="button"><i class="material-icons">lock</i> Login</a>
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
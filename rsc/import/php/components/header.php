<!-- Do not delete or edit this style element: -->
<style>
    :root{ --prosys3-navbar-height: 58px; }
    nav#prosys3-navbar ~ main {margin-top: var(--prosys3-navbar-height);}
</style>
<!-- Do not delete or edit this style element: -->









<nav id="prosys3-navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                <?php
                    include 'rsc/import/php/components/buttons/btn_admin.php';
                    include 'rsc/import/php/components/buttons/btn_login_logout.php';
                ?>
            </div>


        </div>

    </div>
</nav>
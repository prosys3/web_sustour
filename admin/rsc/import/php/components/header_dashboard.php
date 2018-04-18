<!-- Do not delete or edit this style element: -->
<style>
    :root{ --prosys3-navbar-height: 58px; }
    nav#prosys3-navbar ~ main {margin-top: var(--prosys3-navbar-height);}
</style>
<!-- Do not delete or edit this style element: -->












<nav id="prosys3-navbar" class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="container">

        <a class="navbar-brand" href="index.php"><img src="../rsc/img/logo/sustour/logo_symbol_white.svg" width="30" height="30" alt="Logo symbol"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">

            <div class="text-light">
                Welcome, <?php echo $_SESSION['login_name'] ?>
            </div>

            <div>
                <?php include '../rsc/import/php/components/buttons/btn_public.php'?>
                <?php include 'rsc/import/php/components/buttons/btn_login_logout.php'?>
            </div>


        </div>

    </div>
</nav>
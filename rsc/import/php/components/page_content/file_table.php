<main>

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">

            <!-- logo navbar start -->
            <a href="#" class=""><img src="rsc/img/logo/sustour/logo_symbol_black.svg" width="150"></a>
            <!-- logo navbar stop -->

            <!-- logo tekst start -->
            <h1 class="display-3">Project files</h1>
            <!-- <p class="lead">Educational project between Kyrgyzstan, Georgia and Norway 2016– 2019</p> -->
            <!-- logo tekst stopp -->

        </div>
    </div>

    <section class="p-2">
        <div class="container text-center">

                <?php populate_public_file_table(0, "File_Uploaded", "DESC"); ?>

            </table>
        </div>
    </section>

</main>
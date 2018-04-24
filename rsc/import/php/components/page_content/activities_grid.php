<main>

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">

            <!-- logo navbar start -->
            <a href="#" class=""><img src="rsc/img/logo/sustour/logo_symbol_black.svg" width="150"></a>
            <!-- logo navbar stop -->

            <!-- logo tekst start -->
            <h1 class="display-3">Project activities</h1>
            <!-- <p class="lead">Educational project between Kyrgyzstan, Georgia and Norway 2016– 2019</p> -->
            <!-- logo tekst stopp -->

        </div>
    </div>

    <div class="container">

        <div class="row">
            <?php
            $query = "SELECT * FROM Activities;";
            $result = mysqli_query($con, $query);
            $count = 1;

            while ($row = mysqli_fetch_array($result)) {


                echo  '<div class="col-sm">';

                echo   '<br>';
                echo   '<h2>' . $row['Activities_Title'] . '</h2>';
                echo   '<p>' . $row['Activities_Text'] . '</p>';
                echo    '<div style="text-align: center">';
                echo   '<a href="activities.php?post='.$row['Activities_ID'].'" class="btn btn-primary" style="align-items: center">Read more</a>';
                echo    '</div>';
                echo   '<br>';
                echo   '</div>';



                if ($count % 2 == 0 ) {
                    echo '</div>';
                    echo '<div class="row">';


                }
                $count++;
            }
            ?>

        </div>

</main>

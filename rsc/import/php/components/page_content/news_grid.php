<main>

    <section class="jumbotron jumbotron-fluid">

        <div class="container text-center">
          <!-- logo start -->
          <a href="#" class=""><img src="rsc/img/logo/sustour/logo_symbol_black.svg" width="150"></a>
          <!-- logo stopp -->

          <!-- logo tekst start -->
          <h1 class="display-3">Project news</h1>
          <!-- logo tekst stopp -->


        </div>

    </section>



            <?php

            $sql = 'SELECT * FROM Post ORDER BY Post_Date_Created DESC';
            $result = mysqli_query($con, $sql);

            $counter = 1;
            echo '<section class="p-5">';
            echo '<div class="card-deck mx-auto w-50">';

            while ( $row = mysqli_fetch_array( $result ) ){

                echo '<div class="card border-dark">';
                if ($row['Post_Image_Featured'] != null){
                    echo '<img class="card-img-top mx-auto d-block w-25" src="'.$row['Post_Image_Featured'].'" alt="Card image cap">';
                }
                echo '<div class="card-body d-flex flex-column">';
                echo '<h5 class="card-title text-center">';
                echo $row['Post_Title'];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row ['Post_Text'];
                echo '</p>';
                echo '<a href="news.php?post='.$row['Post_ID'].'" class="btn btn-dark mt-auto">Read post</a>';
                if ( $row['Post_Private'] == 1 ) {
                    echo '<span class="badge badge-secondary mt-3">Private</span>';
                }
                echo '</div>';
                echo '</div>';

            if ($counter % 2 == 0) {
                 echo '</div>';
                 echo '</section>';
                 echo '<section class="p-5">';
                 echo '<div class="card-deck mx-auto w-50">';
                  }
                  $counter++;

            }
                 echo '</div>';
                 echo '</section>';

            ?>


</main>
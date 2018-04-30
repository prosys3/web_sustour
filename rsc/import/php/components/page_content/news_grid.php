
<main>
  <style type="text/css">
    .card-custom{
      max-width: 540px;
    }
  </style>

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

        if( isset($_SESSION['login']) ){
           
           

            $sql = 'SELECT * FROM Post ORDER BY Post_Date_Created DESC, Post_ID';
            $result = mysqli_query($con, $sql);
            $numrow = mysqli_num_rows($result);
            $counter = 1;
            echo '<section class="mb-5">';
            echo '<div class="container d-flex flex-row" style="flex-wrap:wrap;">';
            echo '<div class="card-deck">';

            while ( $row = mysqli_fetch_array( $result ) ){ 
              $post_text = substr($row['Post_Text'], 0, 700).'...'; 

                echo '<div class="card border-dark card-custom">';
                if ($row['Post_Image_Featured'] != null){
                    echo '<img class="card-img-top" src="'.$row['Post_Image_Featured'].'" alt="Card image cap" style="max-height:180px; object-fit: cover">';
                }
                echo '<div class="card-body d-flex flex-column">';
                echo '<h1 class="card-title text-center">';
                echo $row['Post_Title'];
                echo '</h1>';
                echo '<p class="card-text">';
                echo $post_text;
                echo '</p>';
                echo '</div>';
                if ( $row['Post_Private'] == 1 ) {
                    echo '<span class="badge badge-secondary mt-3">Private</span>';
                }
                echo '<a href="news.php?post='.$row['Post_ID'].'" class="btn btn-dark mt-auto">Read post</a>';
                
                
                echo '</div>';

            if ($counter % 2 == 0) {
                 echo '</div>';
                 echo '</div>';
                 echo '</section>';

                 if ($counter == $numrow) {

                    } else {
                 echo '<section class="mb-5">';
                 echo '<div class="container d-flex flex-row" style="flex-wrap:wrap;">';
                 echo '<div class="card-deck">';
                  }
              }
                  $counter++;

            } 
          } else{
            $sql = 'SELECT * FROM Post WHERE Post_Private = 0 ORDER BY Post_Date_Created DESC, Post_ID';
            $result = mysqli_query($con, $sql);
            $numrow = mysqli_num_rows($result);
            $counter = 1;
            echo '<section class="mb-5">';
            echo '<div class="container d-flex flex-row" style="flex-wrap:wrap;">';
            echo '<div class="card-deck">';

            while ( $row = mysqli_fetch_array( $result ) ){ 
              $post_text = substr($row['Post_Text'], 0, 700).'...'; 

                echo '<div class="card border-dark card-custom">';
                if ($row['Post_Image_Featured'] != null){
                    echo '<img class="card-img-top" src="'.$row['Post_Image_Featured'].'" alt="Card image cap" style="max-height:180px; object-fit: cover">';
                }
                echo '<div class="card-body d-flex flex-column">';
                echo '<h1 class="card-title text-center">';
                echo $row['Post_Title'];
                echo '</h1>';
                echo '<p class="card-text">';
                echo $post_text;
                echo '</p>';
                echo '</div>';
                if ( $row['Post_Private'] == 1 ) {
                    echo '<span class="badge badge-secondary mt-3">Private</span>';
                }
                echo '<a href="news.php?post='.$row['Post_ID'].'" class="btn btn-dark mt-auto">Read post</a>';
                
                
                echo '</div>';

            if ($counter % 2 == 0) {
                 echo '</div>';
                 echo '</div>';
                 echo '</section>';

                 if ($counter == $numrow) {

                    } else {
                 echo '<section class="mb-5">';
                 echo '<div class="container d-flex flex-row" style="flex-wrap:wrap;">';
                 echo '<div class="card-deck">';
                  }
              }
                  $counter++;

            }


          }
                 

            ?>


</main>
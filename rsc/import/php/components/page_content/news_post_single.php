<main>

    <section class="py-5">

        <div class="container">

             <?php

                $sql = 'SELECT * FROM Post WHERE Post_ID = ' . $_GET['post'];
                $result = mysqli_query($con, $sql);

                while ( $row = mysqli_fetch_array( $result ) ){

                    
                        echo '<div class="mb-5">';
                        if ($row['Post_Image_Featured'] != null){
                        echo '<img src="'.$row['Post_Image_Featured'].'" alt="Image" style="max-width: 600px;">';
                        echo '</div>';
                    
                    }
                    echo '<div class="" style="max-width: 700px;">';
                    echo '<h1>'.$row['Post_Title'].'</h1>';
                    echo $row['Post_Text'];

                }

            ?>

            

               

            
        </div>

    </section>

</main>
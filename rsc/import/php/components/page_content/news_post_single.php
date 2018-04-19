<main>

    <section class="py-5">

        <div class="container">

            <?php

                $sql = 'SELECT * FROM Post WHERE Post_ID = ' . $_GET['post'];
                $result = mysqli_query($con, $sql);

                while ( $row = mysqli_fetch_array( $result ) ){

                    if ( $row['Post_Image_Featured'] !== 0 ){
                        echo '<div class="mb-5">';
                        echo '<img src="'.$row['Post_Image_Featured'].'" style="max-width: 100%;">';
                        echo '</div>';
                    }
                    echo $row['Post_Text'];

                }

            ?>

        </div>

    </section>

</main>
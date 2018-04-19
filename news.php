<?php  session_start(); ?>
<?php include 'dbconfig.php' ?>
<?php include 'rsc/import/php/components/head.php' ?>
<?php include 'rsc/import/php/components/header.php' ?>




<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->


<main>

    <section class="bg-light py-5">

        <div class="container">

            <h1>News</h1>

        </div>

    </section>


    <section class="py-5">

        <div class="container d-flex flex-row">

            <?php

                $sql = 'SELECT * FROM Post ORDER BY Post_Date_Created DESC';
                $result = mysqli_query($con, $sql);

                while ( $row = mysqli_fetch_array( $result ) ){

                    echo '<div class="card" style="width: calc(33.33% - 10px); margin: 5px;">';
                    if ($row['Post_Image_Featured'] != null){
                        echo '<img class="card-img-top" src="'.$row['Post_Image_Featured'].'" alt="Card image cap">';
                    }
                    echo '<div class="card-body d-flex flex-column justify-content-between" style="flex-wrap: wrap; ">';
                    echo '<h5 class="card-title">';
                    echo $row['Post_Title'];
                    echo '</h5>';
                    echo '<div class="d-flex flex-column">';
                    echo '<a href="news.php?post='.$row['Post_ID'].'" class="btn btn-primary">Read post</a>';
                    if ( $row['Post_Private'] == 1 ) {
                        echo '<span class="badge badge-secondary mt-3">Private</span>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                }

            ?>

        </div>

    </section>

</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
                

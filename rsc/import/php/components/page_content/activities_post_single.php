<main>

    <section class="py-5">

        <div class="container">

            <?php

            $sql = 'SELECT * FROM Activities WHERE Activities_ID = ' . $_GET['post'];
            $result = mysqli_query($con, $sql);

            while ( $row = mysqli_fetch_array( $result ) ){


                    echo '<h2>' . $row['Activities_Title'] . '</h2>';
                    echo '<br>';
                    echo '<br>';
                    echo '<p>' . $row['Activities_Text'] . '</p>';
                    echo '<br>';
                    echo '<br>';

            }

            ?>

        </div>

        <section>

        <button class="btn btn-dark float-right" href="" role="button>" type="submit"><i class="material-icons">exit_to_app</i>Back to Activities</button>

        </section>  

    </section>

</main>
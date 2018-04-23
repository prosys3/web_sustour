<?php

    // Preliminary PHP code:
    include '../dbconfig.php';
    include 'rsc/import/php/functions/functions.php';

    // Security - Check whether user is logged in:
    if( !isset($_SESSION['login']) ){
        header("Location:../login.php");
        exit();
    }

    // HTML - Head and header:
    include 'rsc/import/php/components/head_dashboard.php';
    include 'rsc/import/php/components/header_dashboard.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->

<main>


    <section class="bg-light py-5">

        <div class="container">

            <h1>Upload your files</h1>

        </div>

    </section>


    <section class="py-5">

        <div class="container">

            <form action="file_upload.php" method="post" enctype="multipart/form-data" class="py-5">

                <div class="form-group">
                    <label for="alias">Enter file alias</label>
                    <input class="form-control" type="text" name="alias" id="alias">
                </div>

                <div class="form-group">
                    <label for="">Choose category</label>
                    <select class="form-control" name="category" id="category">
                        <?php
                            $sql = "SELECT * FROM Category";
                            $result = mysqli_query($con, $sql);
                            while ( $row = mysqli_fetch_array( $result ) ){
                                echo '<option value="'.$row['Category_ID'].'">'.$row['Category_Name'].'</option>';
                            };
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="private"><input type="checkbox" id="private" name="private"> Private post</label>
                </div>

                <div class="form-group">
                    <input class="form-control" type="file" name="file" id="file">
                </div>

                <button type="submit" value="empty" name="submit" class="btn btn-primary">Upload</button>

            </form>
            <?php uploader("file", "uploads") ?>

        </div>

    </section>


</main>



<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit();
}
?>
<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

<?php require ('rsc/import/php/functions/functions.php');  ?>
<?php include '../dbconfig.php' ?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->

<?php $_SESSION['id']=$_GET['id']; ?>

<main>

    <section class="bg-dark py-5">

        <div class="container text-center text-light">

            <h1>Admin dashboard</h1>

        </div>

    </section>

    <section class="bg-light py-5">
        <div class="container">

            <div class="row">
                <div class="col-3">
                    <?php include 'rsc/import/php/components/dashboard/dashboard_nav.php' ?>
                </div>

                <div class="col-9">
                    <ul class="list-group">
                        <li class="list-group-item text-light bg-dark">Post editor</li>
                        <li class="list-group-item">

                            <form method="POST" action="post_update_script.php">

                                <label>Post Title</label>
                                <input type="text" name="pTitle" class="form-control" placeholder="Page Title" value="<?php echo postTitle($con);?>">

                                <div class="form-group mt-4">
                                    <textarea name="editor1" class="form-control" placeholder="Page Body"><?php echo postText($con);?></textarea>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="mb-3"><input type="checkbox"> Private post</label>
                                    <?php alert("A private post will only be seen by registered users.", "secondary") ?>
                                </div>

                                <div class="form-group mt-4">
                                    <label>Category</label>
                                    <select id="inputUserType" name="type" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM Categories ORDER BY Category_ID DESC";
                                        $result = mysqli_query($con, $sql);

                                        while ( $row = mysqli_fetch_array($result) ){
                                            echo '<option value="' . $row['Category_ID'] . '">' . $row['Category_Name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="featured_img">Choose a featured image</label><br>
                                    <input id="featured_img" class="mb-3" type="file">
                                    <?php alert("The image must be either JPG, JPEG, or PNG, and be no more than 5 mb.", "primary") ?>
                                </div>

                                <div class="form-group my-5">
                                    <button type="submit" class="btn btn-success" name="submit">Publish post</button>
                                </div>


                            </form>

                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

</main>

<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
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


<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="page.php">Posts</a></li>
            <li class="active">Edit Post</li>

        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <div class="list-group">
                    <a href="index.php" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>


                    <!-- Overview for posts start -->
                    <a href="post_list.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge">
                    <?php echo postCount($con);?></span></a>
                    <!-- Overview for posts stop -->

                    <!-- Overview for users start -->
                    <a href="user_list.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">
                    <?php echo registredMemberCount($con);?></span></a>
                    <!-- Overview for users stopp -->

                    <!-- Overview for files start -->
                    <a href="file_list.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Files <span class="badge">
                    <?php echo fileCount($con);?> </span></a>
                    <!-- Overview for files stopp -->

                </div>
                
            </div>
            <div class="col-md-9">
                <!-- Website Overview -->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Edit Post</h3>
                    </div>
                    <div class="panel-body">


                        
                        <form method="POST" action="post_update_script.php">
                            <div class="form-group">
                                <label>Post Title</label>
                                <input type="text" name="pTitle" class="form-control" placeholder="Page Title" value="<?php echo postTitle($con);?>">
                                <div class="form-group">
                                    <label>Post Body</label> 
                                    <textarea name="editor1" class="form-control" placeholder="Page Body"><?php echo postText($con);?></textarea>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" checked>Published</label>
                                </div>
                                <div class="form-group">
                                    <label>Meta Tags</label>
                                    <input type="text" class="form-control" placeholder="Add some tags" value="<?php echo postTag($con);?>">
                                </div>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <input type="text" class="form-control" placeholder="Add Meta description" value="Adobe XD or Experience Design allows you to go from wireframe to interactive prototype, from desktop to mobile.">
                                </div>

                                <input type="submit" class="btn btn-default" value="Submit" name="submit">
    
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Latest Users -->



            </div>


</section>

<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>
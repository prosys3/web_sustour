<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->
<?php require ('rsc\import\php\functions\functions.php');  ?>
<?php require_once ("rsc/import/php/dbconfig.php"); ?>

    <section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="posts.php">Posts</a></li>
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
                    <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge">
                    <?php echo postCount($con);?></span></a>
                    <!-- Overview for posts stop -->

                    <!-- Overview for users start -->
                    <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">
                    <?php echo registredMemberCount($con);?></span></a>
                    <!-- Overview for users stopp -->

                    <!-- Overview for files start -->
                    <a href="files.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Files <span class="badge"> 
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
                        <form>
                            <div class="form-group">
                                <label>Post Title</label>
                                <input type="text" class="form-control" placeholder="Page Title" value="About">
                                <div class="form-group">
                                    <label>Post Body</label>
                                    <textarea name="editor1" class="form-control" placeholder="Page Body">Adobe XD or Experience Design allows you to go from wireframe to interactive prototype, from desktop to mobile. I am going to upload a series of prototypes I’ve worked on as well as some tutorials to how to work with Adobe XD.</textarea>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" checked>Published</label>
                                </div>
                                <div class="form-group">
                                    <label>Meta Tags</label>
                                    <input type="text" class="form-control" placeholder="Add some tags" value="tag1, tag2">
                                </div>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <input type="text" class="form-control" placeholder="Add Meta description" value="Adobe XD or Experience Design allows you to go from wireframe to interactive prototype, from desktop to mobile.">
                                </div>
                                <input type="submit" class="btn btn-default" value="Submit">
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Latest Users -->



            </div>


</section>

<footer id="footer"><p>Copyright DN, &copy; 2017</p></footer>

<!-- Modals -->

<!-- Add Page -->
<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Page</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" class="form-control" placeholder="Page Title">
                        <div class="form-group">
                            <label>Page Body</label>
                            <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox">Published</label>
                        </div>
                        <div class="form-group">
                            <label>Meta Tags</label>
                            <input type="text" class="form-control" placeholder="Add some tags">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <input type="text" class="form-control" placeholder="Add Meta description">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashborad.php' ?>
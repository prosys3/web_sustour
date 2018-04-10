<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->


    <section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active">Users</li>

        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <div class="list-group">
                    <a href="index.php" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                    </a>


                    <!-- Overview for posts start -->
                    <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Posts <span class="badge">31</span></a>
                    <!-- Overview for posts stop -->

                    <!-- Overview for users start -->
                    <a href="users.php" class="list-group-item "><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Users <span class="badge">41</span></a>
                    <!-- Overview for users stopp -->

                    <!-- Overview for files start -->
                    <a href="files.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Files <span class="badge">59</span></a>
                    <!-- Overview for files stopp -->

                </div>


            </div>
            <div class="col-md-9">
                <!-- Website Overview -->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Users</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Filter Users">
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>User 1</td>
                                <td>john@doe.com</td>
                                <td>user</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>User 2</td>
                                <td>john@doe.com</td>
                                <td>admin</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>User 3</td>
                                <td>john@doe.com</td>
                                <td>moderator</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>User 4</td>
                                <td>john@doe.com</td>
                                <td>user</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                        </table>

                    </div>
                </div>

                <!-- Latest Users -->



            </div>


</section>

<footer id="footer"><p>Copyright Sutainable Tourism, &copy; 2018</p></footer>

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
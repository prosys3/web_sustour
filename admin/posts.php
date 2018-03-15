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
            <li class="active">Posts</li>

        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="dashboard.php" class="list-group-item >
			    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                    </a>
                    <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Posts <span class="badge">31</span></a>
                    <a href="users.php" class="list-group-item  active main-color-bg"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> users <span class="badge">41</span></a>
                    <a href="files.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> files<span class="badge">59</span></a>
                </div>

            </div>
            <div class="col-md-9">
                <!-- Website Overview -->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Posts</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Filter Pages">
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Title</th>
                                <th>Published</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>DN Network Prototype</td>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <td>January, 10th 2017</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>How to work with Boostrap?</td>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <td>December, 19th 2016</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>Learn Adobe XD</td>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <td>August, 3rd 2016</td>
                                <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>Adobe Muse Tutorial</td>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <td>May, 7th 2016</td>
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
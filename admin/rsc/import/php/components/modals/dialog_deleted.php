<?php


// Check whether something was deleted:
if ( isset($_GET['deleted']) ){


    // Check if a file has been deleted:
    if ( $_GET['deleted'] == 'file' ){

        // A file has been deleted.
        $object = 'file';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '11' ){

            // File has been deleted from both DB and file server:
            $status_adjective = 'successfully';
            $status_db_word = 'file deleted.';
            $status_db_color = 'text-success';
            $status_file_word = 'file deleted.';
            $status_file_color = $status_db_color;
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == '10' ){

            // File has been deleted from file server but not from DB:
            $status_adjective = 'partially';
            $status_db_word = 'file not deleted.';
            $status_db_color = 'text-danger';
            $status_file_word = 'file deleted.';
            $status_file_color = 'text-success';
            $title_text = 'Something went wrong';
            $title_icon = 'warning';
            $title_color = 'text-warning';

        } elseif ( $status_code == '01' ){

            // File has been deleted from DB but not from file server:
            $status_adjective = 'partially';
            $status_db_word = 'file deleted.';
            $status_db_color = 'text-success';
            $status_file_word = 'file not deleted.';
            $status_file_color = 'text-danger';
            $title_text = 'Something went wrong';
            $title_icon = 'warning';
            $title_color = 'text-warning';

        } elseif ( $status_code == '00' ){

            // Nothing was deleted:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'file not deleted.';
            $status_db_color = 'text-danger';
            $status_file_word = 'file not deleted.';
            $status_file_color = $status_db_color;
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }

    }




    // Check if post has been deleted
    elseif ($_GET['deleted'] == 'post'){

        // A post has been deleted:
        $object = 'post';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '11' ){

            // Post deleted from DB. Featured image deleted from file server:
            $status_adjective = 'successfully';
            $status_db_word = 'post deleted.';
            $status_db_color = 'text-success';
            $status_file_word = 'featured image deleted.';
            $status_file_color = $status_db_color;
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == '10' ){

            // Featured image deleted from file server. Post not deleted from DB:
            $status_adjective = 'partially';
            $status_db_word = 'post not deleted.';
            $status_db_color = 'text-danger';
            $status_file_word = 'featured image deleted.';
            $status_file_color = 'text-success';
            $title_text = 'Something went wrong';
            $title_icon = 'warning';
            $title_color = 'text-warning';

        } elseif ( $status_code == '01' ){

            // Post deleted from DB. Featured image not deleted from file server:
            $status_adjective = 'partially';
            $status_db_word = 'post deleted.';
            $status_db_color = 'text-success';
            $status_file_word = 'featured image not deleted.';
            $status_file_color = 'text-danger';
            $title_text = 'Something went wrong';
            $title_icon = 'warning';
            $title_color = 'text-warning';

        } elseif ( $status_code == '00' ){

            // Nothing was deleted:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'post not deleted.';
            $status_db_color = 'text-danger';
            $status_file_word = 'featured image not deleted.';
            $status_file_color = $status_db_color;
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        } elseif ( $status_code == 'n1' ){

            // Post deleted from DB:
            $status_adjective = 'successfully';
            $status_db_word = 'post deleted.';
            $status_db_color = 'text-success';
            $status_file_word = 'post did not have a featured image.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == 'n0' ){

            // Post not deleted from DB:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'post not deleted.';
            $status_db_color = 'text-danger';
            $status_file_word = 'post did not have a featured image.';
            $status_file_color = 'text-muted';
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }

    }



    // Check if post has been deleted
    elseif ($_GET['deleted'] == 'user'){

        // A post has been deleted:
        $object = 'User';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '1' ){

            // Post deleted from DB:
            $status_adjective = 'successfully';
            $status_db_word = 'Person deleted from database.';
            $status_db_color = 'text-success';
            $status_file_word = 'there were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == '0' ){

            // Post not deleted from DB:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'Person not deleted from database.';
            $status_db_color = 'text-danger';
            $status_file_word = 'there were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }

    }

    elseif ($_GET['deleted'] == 'activities') {

        // an activity has been deleted
        $object = 'activity';

        // analyze the status codes:
        $status_code = $_GET['status'];

        if ( $status_code == '1' ) {

            // activity deleted from DB:
            $status_adjective = 'successfully';
            $status_db_word = 'Activity deleted from database.';
            $status_db_color = 'text-success';
            $status_file_word = 'there were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';


        } elseif ( $status_code == '0' ){

            // Post not deleted from DB:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'Activity not deleted from database.';
            $status_db_color = 'text-danger';
            $status_file_word = 'there were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }
    }

    elseif ($_GET['deleted'] == 'event'){

        // A post has been deleted:
        $object = 'Event';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '1' ){

            // Post deleted from DB:
            $status_adjective = 'successfully';
            $status_db_word = 'Event deleted from database.';
            $status_db_color = 'text-success';
            $status_file_word = 'No files to delete in events.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == '0' ){

            // Post not deleted from DB:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'Event not deleted from database.';
            $status_db_color = 'text-danger';
            $status_file_word = 'There were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }

    }

    elseif ($_GET['deleted'] == 'category'){

        // A post has been deleted:
        $object = 'Category';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '1' ){

            // Post deleted from DB:
            $status_adjective = 'successfully';
            $status_db_word = 'Category deleted from database.';
            $status_db_color = 'text-success';
            $status_file_word = 'No files to delete in Category.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == '0' ){

            // Post not deleted from DB:
            $status_adjective = 'unsuccessfully';
            $status_db_word = 'Category not deleted from database.';
            $status_db_color = 'text-danger';
            $status_file_word = 'There were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }

    }




    // Define status components:
    $status_db = '<p><i class="material-icons">storage</i> Database:&nbsp;&nbsp;&nbsp;<span class="'.$status_db_color.'">'.ucfirst($status_db_word).'</span></p>';
    $status_file = '<p><i class="material-icons">sd_card</i> File server:&nbsp;&nbsp;<span class="'.$status_file_color.'">'.ucfirst($status_file_word).'</span></p>';




    // Concatenate:
    $status = $status_db.$status_file;




    // Define modal template:
    $modal = '
    <!-- Executable link for modal window: -->
    <a id="modal-run" class="hidden" data-toggle="modal" data-target="#modal-deleted"></a>

    <!-- Modal window -->
    <div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-labelledby="modal-deleted-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title '.$title_color.'" id="exampleModalCenterTitle"><i class="material-icons">'.$title_icon.'</i> '.$title_text.'!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-secondary">

                    <h4>'.ucfirst($object).' termination</h4>
                    <p>The '.$object.' was '.$status_adjective.' deleted.</p>
                    <hr>
                    <p>'.$status.'</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Click executable link on page load: -->
    <script>
        window.onload=function(){
            if(document.getElementById(\'modal-run\')!=null||document.getElementById(\'modal-run\')!=""){
                document.getElementById(\'modal-run\').click();
            }
        }
    </script>
    ';




    // Echo modal:
    echo $modal;

}


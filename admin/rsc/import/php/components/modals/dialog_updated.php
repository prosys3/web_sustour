<?php


// Check if something was updated:
if ( isset($_GET['updated']) ){


    // Check if request is for a file:
    if ( $_GET['updated'] == 'file' ){

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
            $status_adjective = 'not';
            $status_db_word = 'file not deleted.';
            $status_db_color = 'text-danger';
            $status_file_word = 'file not deleted.';
            $status_file_color = $status_db_color;
            $title_text = 'Nothing deleted';
            $title_icon = 'error';
            $title_color = 'text-danger';

        }

    }




    // Check if request is for a post
    elseif ($_GET['updated'] == 'post'){

        // THe object is a post:
        $object = 'post';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '11' ){

            // Post updated from DB. Featured image uploaded from file server:
            $status_adjective = 'successfully';
            $status_db_word = 'post updated.';
            $status_db_color = 'text-success';
            $status_file_word = 'new featured image uploaded.';
            $status_file_color = $status_db_color;
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == '10' ){

            // Featured image uploaded from file server. Post not updated in DB:
            $status_adjective = 'partially';
            $status_db_word = 'post not updated.';
            $status_db_color = 'text-danger';
            $status_file_word = 'new featured image uploaded.';
            $status_file_color = 'text-success';
            $title_text = 'Something went wrong';
            $title_icon = 'warning';
            $title_color = 'text-warning';

        } elseif ( $status_code == '01' ){

            // Post updated in DB. Featured image not uploaded to server:
            $status_adjective = 'partially';
            $status_db_word = 'post updated.';
            $status_db_color = 'text-success';
            $status_file_word = 'unable to upload new featured image.';
            $status_file_color = 'text-danger';
            $title_text = 'Something went wrong';
            $title_icon = 'warning';
            $title_color = 'text-warning';

        } elseif ( $status_code == '00' ){

            // Nothing was updated:
            $status_adjective = 'not';
            $status_db_word = 'post not updated.';
            $status_db_color = 'text-danger';
            $status_file_word = 'unable to upload new featured image.';
            $status_file_color = $status_db_color;
            $title_text = 'Nothing updated';
            $title_icon = 'error';
            $title_color = 'text-danger';

        } elseif ( $status_code == 'n1' ){

            // Post updated in DB:
            $status_adjective = 'successfully';
            $status_db_word = 'post updated.';
            $status_db_color = 'text-success';
            $status_file_word = 'post did not have a featured image.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == 'n0' ){

            // Post not updated in DB:
            $status_adjective = 'not';
            $status_db_word = 'post not updated.';
            $status_db_color = 'text-danger';
            $status_file_word = 'post did not have a featured image.';
            $status_file_color = 'text-muted';
            $title_text = 'Nothing updated';
            $title_icon = 'error';
            $title_color = 'text-danger';

        } elseif ( strpos($status_code,'illegal') !== false ){

            // Post not updated in DB, because file is illegal:
            $status_adjective = 'not';
            $status_db_word = 'post not updated due to illegal file type.';
            $status_db_color = 'text-danger';
            $status_file_word = 'file not uploaded due to illegal file type.';
            $status_file_color = 'text-danger';
            $title_text = 'Illegal file type: Nothing updated';
            $title_icon = 'security';
            $title_color = 'text-danger';

        } elseif ( strpos($status_code,'big') !== false ){

            // Post not updated in DB, because file is illegal:
            $status_adjective = 'not';
            $status_db_word = 'post not updated due to large file.';
            $status_db_color = 'text-danger';
            $status_file_word = 'the photo you submitted is over 5MB.';
            $status_file_color = 'text-danger';
            $title_text = 'Image file too large: Nothing updated';
            $title_icon = 'security';
            $title_color = 'text-danger';

        } elseif ( strpos($status_code,'fake') !== false ){

            // Post not updated in DB, because file is illegal:
            $status_adjective = 'not';
            $status_db_word = 'post not updated due to security.';
            $status_db_color = 'text-danger';
            $status_file_word = 'the photo you submitted is not an actual image.';
            $status_file_color = 'text-danger';
            $title_text = 'Malicious file: Nothing updated';
            $title_icon = 'security';
            $title_color = 'text-danger';

        }

    }




    // Check if request is for a user:
    elseif ($_GET['deleted'] == 'user'){

        // A post has been deleted:
        $object = 'user';

        // Analyze the status codes:
        $status_code = $_GET['status'];

        // Generate status feedback in accordance with status codes:
        if ( $status_code == 'n1' ){

            // post updated from DB:
            $status_adjective = 'successfully';
            $status_db_word = 'person deleted from database.';
            $status_db_color = 'text-success';
            $status_file_word = 'there were no files to delete.';
            $status_file_color = 'text-muted';
            $title_text = 'Success';
            $title_icon = 'done';
            $title_color = 'text-success';

        } elseif ( $status_code == 'n0' ){

            // post not updated from DB:
            $status_adjective = 'not';
            $status_db_word = 'person not deleted from database.';
            $status_db_color = 'text-danger';
            $status_file_word = 'there were no files to delete.';
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
    <a id="modal-run" class="hidden" data-toggle="modal" data-target="#modal-updated"></a>

    <!-- Modal window -->
    <div class="modal fade" id="modal-updated" tabindex="-1" role="dialog" aria-labelledby="modal-updated-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title '.$title_color.'" id="exampleModalCenterTitle"><i class="material-icons">'.$title_icon.'</i> '.$title_text.'!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-secondary">

                    <h4>'.ucfirst($object).' updated</h4>
                    <p>The '.$object.' was '.$status_adjective.' updated.</p>
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


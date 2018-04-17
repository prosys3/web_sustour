<?php  session_start(); ?>
<?php

if(isset($_POST['submit'])) {

    require_once ("../dbconfig.php");

    $pTitle = mysqli_real_escape_string($con, $_POST['pTitle']);
    $pText = mysqli_real_escape_string($con, $_POST['editor1']);
   
    $sql = "UPDATE post SET Post_Title = '$pTitle',
            Post_Text = '$pText'
            WHERE Post_ID=" . $_SESSION['id'];
            //MORE TO FOLLOW
    $result = mysqli_query($con,$sql);
    header("Location: posts.php");
       
        }

    mysqli_close($con);

?>
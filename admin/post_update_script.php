<?php

    include '../dbconfig.php';

    if(isset($_POST['submit'])) {

        $pTitle = mysqli_real_escape_string($con, $_POST['pTitle']);
        $pText = mysqli_real_escape_string($con, $_POST['editor1']);

        $sql = "UPDATE Post SET Post_Title = '$pTitle',
                Post_Text = '$pText'
                WHERE Post_ID=" . $_SESSION['id'];
                //MORE TO FOLLOW
        $result = mysqli_query($con,$sql);

    }

    mysqli_close($con);


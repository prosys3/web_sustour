<?php

    // Preliminary code:
    include 'dbconfig.php';
    include 'admin/rsc/import/php/functions/functions.php';

    // Regular template:
    include 'rsc/import/php/components/head.php';
    include 'rsc/import/php/components/header.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->
<?php

    if ( isset($_GET['post']) ){

        include 'rsc/import/php/components/page_content/activities_post_single.php';

    } else {

        include 'rsc/import/php/components/page_content/activities_grid.php';

    }
?>




<!-- ... Your code goes here ... -->


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>

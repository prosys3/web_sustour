<?php  session_start(); ?>
<?php include 'dbconfig.php' ?>
<?php include 'rsc/import/php/components/head.php' ?>
<?php include 'rsc/import/php/components/header.php' ?>




<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->




<?php

    if ( isset($_GET['post']) ){

        include 'rsc/import/php/components/page_content/news_post_single.php';

    } else {

        include 'rsc/import/php/components/page_content/news_grid.php';

    }

?>




<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
                

<?php

    $btn = '<a class="btn btn-dark" href="admin/index.php?dashboard=1"><i class="material-icons">account_circle</i>&nbsp;Admin</a>';

    if ( isset( $_SESSION['login'] ) ) {

        if($_SESSION['user_type'] < 4) {
            echo $btn;
        } else {

        }


    }
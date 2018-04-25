<?php

function activeItem( $number ) {

    if ( isset($_GET['dashboard']) ) {

        $id_dashboard = $_GET['dashboard'];
        if ( isset($number) && $id_dashboard == $number ) {
            return 'text-light bg-secondary';
        } else {
            return 'text-secondary';
        }

    } else {

        return 'text-secondary';

    }

}

function activeBadge( $number ) {

    if ( isset($_GET['dashboard']) ) {

        $id_dashboard = $_GET['dashboard'];
        if ( isset($number) && $id_dashboard == $number ) {
            return 'badge badge-light';
        }   else {
            return 'badge badge-secondary';
        }

    } else {

        return 'badge badge-secondary';

    }

}

$html = '

<div class="list-group">
    <a href="index.php?dashboard=1"     class="list-group-item ' . activeItem(1) . '"><i class="material-icons">weekend</i> Dashboard</a>
    <a href="post_list.php?dashboard=2" class="list-group-item ' . activeItem(2) . '"><i class="material-icons">description</i> Posts <span class="'.activeBadge(2).'">' . counter("posts") . '</span></a>
    <a href="activities_list.php?dashboard=3" class="list-group-item ' . activeItem(3) . '"><i class="material-icons">description</i> Activities <span class="'.activeBadge(3).'">' . counter("posts") . '</span></a>
    <a href="event_list.php?dashboard=4" class="list-group-item ' . activeItem(4) . '"><i class="material-icons">description</i> Events <span class="'.activeBadge(4).'">' . counter("posts") . '</span></a>
    <a href="user_list.php?dashboard=5" class="list-group-item ' . activeItem(5) . '"><i class="material-icons">person</i> Users <span class="'.activeBadge(5).'">' . counter("users") . '</span></a>
    <a href="file_list.php?dashboard=6" class="list-group-item ' . activeItem(6) . '"><i class="material-icons">folder</i> Files <span class="'.activeBadge(6).'">' . counter("files") . '</span></a>
</div>

';

echo $html;
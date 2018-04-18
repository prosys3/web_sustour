<?php

session_destroy();

$url_data = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header('Refresh: 0; URL=login.php');
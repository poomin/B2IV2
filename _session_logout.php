<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/2/2019
 * Time: 5:09 PM
 */
session_start();
session_destroy();
header( "location: /index.php" );
exit(0);
<?php
    $users = get_users( array( 'role__in' => array( 'administrator', 'User' ) ) ); 
?>
<?php

add_role(
    'Client',
    __( 'Client' )
);
add_role(
    'user',
    __( 'User' ),
   array(
       'read'            => true, // Allows a user to read
       'create_posts'      => true, // Allows user to create new posts
       'edit_posts'        => true, // Allows user to edit their own posts
       'edit_others_posts' => true, // Allows user to edit others posts too
       'publish_posts' => true, // Allows the user to publish posts
       'manage_categories' => true, // Allows user to manage post categories
       )
);

/*
	$wp_roles = new WP_Roles();
	$wp_roles->remove_role("role_name");
	
*/
?>
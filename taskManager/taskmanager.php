<?php
/**
 * Plugin Name:  P5Marketing Task Manager
 * Description: Task and workflow manager
 * Version: 1.0.1
 * Author: P5marketing team
 * Text Domain: Task Manager
 */
/**
 * Task Manager main plugin file.
*/
// db Connection
require_once('inc/php/wf_add_new_pages.php');
require_once('inc/php/wf_add_roles.php');
require_once('inc/php/wf_styles.php');
require_once('inc/php/wf_post_type.php');
require_once('inc/php/wf_redirect_pages.php');
require_once('inc/php/wf_taxonomy.php');
require_once('inc/php/wf_add_submenu.php');
require_once('inc/php/wf_add_taxonomies.php');
require_once('inc/php/wf_add_custom_fields_tasks.php');
require_once('inc/php/wf_add_custom_fields_workflow.php');
require_once('inc/php/wf_add_menu_item.php');
require_once('inc/php/wf_schedule_event.php');
require_once('inc/php/wf_loading_page.php');

function facebook_meta_tag() {
    global $post;
    echo '<meta name="facebook-domain-verification" content="hca9umt0j2yryd4oqyj047d12d13ik" />';
}
add_action( 'wp_head', 'facebook_meta_tag');
  
?>
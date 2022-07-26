<?php

// Custom interval
add_filter( 'cron_schedules', function ( $schedules ) {
    $schedules['daily'] = array(
        'interval' => 86400,
        'display' => __( 'daily' )
    );
    return $schedules;
 } );

//Setting custom hook
add_action('workflow_cron_hook', 'workflow_cron_mail');
//Event function
function workflow_cron_mail(){
    global $post, $wp;
    $argsWorkflowEmail = array(
        'post_type' => 'workflow',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $queryWorkflowEmail = new WP_Query( $argsWorkflowEmail );
    $today = date("Y-m-d"); 
    if ( $queryWorkflowEmail->have_posts() ) : 
        while ( $queryWorkflowEmail->have_posts() ) : $queryWorkflowEmail->the_post();
        $author_id = get_post_field( 'post_author', $post->ID );
        $user_data = get_userdata($author_id);
        $tasks_due = json_decode(get_post_meta($post->ID,'tasks_array',true));
            foreach ($tasks_due as $key => $task_due) {
                if( strtotime($today) == strtotime($task_due->date) || strtotime($today) > strtotime($task_due->date)){
                    if($task_due->status != 'Completed'){
                        $to = $user_data->user_email;
                        $subject = 'From: '.get_bloginfo() ;
                        $body = 'Hi '.$user_data->display_name.'please check the tasks:'. $task_due->task.' from the workflow <a href="'.get_the_permalink($post->ID).'">'. get_the_title($post->ID).'</a>';
                        $headers[] = 'Content-Type: text/html; charset=UTF-8';
                        $email = wp_mail( $to, $subject, $body, $headers/*, $attachments*/ );
                    }
                }
            }
        endwhile;
        wp_reset_postdata();
    else : 
       esc_html_e( "Sorry, no posts matched your criteria." );
    endif;
    
}
//Scheduling recurring event

//Prevent duplicate scheduling

if( !wp_next_scheduled('workflow_cron_hook')){
    wp_schedule_event( time(), 'daily', 'workflow_cron_hook' );
}

?>
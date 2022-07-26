<?php
        
        require_once('templates/wf_table_header.php');  
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $taxonomyActions = 'actions';
                $taxonomyClient = 'client';
                $get_author_id = get_the_author_meta($post->ID);
                $get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));
                $assignedTo = explode('/',get_post_meta( $post->ID, 'assing_to_field', true )); 
                $taskTypeField = get_post_meta( $post->ID, 'task_type_field', true ); // Get the saved values
                $statusField = get_post_meta( $post->ID, 'status_field', true );
                $sprintField = get_post_meta( $post->ID, 'sprint_field', true );
                $contentUrl = home_url( $wp->request );
                
                    if($statusField != 'Completed'){
                        require_once('templates/wf_table_content.php');
                    }//end if not completed
            endwhile; 
            wp_reset_postdata();
        else : 
            esc_html_e( "Sorry, no posts matched your criteria." );
        endif;
    echo '</table>';
echo '</div>';
get_footer();
?>
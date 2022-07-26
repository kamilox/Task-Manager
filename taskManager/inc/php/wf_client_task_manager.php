<?php
/*
* Template name: Page Client Task Manager
*/

if(is_user_logged_in()){
    global $current_user, $post, $wp;
    wp_get_current_user();
    $post_type = 'task';
    $taxonomy = 'client';
    $user_login = $current_user->user_login;
    $user_email = $current_user->user_email;
    $user_firstname = $current_user->user_firstname;
    $user_lastname = $current_user->user_lastname;
   
    $args = array(
        'post_type' => 'task',
        'post_status' => 'publish',
        'author'        =>  $current_user->ID,
        'orderby'       =>  'post_date',
        'order'         =>  'ASC',
        'posts_per_page' => -1
        );
    
    // The query
    $query = new WP_Query( $args );
}
get_header();
    echo '<div class="posts-full-container">';
        echo '<div class="posts-title-container">';
            echo '<h1>';
                echo 'Task`s List';
            echo '</h1>';
        echo '</div>';
        echo '<table>';
            echo '<tr>';
                
                echo '<th class="task-table-header">';
                    echo 'Title';
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Date';
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Status';
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Sprint month';
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Site name';
                echo '</th>';
            echo '</tr>';
            
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
                            echo '<input type="hidden" name="submitted" id="submitted" value="true" />';
                            echo '<tr>';
                            
                                echo '<td class="tasks-post">';
                                        the_title();
                                echo '</td>';

                                    ?>
                                    <form action="<?php the_permalink() ?>" method="post" class="comment-form">
                                        <input type="hidden" id="contentUrl" name="contentUrl" value="<?php  echo $contentUrl; ?>">
                                    
                                        <td class="tasks-post">
                                            <?php the_time('m/d/y');?>
                                        </td>

                                        <td class="tasks-post">
                                            <div class="status_field">    
                                                <?php echo($statusField); ?>
                            
                                            </div>
                                        </td>

                                        <td class="tasks-post">
                                            <?php echo $sprintField; ?>
                                        </td>

                                        <td class="tasks-post">
                                            <?php
                                                $sitesNames = ( wp_get_post_terms($post->ID, $taxonomyClient));
                                                foreach ($sitesNames as $key => $siteName) {
                                                    $termDrChild = $siteName->name;
                                                    echo $termDrChild;
                                                }
                                            ?>
                                        </td>
                                    </form>
                                
                                <?php

                            echo '</tr>';
                        }//end if not completed
                endwhile; 
                wp_reset_postdata();
            else : 
                echo '<p>esc_html_e( "Sorry, no posts matched your criteria." ); </p>';
            endif;
        
    echo '</table>';
        
    echo '</div>'; //posts-full-container

get_footer();

?>
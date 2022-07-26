<?php
require_once('templates/wf_add_class_list.php');
require_once('templates/wf_run_class.php');
$argsWorkflow = array(
    'post_type' => 'workflow',
    'post_status' => 'publish',
    'posts_per_page' => -1
);
$queryWorkflow = new WP_Query( $argsWorkflow );
global $post;
$slug = get_post( $post )->post_name;
get_header();

        echo '<div class="posts-full-container">';
            echo '<div class="posts-title-container">';
                switch ($slug) {
                    case 'workflow-manager':
                        echo "<h1>Workflow Manager</h1>";
                        echo '<a class="btn-add-new-workflow" href="https://p5marketing.com/wp-admin/post-new.php?post_type=workflow">Add New Workflow</a>';
                        break;
                    case 'task-manager':
                        echo "<h1>Task Manager</h1>";
                        echo '<a class="btn-add-new-workflow" href="https://p5marketing.com/wp-admin/post-new.php?post_type=task">Add New Task</a>';
                        break;
                }
            echo '</div>';

            echo '<div class="restore-button">';
                echo'<h2>';
                    echo 'Active task';
                echo'</h2>';
                ?> 
                    <form action="<?php the_permalink() ?>" method="post" class="search-form">
                        <input type="hidden" name="restore" id="restore" class="search-input">
                        <input 
                                            id="submit" 
                                            name="submit" 
                                            type="submit"  
                                            class="submit" 
                                            value=""
                                            style="
                                                background-image:url(<?php echo plugins_url( '../img/restore.webp', __FILE__) ?>);
                                                background-repeat: no-repeat;
                                                background-size: 20px;
                                                background-position: center;
                                                border-radius: 5px;
                                                padding: 10px 20px;
                                            "
                                            alt ="Restore"
                                        >
                    </form>
                <?php
            echo '</div>';
        echo '<table>';
            echo '<tr>';       
                echo '<th class="task-table-header">';
                    echo 'Title';
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Assinged to';

                    ?> 
                        <form action="<?php the_permalink() ?>" method="post" class="search-form">
                            <input type="text" name="search_by_name" id="search_by_name" class="search-input">
                            <input 
                                                id="submit" 
                                                name="submit" 
                                                type="submit"  
                                                class="submit" 
                                                value=""
                                                style="
                                                    background-image:url(<?php echo plugins_url( '../img/search.webp', __FILE__) ?>);
                                                    background-repeat: no-repeat;
                                                    background-size: 20px;
                                                    background-position: center;
                                                    border-radius: 5px;
                                                    padding: 5px 20px;
                                            
                                                "
                                            >
                        </form>
                    <?php
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Date';
                    ?> 
                        <form action="<?php the_permalink() ?>" method="post" class="search-form">
                            <input type="hidden" name="sort_by_date" id="sort_by_date" class="search-input">
                            <input 
                                                id="submit" 
                                                name="submit" 
                                                type="submit"  
                                                class="submit" 
                                                value=""
                                                style="
                                                    background-image:url(<?php echo plugins_url( '../../img/sort.webp', __FILE__) ?>);
                                                    background-repeat: no-repeat;
                                                    background-size: 15px;
                                                    background-position: center;
                                                    border-radius: 5px;
                                                    padding: 5px 20px;
                                            
                                                "
                                            >
                        </form>
                    <?php
                echo '</th>';
                if($slug == 'task-manager'){
                    echo '<th class="task-table-header">';
                        echo 'Status';
                        ?>
                        <form action="<?php the_permalink() ?>" method="post" class="search-form">
                                <input type="text" name="search_by_status" id="search_by_name" class="search-input">
                                <input 
                                                    id="submit" 
                                                    name="submit" 
                                                    type="submit"  
                                                    class="submit" 
                                                    value=""
                                                    style="
                                                        background-image:url(<?php echo plugins_url( '../img/search.webp', __FILE__) ?>);
                                                        background-repeat: no-repeat;
                                                        background-size: 20px;
                                                        background-position: center;
                                                        border-radius: 5px;
                                                        padding: 5px 20px;
                                                
                                                    "
                                                >
                            </form>
                        <?php
                    echo '</th>';
                }//end if status
                switch ($slug) {
                    case 'task-manager':
                        echo '<th class="task-table-header">';
                            echo "Task type";
                        echo '</th>';
                    break;
                    }
                echo '<th class="task-table-header">';
                    echo 'Sprint month';
                    ?> 
                        <form action="<?php the_permalink() ?>" method="post" class="search-form">
                            <input type="text" name="search_by_sprint" id="search_by_sprint" class="search-input">
                            <input 
                                                id="submit" 
                                                name="submit" 
                                                type="submit"  
                                                class="submit" 
                                                value=""
                                                style="
                                                    background-image:url(<?php echo plugins_url( '../img/search.webp', __FILE__) ?>);
                                                    background-repeat: no-repeat;
                                                    background-size: 20px;
                                                    background-position: center;
                                                    border-radius: 5px;
                                                    padding: 5px 20px;
                                            
                                                "
                                            >
                        </form>
                    <?php
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Site name';
                    ?> 
                    <form action="<?php the_permalink() ?>" method="post" class="search-form">
                        <?php
                        $taxonomyName = "client";
                        //This gets top layer terms only.  This is done by setting parent to 0.  
                        $parent_terms = get_terms( $taxonomyName, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );   
                        echo '<select name="search_by_site" id="search_by_site" class="search-input">';
                            echo '<option>Please select</option>';
                        foreach ( $parent_terms as $pterm ) {
                            //Get the Child terms
                            $terms = get_terms( $taxonomyName, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                            foreach ( $terms as $term ) {
                                echo '<option value="' . $term->term_id . '" ><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></option>';   
                            }
                        }
                        echo '</select>';
                    ?>
                        <input 
                                            id="submit" 
                                            name="submit" 
                                            type="submit"  
                                            class="submit" 
                                            value=""
                                            style="
                                                background-image:url(<?php echo plugins_url( '../img/search.webp', __FILE__) ?>);
                                                background-repeat: no-repeat;
                                                background-size: 20px;
                                                background-position: center;
                                                border-radius: 5px;
                                                padding: 5px 20px;
                                        
                                            "
                                        >
                    </form>
                <?php
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Client';
                echo '</th>';

                echo '<th class="task-table-header">';
                    echo 'Update';
                echo '</th>';
            echo '</tr>';

            if ( $queryWorkflow->have_posts() ) : 
                while ( $queryWorkflow->have_posts() ) : $queryWorkflow->the_post();
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
                        echo '<tr>';
                        ?>
                            <form action="<?php the_permalink() ?>" method="post" class="comment-form">
                                    <input type="hidden" id="contentUrl" name="contentUrl" value="<?php  echo $contentUrl; ?>">

                        <?php
                            echo '<td class="tasks-post">';
                                echo '<a href="'.get_permalink().'" rel="bookmark" >';
                                    the_title();
                                echo '</a>';
                                ?>
                                <input type="hidden" name="title" id="title" value="<?php echo the_title() ?>"> 
                                <input type="hidden" name="content" id="content" value="<?php echo get_the_content() ?>">
                                <?php
                            echo '</td>';

                                ?>       
                                    <td class="tasks-post_image">
                                        <!--<img src="<?php echo $get_author_gravatar ?>" alt="<?php get_the_title() ?>" />-->
                                        <div class="task-user-name">    
                                                <select 
                                                        name="assing_to_field" 
                                                        id="assing_to_field" 
                                                        class="select_field"
                                                    >
                                                    <?php
                                                        if(empty($assignedTo)){
                                                            echo '<option value="">Please Select an user</option>';
                                                        }else{
                                                            echo '<option value="'.$assignedTo[0].'/'.$assignedTo[1].'">'.$assignedTo[0].'</option>';
                                                        }
                                                            foreach ($users as $key => $user) {
                                                                echo '<option value="'.$user->display_name.'/'.$user->ID.'">';
                                                                    echo $user->display_name;
                                                                echo '</option>';
                                                        }
                                                    
                                                        
                                                    ?>
                                                </select>
                                        </div>
                                    </td>

                                    <td class="tasks-post">
                                        <?php the_time('m/d/y');?>
                                    </td>
                                    <td class="tasks-post">
                                        <div class="sprint_field">    
                                        <select 
                                            name="sprint_field" 
                                            id="sprint_field"
                                            class="select_field"
                                        >
                                            <?php
                                                if(empty($sprintField)){
                                                    echo '<option value="">Please Select an month</option>';
                                                }else{
                                                    echo '<option value="'.$sprintField.'">'.$sprintField.'</option>';
                                                }
                                            ?>
                                            
                                            <?php
                                                foreach ($sprints as $key => $sprint) {
                                                    echo '<option value="'.$sprint.'">';
                                                        echo $sprint;
                                                    echo '</option>';
                                                }
                                            ?>
                                        </select>
                                        </div>
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
                                    
                                    <td class="tasks-post">
                                        <?php
                                            $postterms = wp_get_post_terms($post->ID, $taxonomyClient);
                                            if(!empty($postterms)){
                                                if($postterms[0]->parent == 0){
                                                    echo $postterms[0]->name;
                                                }else{
                                                    $parentId = $postterms[0]->parent;
                                                    $parentObj = get_term_by('id', $parentId, $taxonomyClient);
                                                    echo $parentObj->name;
                                                    
                                                }
                                                
                                            }
                                        ?>
                                    </td> 
                                        <?php wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' ); ?>
                                    <td class="tasks-post">
                                        <input 
                                            id="submit" 
                                            name="submit" 
                                            type="submit"  
                                            class="submit" 
                                            value=""
                                            style="
                                                background-image:url(<?php echo plugins_url( '../img/update.webp', __FILE__) ?>);
                                                background-repeat: no-repeat;
                                                background-size: 20px;
                                                background-position: center;
                                                border-radius: 5px;
                                                padding: 10px 20px;
                                        
                                            "
                                        >
                                    </td>

                                </form>
                            
                            <?php
                        echo '</tr>';
                    }//en
                endwhile; 
                wp_reset_postdata();
            else : 
                echo '<p>esc_html_e( "Sorry, no posts matched your criteria." ); </p>';
            endif;
        echo '</table>';
    echo '</div>';// class="posts-full-container"
get_footer();
?>
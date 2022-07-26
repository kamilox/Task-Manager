<?php
global $post;
$slug = get_post_type();
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
                <?php  if($slug == 'task'){ ?>
                    <td class="tasks-post">
                        <div class="status_field">    
                            <select 
                                name="status_field" 
                                id="status_field" 
                                class="select_field"
                            >
                                <?php
                                    if(empty($statusField)){
                                        echo '<option value="">Please Select an status</option>';
                                    }else{
                                        echo '<option value="'.$statusField.'">'.$statusField.'</option>';
                                    }
                                ?>
                                <?php
                                    foreach ($statuses as $key => $status) {
                                        echo '<option value="'.$status.'">';
                                            echo $status;
                                        echo '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </td>
                <?php  } ?>
				<?php  if($slug == 'task'){ ?>
                	<td class="tasks-post">
                        <div class="task_type_field">    
                            <select 
                                name="task_type_field" 
                                id="task_type_field" 
                                class="select_field"
                            >
                                <?php
                                    if(empty($taskTypeField)){
                                        echo '<option value="">Please Select an task type</option>';
                                    }else{
                                        echo '<option value="'.$taskTypeField.'">'.$taskTypeField.'</option>';
                                    }
                                ?>
                                <?php
                                    foreach ($tasks_types as $key => $task_type) {
                                        echo '<option value="'.$task_type.'">';
                                            echo $task_type;
                                        echo '</option>';
                                    }
                                ?>
                            </select>
                        </div>                     
                	</td>
				<?php } ?>  
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
                            background-image:url(<?php echo plugins_url( '../../img/update.webp', __FILE__) ?>);
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
?>
<?php
/*
*	Template Name: Single Workflow
*
*/

//Capture and update data from content page
require_once('templates/wf_add_class_list.php');
require_once('templates/wf_run_class.php');
global $wp, $wpdb, $post;
$url = $wp->request;

$posts = get_posts(array(
    'posts_per_page' => 1,
    'post_type' => 'workflow',
    'post_status' => 'publish'
));
$id = $posts[0]->ID;

$sprintField = get_post_meta( $id, 'sprint_field', true );
$assing_to_field = explode('/',get_post_meta( $id, 'assing_to_field', true )); 
$workflowTasksArray = get_post_meta( $id, 'tasks_array', true ); // Get the saved values
$workflowArrayDecode = json_decode($workflowTasksArray); 

$content_post = get_post($id);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

if ( isset( $_POST['_singular_form_workflow'] ) ) {

    if ( isset( $_POST['assing_to_field'] ) ) {
        $sanitized_assigned     = wp_filter_post_kses( $_POST['assing_to_field'] );
        update_post_meta( $id, 'assing_to_field', $sanitized_assigned );
    }
    if ( isset( $_POST['sprint_field'] ) ) {
        $sanitized_sprint       = wp_filter_post_kses( $_POST['sprint_field'] );
        update_post_meta( $id, 'sprint_field', $sanitized_sprint );
    }
    if ( isset( $_POST['tasks_array'] ) ) {
        $sanitized_task_type    = wp_filter_post_kses( $_POST['tasks_array'] );
        update_post_meta( $id, 'tasks_array', $sanitized_task_type );
	}

    
    $userID = explode('/', $_POST['assing_to_field']);
    $user = get_user_by( 'id', $userID[1] );
    $userName = $user->display_name;
    $to = $user->user_email;
    $subject = 'workflow assigned to you from:'. $_POST['title'] ;
    $body = the_content() ;
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $email = false;
    $email = wp_mail( $to, $subject, $body, $headers/*, $attachments */);
   
    
	wp_redirect(get_the_permalink());
}

if ( isset( $_POST['_namespace_form_metabox_process'] ) ) {
   
    if ( isset( $_POST['assing_to_field'] ) ) {
        $sanitized_assigned     = wp_filter_post_kses( $_POST['assing_to_field'] );
        update_post_meta( $id, 'assing_to_field', $sanitized_assigned );
    }
    if ( isset( $_POST['sprint_field'] ) ) {
        $sanitized_sprint       = wp_filter_post_kses( $_POST['sprint_field'] );
        update_post_meta( $post->ID, 'sprint_field', $sanitized_sprint );
    }

    if ( isset( $_POST['tasks_array'] ) ) {
        $sanitized_task_type    = wp_filter_post_kses( $_POST['tasks_array'] );
        update_post_meta( $post->ID, 'tasks_array', $sanitized_task_type );
	}
    

    $userID = explode('/', $_POST['assing_to_field']);
    $user = get_user_by( 'id', $userID[1] );
    $userName = $user->display_name;
    $to = $user->user_email;
    $subject = 'workflow assigned to you from:' .$_POST['title'] ;
    $body = $_POST['content']  ;
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
	$email = false;
    $email = wp_mail( $to, $subject, $body, $headers/*, $attachments */);
   
    wp_redirect($_POST['contentUrl']);
}

get_header();
    $list = new OptionsList();
    $statuses = $list->getStatus();
    $sprints = $list->getSprints();
    //taxonomies
    $taxonomyActions = 'actions';
    $taxonomyClient = 'client';
    $sitesNames = ( wp_get_post_terms($id, $taxonomyClient));
    foreach ($sitesNames as $key => $siteName) {
        $termClientChild = $siteName->name;
    }
    

    //post workflow detail
    echo '<div class="post-workflow-container">';
        ?>
        <form action="<?php echo the_permalink()?>" method="post" class="comment-form"> 
            <div class="post-workflow-container-title">
                <h1>
                    <?php echo the_title(); ?>
                    <input type="hidden" name="title" id="title" value="<?php echo the_title(); ?>">
                </h1>
            </div>

            <div class="post-workflow-container-website">
                <p> <strong>Website:</strong> <?php if(isset( $termClientChild)){
                                                        echo $termClientChild;
                                                    } ?>
                </p> 
            </div>

            <div class="post-workflow-container-workflow-due">
                <p> <strong>workflow Due:</strong></p> 
                <fieldset>
                    <table>
                        <tr>
                            <th>
                                <label for="multiple_task_workflow_field">
                                    <?php _e('Workflow tasks:'); ?>
                                </label>
                            </th>
                            <th>
                                <label for="multiple_task_due_workflow_field">
                                    <?php _e('Task due:'); ?>
                                </label>
                            </th>
                            <th>
                                <label for="multiple_task_due_workflow_field">
                                    <?php _e('Status:'); ?>
                                </label>
                            </th>
                            <th>
                                <label for="multiple_task_actions_workflow_field">
                                    <?php _e('Actions'); ?>
                                </label>
                            </th>
                        </tr>
                        <tbody>
                                <?php 
                                    if(isset($workflowArrayDecode) && !empty($workflowArrayDecode)){
                                        $list = new OptionsList();
                                        $workflowTaskStatus = $list->getWorkflowTaskStatus();
                                        foreach ($workflowArrayDecode as $key => $value) {
                                            if ($value->status != 'Completed') {
                                                echo '<tr class="workflow-tasks-container">';
                                                    echo '<td class="workflow-tasks">';
                                                        echo ' <input  type="text" 
                                                                        name="multiple_task_workflow_field" 
                                                                        id="multiple_task_workflow_field"
                                                                        class="multiple_task_workflow_field"
                                                                        value="'.$value->task.'"
                                                                >';
                                                    echo '</td>';
                                                    echo  '<td class="workflow-due-date">';
                                                        echo'    <input  type="date" 
                                                                    name="multiple_task_due_workflow_field" 
                                                                    id="multiple_task_due_workflow_field"
                                                                    class="multiple_task_due_workflow_field"
                                                                    value="'.$value->date.'"
                                                            >';
                                                    echo'</td>';
                                                    echo  '<td class="workflow-task-status">';
                                                        
                                                        echo'<select
                                                                name="multiple_task_status_workflow_field" 
                                                                id="multiple_task_status_workflow_field"
                                                                class="multiple_task_status_workflow_field"
                                                                value="'.$value->status.'"
                                                            >';
                                                        
                                                            echo '<option value="'.$value->status.'">'.$value->status.'</option>';
                                                                foreach ($workflowTaskStatus as $key => $worflowTask) {
                                                                    echo '<option value="'.$worflowTask.'">'.$worflowTask.'</option>';
                                                                }
                                                            
                                                        echo '</select>';
                                                    echo'</td>';
                                                    echo '<td class="actions-buttons">';
                                                        echo '<div class="clone-row">';
                                                            echo '+';
                                                        echo '</div>';
                                                        echo '<div class="remove-row">';
                                                            echo '-';
                                                        echo '</div>';
                                                    echo '</td>';
                                                echo '</tr>';
                                            }//en if
                                        }// end foreach
                                    }else{
                                        echo '<tr class="workflow-tasks-container">';
                                            echo '<td class="workflow-tasks">';
                                                echo '<input  type="text" 
                                                        name="multiple_task_workflow_field" 
                                                        id="multiple_task_workflow_field"
                                                        class="multiple_task_workflow_field"
                                                        value=""
                                                >';
                                            echo '</td>';
                                            echo  '<td class="workflow-due-date">';
                                                echo'    <input  type="date" 
                                                            name="multiple_task_due_workflow_field" 
                                                            id="multiple_task_due_workflow_field"
                                                            class="multiple_task_due_workflow_field"
                                                            value=""
                                                    >';
                                            echo'</td>';
                                            echo  '<td class="workflow-task-status">';
                                                    $list = new OptionsList();
                                                    $workflowTaskStatus = $list->getWorkflowTaskStatus();
                                                    echo'<select
                                                            name="multiple_task_status_workflow_field" 
                                                            id="multiple_task_status_workflow_field"
                                                            class="multiple_task_status_workflow_field"
                                                            value=""
                                                        >';
                                                            foreach ($workflowTaskStatus as $key => $worflowTask) {
                                                                echo '<option value="'.$worflowTask.'">'.$worflowTask.'</option>';
                                                            }
                                                        
                                                    echo '</select>';
                                                echo'</td>';
                                            echo '<td class="actions-buttons">';
                                                echo '<div class="clone-row">';
                                                    echo '+';
                                                echo '</div>';
                                                echo '<div class="remove-row">';
                                                    echo '-';
                                                echo '</div>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" id="tasks_array" name="tasks_array" value="">
                </fieldset>
            </div>

            <div class="post-workflow-container-description">
                <p> <strong>Description</strong>
                    <div>
                        <?php echo $content; ?>
                    </div>
					<input type="hidden" name="content" id="content" value="<?php echo $content; ?>">
            	</p> 
            </div>

            <div class="post-workflow-container-sprint-field">
                <p> 
                    <strong>Sprint Month:  </strong>
                    <select 
                                name="sprint_field" 
                                id="sprint_field" 
                            >
                            <?php
                                    if(empty($sprintField)){
                                        echo '<option value="">Please Select an Type od workflow</option>';
                                    }else{
                                        echo '<option value="'.$sprintField.'">'.$sprintField.'</option>';
                                    }
                                    foreach ($sprints as $key => $sprint) {
                                        echo '<option value="'.$sprint.'">';
                                            echo $sprint;
                                        echo '</option>';
                                    }
                            ?>
                    </select>
                </p> 
            </div>

            <div class="post-workflow-container-assing-to-field">
                <p> <strong>Assing To: </strong>
                    <select 
                        name="assing_to_field" 
                        id="assing_to_field" 
                        class="select_field"
                    >
                    <?php
                        if(empty($assing_to_field)){
                            echo '<option value="">Please Select an user</option>';
                        }else{
                            echo '<option value="'.$assing_to_field[0].'/'.$assing_to_field[1].'">'.$assing_to_field[0].'</option>';
                        }
                            $AllUsers = new GlobalVariables();
                            $users = $AllUsers->getUsers();
                    
                        foreach ($users as $key => $user) {
                            echo '<option value="'.$user->display_name.'/'.$user->ID.'">';
                                echo $user->display_name;
                            echo '</option>';
                        }
                    ?>
                </select>
                
                </p> 
            </div>

            <?php
                wp_nonce_field( '_singular_form_metabox_nonce', '_singular_form_workflow' );

            ?>
                <div>
                    <input 
                        id="submit" 
                        name="submit" 
                        type="submit"  
                        class="submit" 
                        value="Update"
                        style="
                            background-image:url(<?php echo plugins_url( '/../img/update.webp', __FILE__) ?>);
                            background-repeat: no-repeat;
                            background-size: 20px;
                            background-position-x: 5px;
                            background-position-y: center;
                            border-radius: 5px;
                            padding: 10px 20px 10px 30px;
                        "
                        >
                </div>
        </form>
    </div>
<?php
get_footer();
?>
<?php

require_once('templates/wf_add_class_list.php');
require_once('templates/wf_run_class.php');
function create_assign_to_field_workflow() {
    $page = 'workflow';
    $context = 'normal';
    $priority = 'high';

    add_meta_box( 'assigned-to', 'Assinged to', 'render_assing_to_field_workflow',$page, $context, $priority );
    add_meta_box( 'sprint-field', 'Sprint', 'render_sprint_field_workflow',$page, $context, $priority );
    add_meta_box( 'multiple-task-workflow-field', 'Workflow tasks', 'render_multiple_task_workflow_field',$page, $context, $priority );
}
add_action( 'add_meta_boxes', 'create_assign_to_field_workflow' );

function render_assing_to_field_workflow($post){
    global $post; // Get the current post data
	$assignedTo = explode('/', get_post_meta( $post->ID, 'assing_to_field', true )); // Get the saved values
    
    ?>
    <!--Assinged to field -->
        <fieldset>    
            <div class="custom-fields">
                <div class="custom-fields-title">
                    <label for="assing_to_field">
                        <?php _e('Assigned to:'); ?>
                    </label>
                </div>
                <div class="custom-fields-input">
                    
                    <select 
                            name="assing_to_field" 
                            id="assing_to_field" 
                        >
                        <?php
                             if(empty($assignedTo[0])){
                                echo '<option value="">Please Select an user</option>';
                            }else{
                                echo '<option value="'.$assignedTo[0].'/'.$assignedTo[1].'">'.$assignedTo[0].'</option>';
                            }
                        ?>
                        <?php
                            $AllUsers = new GlobalVariables();
                            $users = $AllUsers->getUsers();
                            foreach ($users as $key => $user) {
                                echo '<option value="'.$user->display_name.'/'.$user->ID.'">';
                                    echo $user->display_name;                    
                                echo '</option>';
                            }
                        ?>
                    </select>
                    
                </div>
            </div>
        </fieldset>
    <?php
    wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );
}

function render_sprint_field_workflow($post){
    global $post; // Get the current post data
	$sprintField = get_post_meta( $post->ID, 'sprint_field', true ); // Get the saved values
    ?>
    <!-- sprint field -->
        <fieldset>    
            <div class="custom-fields">
                <div class="custom-fields-title">
                    <label for="sprint_field">
                        <?php _e('Sprint month:'); ?>
                    </label>
                </div>
                <div class="custom-fields-input">
                    <select 
                        name="sprint_field" 
                        id="sprint_field" 
                    >
                        <?php
                            if(empty($sprintField)){
                                echo '<option value="">Please Select an month</option>';
                            }else{
                                echo '<option value="'.$sprintField.'">'.$sprintField.'</option>';
                            }
                        ?>
                        
                        <?php
                            $list = new OptionsList();
                            $sprints = $list->getSprints();
                            foreach ($sprints as $key => $sprint) {
                                
                                echo '<option value="'.$sprint.'">';
                                    echo $sprint;
                                echo '</option>';
                            }
                        ?>
                    </select>
                    
                </div>
            </div>
        </fieldset>

    <?php
    wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );
}

function render_multiple_task_workflow_field($post){
    require_once('templates/wf_add_class_list.php');
    require_once('templates/wf_run_class.php');
    
    global $post; // Get the current post data
	$workflowTasksArray = get_post_meta( $post->ID, 'tasks_array', true ); // Get the saved values
    $workflowMultipleTaskDue = get_post_meta( $post->ID, 'multiple_task_due_workflow_field', true ); // Get the saved values
    ?>
    <!-- task_type field -->
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
                            if(isset($workflowTasksArray) && !empty($workflowTasksArray)){
                                $list = new OptionsList();
                                $workflowTaskStatus = $list->getWorkflowTaskStatus();
                                $taskArrayDecode = json_decode($workflowTasksArray);
                                foreach ($taskArrayDecode as $key => $value) {
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
                                    }//end if
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

    <?php
    wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );
}
/**
 * Save the metabox
 * @param  Number $post_id The post ID
 * @param  Array  $post    The post data
 */
function save_assigned_task_workflow( $post_id, $post ) {
    
	// Verify that our security field exists. If not, bail.
	if ( !isset( $_POST['_namespace_form_metabox_process'] ) ) return;

	// Verify data came from edit/dashboard screen
	if ( !wp_verify_nonce( $_POST['_namespace_form_metabox_process'], '_namespace_form_metabox_nonce' ) ) {
		return $post->ID;
	}

	// Verify user has permission to edit post
	if ( !current_user_can( 'edit_post', $post->ID )) {
		return $post->ID;
	}

    
	// Check that our custom fields are being passed along
	// This is the `name` value array. We can grab all
	// of the fields and their values at once.
	if ( !isset( $_POST['assing_to_field'] ) ) {
		return $post->ID;
	}

    if ( !isset( $_POST['sprint_field'] ) ) {
		return $post->ID;
	}

    if ( !isset( $_POST['tasks_array'] ) ) {
		return $post->ID;
	}

   

    //Send email notification
    $user = get_user_by( 'id', $_POST['user-id'] );
    $userName = $user->display_name;
    $to = $user->email;
    $subject = $_POST['title'] ;
    $body = $_POST['content'] ;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    wp_mail( $to, $subject, $body, $headers );
	/**
	 * Sanitize the submitted data
	 * This keeps malicious code out of our database.
	 * `wp_filter_post_kses` strips our dangerous server values
	 * and allows through anything you can include a post.
	 */
	$sanitized_assigned     = wp_filter_post_kses( $_POST['assing_to_field'] );
    $sanitized_sprint       = wp_filter_post_kses( $_POST['sprint_field'] );
    $sanitized_task_type    = wp_filter_post_kses( $_POST['tasks_array'] );
    
	// Save our submissions to the database
	update_post_meta( $post->ID, 'assing_to_field', $sanitized_assigned );
    update_post_meta( $post->ID, 'sprint_field', $sanitized_sprint );
    update_post_meta( $post->ID, 'tasks_array', $sanitized_task_type );
}
add_action( 'save_post', 'save_assigned_task_workflow', 1, 2 );
?>
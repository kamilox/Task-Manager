<?php
function create_assign_to_field() {
    $page = 'task';
    $context = 'normal';
    $priority = 'high';

    add_meta_box( 'assigned-to', 'Assinged to', 'render_assing_to_field',$page, $context, $priority );
    add_meta_box( 'status-field', 'Status', 'render_status_field',$page, $context, $priority );
    add_meta_box( 'sprint-field', 'Sprint', 'render_sprint_field',$page, $context, $priority );
    add_meta_box( 'task-type-field', 'Task type', 'render_task_type_field',$page, $context, $priority );
    add_meta_box( 'article-link-field', 'Article link', 'render_article_link_field',$page, $context, $priority );
    add_meta_box( 'keywords-field', 'Keywords', 'render_keywords_field',$page, $context, $priority );
}
add_action( 'add_meta_boxes', 'create_assign_to_field' );

function render_assing_to_field($post){
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

function render_status_field($post){
    global $post; // Get the current post data
	$statusField = get_post_meta( $post->ID, 'status_field', true ); // Get the saved values
    ?>
    <!-- Status field -->
        <fieldset>    
            <div class="custom-fields">
                <div class="custom-fields-title">
                    <label for="status_field">
                        <?php _e('Status task:'); ?>
                    </label>
                </div>
                <div class="custom-fields-input">
                    <select 
                        name="status_field" 
                        id="status_field"
                    >
                        <?php
                            if(empty($statusField)){
                               echo '<option value="">Please Select an status</option>';
                           }else{
                               echo '<option value="'.$statusField.'">'.$statusField.'</option>';
                           }
                        ?>
                        
                        <?php
                            $list = new OptionsList();
                            $statuses = $list->getStatus();
                            foreach ($statuses as $key => $status) {
                                
                                echo '<option value="'.$status.'">';
                                    echo $status;
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

function render_sprint_field($post){
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

function render_task_type_field($post){
    global $post; // Get the current post data
	$taskTypeField = get_post_meta( $post->ID, 'task_type_field', true ); // Get the saved values
    ?>
    <!-- task_type field -->
        <fieldset>    
            <div class="custom-fields">
                <div class="custom-fields-title">
                    <label for="task_type_field">
                        <?php _e('Task type:'); ?>
                    </label>
                </div>
                <div class="custom-fields-input">
                    <select 
                        name="task_type_field" 
                        id="task_type_field"
                    >
                        <?php
                            if(empty($taskTypeField)){
                                echo '<option value="">Please Select an Type Task</option>';
                            }else{
                                echo '<option value="'.$taskTypeField.'">'.$taskTypeField.'</option>';
                            }
                        ?>
                        
                        <?php
                            $list = new OptionsList();
                            $tasks_types = $list->getTasksypes();
                            foreach ($tasks_types as $key => $task_type) {
                                
                                echo '<option value="'.$task_type.'">';
                                    echo $task_type;
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

function render_article_link_field($post){
    global $post; // Get the current post data
	$articleLinkField = get_post_meta( $post->ID, 'article_link_field', true ); // Get the saved values
    ?>
    <!-- task_type field -->
        <fieldset>    
            <div class="custom-fields">
                <div class="custom-fields-title">
                    <label for="article_link_field">
                        <?php _e('Article link:'); ?>
                    </label>
                </div>
                <div class="custom-fields-input">
                    <input 
                        type = "text"
                        name="article_link_field" 
                        id="article_link_field" 
                        value="<?php echo esc_attr( $articleLinkField ); ?>"
                    >
                </div>
            </div>
        </fieldset>

    <?php
    wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );
}

function render_keywords_field($post){
    global $post; // Get the current post data
	$keywordsField = get_post_meta( $post->ID, 'keywords_field', true ); // Get the saved values
    ?>
    <!-- task_type field -->
        <fieldset>    
            <div class="custom-fields">
                <div class="custom-fields-title">
                    <label for="keywords_field">
                        <?php _e('Keywords:'); ?>
                    </label>
                </div>
                <div class="custom-fields-input">
                    <input 
                        type = text
                        name="keywords_field" 
                        id="keywords_field" 
                        value="<?php echo esc_attr( $keywordsField ); ?>"
                    >
                    
                </div>
            </div>
        </fieldset>

    <?php
    wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );
}
 
/**
 * Save the metabox
 * @param  Number $post_id The post ID
 * @param  Array  $post    The post data
 */
function save_assigned_task( $post_id, $post ) {

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
    if ( !isset( $_POST['status_field'] ) ) {
		return $post->ID;
	}

    if ( !isset( $_POST['sprint_field'] ) ) {
		return $post->ID;
	}

    if ( !isset( $_POST['task_type_field'] ) ) {
		return $post->ID;
	}

    if ( !isset( $_POST['article_link_field'] ) ) {
		return $post->ID;
	}

    if ( !isset( $_POST['keywords_field'] ) ) {
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
    $sanitized_status       = wp_filter_post_kses( $_POST['status_field'] );
    $sanitized_sprint       = wp_filter_post_kses( $_POST['sprint_field'] );
    $sanitized_task_type    = wp_filter_post_kses( $_POST['task_type_field'] );
    $sanitized_article_link_field   = wp_filter_post_kses( $_POST['article_link_field'] );
    $sanitized_keywords_field   = wp_filter_post_kses( $_POST['keywords_field'] );

    
	// Save our submissions to the database
	update_post_meta( $post->ID, 'assing_to_field', $sanitized_assigned );
    update_post_meta( $post->ID, 'status_field', $sanitized_status );
    update_post_meta( $post->ID, 'sprint_field', $sanitized_sprint );
    update_post_meta( $post->ID, 'task_type_field', $sanitized_task_type );
    update_post_meta( $post->ID, 'article_link_field', $sanitized_article_link_field );
    update_post_meta( $post->ID, 'keywords_field', $sanitized_keywords_field );
    

}
add_action( 'save_post', 'save_assigned_task', 1, 2 );

?>
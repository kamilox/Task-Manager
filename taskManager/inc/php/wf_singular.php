<?php
/*
*	Template Name: Single Task
*
*/

//Capture and update data from content page
require_once('templates/wf_add_class_list.php');
global $wp, $wpdb, $post;
$url = $wp->request;

$posts = get_posts(array(
    'posts_per_page' => 1,
    'post_type' => 'task',
    'post_status' => 'publish'
));
$id = $posts[0]->ID;

$statusField = get_post_meta( $id, 'status_field', true );
$taskTypeField = get_post_meta( $post->ID, 'task_type_field', true ); // Get the saved values
$sprintField = get_post_meta( $post->ID, 'sprint_field', true );
$article_link_field = get_post_meta( $id, 'article_link_field', true );
$assing_to_field = explode('/',get_post_meta( $id, 'assing_to_field', true )); 
$keywords_field = get_post_meta( $id, 'keywords_field', true );
$content_post = get_post($id);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

if ( isset( $_POST['_singular_form'] ) ) {

    if ( isset( $_POST['assing_to_field'] ) ) {
        $sanitized_assigned     = wp_filter_post_kses( $_POST['assing_to_field'] );
        update_post_meta( $id, 'assing_to_field', $sanitized_assigned );
    }
    if ( isset( $_POST['status_field'] ) ) {
        $sanitized_status       = wp_filter_post_kses( $_POST['status_field'] );
        update_post_meta( $id, 'status_field', $sanitized_status );
    }
    if ( isset( $_POST['sprint_field'] ) ) {
        $sanitized_sprint       = wp_filter_post_kses( $_POST['sprint_field'] );
        update_post_meta( $id, 'sprint_field', $sanitized_sprint );
    }
    if ( isset( $_POST['task_type_field'] ) ) {
        $sanitized_task_type_field = wp_filter_post_kses( $_POST['task_type_field'] );
        update_post_meta( $id, 'task_type_field', $sanitized_task_type_field );
    }
    
    $userID = explode('/', $_POST['assing_to_field']);
    $user = get_user_by( 'id', $userID[1] );

    $userName = $user->display_name;
    $to = $user->user_email;
    $subject = 'Task assigned to you from:'. $_POST['title'] ;
    $body = the_content() ;
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $email = false;
    $email = wp_mail( $to, $subject, $body, $headers/*, $attachments */);
   
    
	wp_redirect(get_the_permalink());
}

if ( isset( $_POST['_namespace_form_metabox_process'] ) ) {
   
    if ( isset( $_POST['assing_to_field'] ) ) {
        $sanitized_assigned     = wp_filter_post_kses( $_POST['assing_to_field'] );
        update_post_meta( $post->ID, 'assing_to_field', $sanitized_assigned );
    }
    if ( isset( $_POST['status_field'] ) ) {
        $sanitized_status       = wp_filter_post_kses( $_POST['status_field'] );
        update_post_meta( $post->ID, 'status_field', $sanitized_status );
    }
    if ( isset( $_POST['sprint_field'] ) ) {
        $sanitized_sprint       = wp_filter_post_kses( $_POST['sprint_field'] );
        update_post_meta( $post->ID, 'sprint_field', $sanitized_sprint );
    }
    if ( isset( $_POST['task_type_field'] ) ) {
        $sanitized_task_type_field = wp_filter_post_kses( $_POST['task_type_field'] );
        update_post_meta( $post->ID, 'task_type_field', $sanitized_task_type_field );
    }

    $userID = explode('/', $_POST['assing_to_field']);
    $user = get_user_by( 'id', $userID[1] );
    $userName = $user->display_name;
    $to = $user->user_email;
    $subject = 'Task assigned to you from:' .$_POST['title'] ;
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
    $tasks_types = $list->getTasksypes();
    //taxonomies
    $taxonomyActions = 'actions';
    $taxonomyClient = 'client';
    $sitesNames = ( wp_get_post_terms($id, $taxonomyClient));
    foreach ($sitesNames as $key => $siteName) {
        $termClientChild = $siteName->name;
    }
    

    //post task detail
    echo '<div class="post-task-container">';
        ?>
        <form action="<?php echo the_permalink()?>" method="post" class="comment-form"> 
            <div class="post-task-container-title">
                <h1>
                    <?php echo the_title(); ?>
                    <input type="hidden" name="title" id="title" value="<?php echo the_title(); ?>">
                </h1>
            </div>

            <div class="post-task-container-website">
                <p> <strong>Website:</strong> <?php if(isset( $termClientChild)){
                                                        echo $termClientChild;
                                                    } ?>
                </p> 
            </div>

            <div class="post-task-container-status">
                <p> 
                    <strong>Status: </strong>
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
                                    foreach ($statuses as $key => $status) {
                                        echo '<option value="'.$status.'">';
                                            echo $status;
                                        echo '</option>';
                                    }
                            ?>
                    </select>
                </p> 
            </div>

            <div class="post-task-container-task-type">
                <p> 
                    <strong>Task Type: </strong>
                    <select 
                                name="task_type_field" 
                                id="task_type_field" 
                            >
                            <?php
                                if(empty($taskTypeField)){
                                    echo '<option value="">Please Select an TypeTask</option>';
                                }else{
                                    echo '<option value="'.$taskTypeField.'">'.$taskTypeField.'</option>';
                                }
                                
                                foreach ($tasks_types as $key => $task_type) {
                            
                                    echo '<option value="'.$task_type.'">';
                                        echo $task_type;
                                    echo '</option>';
                                }
                            ?>
                    </select>
                </p>
            </div>

            <div class="post-task-container-task-due">
                <p> <strong>Task Due:</strong> Soon </p> 
            </div>

            <div class="post-task-container-description">
                <p> <strong>Description</strong>
                    <div>
                        <?php echo $content; ?>
                    </div>
					<input type="hidden" name="content" id="content" value="<?php echo $content; ?>">
            	</p> 
            </div>

            <div class="post-task-container-sprint-field">
                <p> 
                    <strong>Sprint Month:  </strong>
                    <select 
                                name="sprint_field" 
                                id="sprint_field" 
                            >
                            <?php
                                    if(empty($sprintField)){
                                        echo '<option value="">Please Select an Type od Task</option>';
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

            <div class="post-task-container-article-link">
                <p> <strong>Article Link: </strong>
                <a href="<?php echo $article_link_field ?>">
                    <input type="text" name="article-link" id="article-link"  value="<?php echo $article_link_field ?>"/>
                </a>
            </p> 
            </div>

            <div class="post-task-container-assing-to-field">
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

            <div class="post-task-container-assing-to-field">
                <p> <strong>Keywords: </strong><?php echo $keywords_field ?></p> 
            </div>
            <?php
                wp_nonce_field( '_singular_form_metabox_nonce', '_singular_form' );

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
<?php

/*
*	Template Name: Client form
*
*/

if(is_user_logged_in()){
    global $current_user;
    wp_get_current_user();
    $taxonomy = 'client';
    $user_login = $current_user->user_login;
    $user_email = $current_user->user_email;
    $user_firstname = $current_user->user_firstname;
    $user_lastname = $current_user->user_lastname;
    $user_id = $current_user->ID;
    $user_slug = strtolower($user_firstname.'-'.$user_lastname);
    $term = get_term_by( 'slug', $user_slug, $taxonomy );
    $terms_children = get_term_children( $term->term_id, $taxonomy );

	if(isset($_POST['_client_form'])){
		$post_title = $_POST['title'];
        $post_name = implode('-', explode(' ',strtolower($post_title)));
		//$sample_image = $_FILES['sample_image']['name'];
		$post_content = $_POST['sample_content'];
        $term = intval($_POST['site']);

		$new_post = array(
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_status' => 'publish',
			'post_name' => $post_name ,
			'post_type' => 'task'
		);

		$pid = wp_insert_post($new_post);
        wp_set_post_terms( $pid, $term, $taxonomy );

        $sanitized_assigned     = wp_filter_post_kses( $_POST['assing_to_field'] );
        update_post_meta( $pid , 'assing_to_field', $sanitized_assigned );

        wp_redirect(home_url().'/client-task-manager'.'/');
        // Saving files
        /*if (!function_exists('wp_generate_attachment_metadata'))
		{
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		}

        if ($_FILES)
		{
            foreach ($_FILES as $file => $array)
			{
				if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK)
				{
					return "upload error : " . $_FILES[$file]['error'];
				}
				$attach_id = media_handle_upload( $file, $pid );
			}
		}

        if ($attach_id > 0)
		{
			//and if you want to set that image as Post then use:
			update_post_meta($pid, '_thumbnail_id', $attach_id);
		}

		$my_post1 = get_post($attach_id);
		$my_post2 = get_post($pid);
		$my_post = array_merge($my_post1, $my_post2);*/

        
        // End saving files
    }// end if(isset($_POST['_client_form'])){
}// end if(is_user_logged_in())
else
{
	echo "<h2 style='text-align:center;'>User must be login for add post!</h2>";
}

get_header();
?>
    <div class="posts-full-container">
        <form method="post" action="<?php get_the_permalink(); ?>" enctype="multipart/form-data"> 
            <div class="col-sm-12" >
                <h1 style="text-align: center;">Add new task</h1>
                <form class="form-horizontal" name="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="ispost" value="1" />
                    <input type="hidden" name="userid" value="" />
                    <div class="col-md-12" style="display:flex; flex-direction: column;">
                        <label class="control-label">Title</label>
                        <input type="text" class="form-control" name="title" />
                    </div>

                    <div class="col-md-12">
                        <label class="control-label">Description</label>
                        <textarea class="form-control" name="sample_content"></textarea>
                    </div>

                    <div class="col-md-12" style="display:flex; flex-direction: column;">
                        <label class="control-label">Site name</label>
                        <select class="form-control" name="site" id="site">
                            <?php
                                foreach ($terms_children as $key => $term_child_id) {
                                    $term_child = (get_term_by('id', $term_child_id, $taxonomy ));
                                    echo '<option value="'.$term_child_id.'">'.$term_child->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <?php 
                        $userAssing = (get_user_by('login', 'robert'));
                    
                    ?>
                    <input type="hidden" name="assing_to_field" id="assing_to_field" value="<?php echo $userAssing->display_name.'/'.$userAssing->ID ?> ">
                    <!--<div class="col-md-12">
                        <label class="control-label">Upload Post Image</label>
                        <input type="file" name="sample_image" class="form-control" />
                    </div>-->

                    <?php wp_nonce_field( '_singular_form_client_nonce', '_client_form' ); ?>
                    <div class="col-md-12" style="margin: 20px 0;">
                        <input type="submit" class="btn btn-primary" value="SUBMIT" name="submitpost" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </form>

    </div><!-- // form container -->

<?
get_footer();
?>
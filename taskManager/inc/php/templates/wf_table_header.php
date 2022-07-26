<?php
/*
* 
* Template name: Page content 
*
*
*/

require_once('wf_add_class_list.php');
require_once('wf_run_class.php');
require_once('wf_queries.php');
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
                                            background-image:url(<?php echo plugins_url( '../../img/restore.webp', __FILE__) ?>);
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
                                                background-image:url(<?php echo plugins_url( '../../img/search.webp', __FILE__) ?>);
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
                                                    background-image:url(<?php echo plugins_url( '../../img/search.webp', __FILE__) ?>);
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
                                                background-image:url(<?php echo plugins_url( '../../img/search.webp', __FILE__) ?>);
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
                                            background-image:url(<?php echo plugins_url( '../../img/search.webp', __FILE__) ?>);
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
?>
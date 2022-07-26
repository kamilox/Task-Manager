<h2>Select default procedure from the list</></h2>

<form id="default_options_form_data" method="post">
		
		<ul id="default_options_checkbox_list">
			<li class="parent_procedure"><strong> Kind of task </strong>
				<ul style="margin:5px 0 0 15px">
                    <?php $simple = term_exists( 'simple', 'actions' ); // array is returned if taxonomy is given 
                        if(!isset($simple)){?>
                            <li><input type="checkbox" name="task-actions[]" value="simple"> Simple</li>
                    <?php } ?>

                    <?php $recurrent = term_exists( 'Recurrent', 'actions' ); // array is returned if taxonomy is given 
                        if(!isset($recurrent)){?>
					        <li><input type="checkbox" name="task-actions[]" value="recurrent"> Recurrent</li>
                    <?php } ?>
				</ul>
			</li>
		</ul>

		<input type="submit" name="form_submit" class="button-primary add-actions" value="Submit" >
		</form>
<?php
	if($_POST){
        require_once('wf_add_actions.php');
    }else{
        echo "Please select the actions";
    }
?>
jQuery(document).ready(function(){
    jQuery(document).on('blur','.multiple_task_due_workflow_field, .multiple_task_workflow_field, .multiple_task_status_workflow_field', function(e){
        e.preventDefault();
        processWorkFlow(this);
    });
    

    i = 0;
    jQuery(document).on('click','.clone-row', function(e){
        e.preventDefault();
        i++;
        var newRow = jQuery('.workflow-tasks-container:last').clone();
        jQuery(newRow).children('td').children('input').val(''); 
        jQuery(newRow).insertAfter('.workflow-tasks-container:last');
    });

    jQuery(document).on('click','.remove-row', function(e){
        e.preventDefault();
        
        if(jQuery(".workflow-tasks-container").length > 1)
            jQuery(jQuery(this).closest('tr')).remove();
        
        processWorkFlow()
       
    });
    
    function processWorkFlow(){
        var myObject = new Object();
        var  myList = [];
        jQuery('td .multiple_task_workflow_field').each(function(){
            myList.push({
                task: jQuery(this).val(),
                date: jQuery(this).parent().siblings('.workflow-due-date').children('.multiple_task_due_workflow_field').val(),
                status: jQuery(this).parent().siblings('.workflow-task-status').children('.multiple_task_status_workflow_field').val()
            })
            jQuery('#tasks_array').val(JSON.stringify(myList));
        });
        console.log(jQuery('#tasks_array').val());
    }
    
    jQuery('.surgisculpt-icon').click(function(){
        jQuery('.p5marketing_parent_class').toggle();
    });
});
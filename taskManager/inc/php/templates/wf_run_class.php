<?php
$list = new OptionsList();
$statuses = $list->getStatus();
$sprints = $list->getSprints();
$tasks_types = $list->getTasksypes();
$workflowTaskStatus = $list->getWorkflowTaskStatus();
$AllUsers = new GlobalVariables();
$users = $AllUsers->getUsers();
?>
<?php
    class OptionsList{
        function __construct(){
            $this->statuses = ['1st proof - Andrea','2nd Proof Irene','Client Proof','Completed','In Progress','Not Started','Posting','Waiting','Writing Frase Draft (RD)'];
            $this->sprints = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December'];
            $this->tasksTypes = ['AdWords','Backlink Article','Blog Article','CORA','Cornerstone Content','Develop','focus','GMB Weekly Post','Internal Operations','Irene Proof','Meeting with Client','Press Release','Recode website','Social Post','Sprint Tasks','Technical SEO','Technical support','Tier 1 Backlinks','Tier 2 Backlinks','Web Page Content'];
            $this->workflowTaskStatus = ['Not Started','In Progress','Completed'];
        }
        public function getStatus(){
            return $this->statuses;
        }
        public function getSprints(){
            return $this->sprints;
        }
        public function getTasksypes(){
            return $this->tasksTypes;
        }
        public function getWorkflowTaskStatus(){
            return $this->workflowTaskStatus;
        }
    }

    class GlobalVariables{
        public function getUsers(){
            $users = get_users( array( 'role__in' => array( 'administrator', 'User' ) ) );
            return $users;
        }
    }
?>
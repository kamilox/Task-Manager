<?php
    class OptionsList{
        function __construct(){
            $this->statuses = ['In Progress', 'Not Started', 'Writing Frase Draft (RD)', '1st proof - Andrea', '2nd Proof Irene', 'Client Proof', 'Posting', 'Completed', 'Waiting'];
            $this->sprints = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December'];
            $this->tasksTypes = ['Backlink Article','Blog Article','Web Page Content','GMB Weekly Post','Sprint Tasks','Tier 1 Backlinks','Tier 2 Backlinks','Cornerstone Content','Technical SEO','Technical support','AdWords','Meeting with Client','Internal Operations','Recode website','Develop','CORA','Technical support','focus','Press Release','Irene Proof','Social Post'];
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
    }
?>
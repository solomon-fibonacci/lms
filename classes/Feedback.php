<?php include_once "DataModel.php"; ?>

<?php
    //this class defines the db table 'feedback'
    //all class properties are db fields
    class Feedback extends DataModel {
        public $student;
        public $title;
        public $year;
        public $author;
        public $time;
        public $seen;
    }
?>
    
<?php include_once "DataModel.php"; ?>

<?php
    //this class defines the db table 'contact'
    //all class properties are db fields
    class Contact extends DataModel {
        public $student;
        public $message;
        public $isRead;
        public $time;
    }
?>
    
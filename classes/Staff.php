<?php include_once "DataModel.php"; ?>

<?php
    //this class defines the db table 'staff'
    //all class properties are db fields
    class Staff extends DataModel{
        public $username;
        public $password;
        public $isLibrarian;
    }
?>
<?php include_once "DataModel.php"; ?>

<?php
    //this class defines the db table 'student'
    //all class properties are db fields
    class Student extends DataModel{
        public $studentNo;
        public $email;
        public $dob;
        public $address;
        public $isActive;
        public $firstName;
        public $lastName;
        public $regDate;
        public $lastLogin;
        public $password;
        public $approvalDate;
    }
?>
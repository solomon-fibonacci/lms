<?php include_once "DataModel.php"; ?>

<?php
    //this class defines the db table 'booking'
    //all class properties are db fields
    class Booking extends DataModel{
        public $student;
        public $book;
        public $bookTitle;
        public $dateTime;
        public $returnDateTime;
        public $isReturned; //1=>book has been returned; 0=>unreturned
        public $isOverdue; //1=>overdue for return, 0=>not yet due for return
        public $isExpired; //1=>booking expired, 0=>booking still valid
        public $isClaimed; //1=>book collected, 0=>book yet to be collected
        public $expiryDate;
        public $dueDate;
    }
?>
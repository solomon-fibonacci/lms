<?php include_once "DataModel.php"; ?>


<?php
    //this class defines the db table 'book'
    //all class properties are db fields
    class Book extends DataModel{
        public $isbn;  
        public $title;
        public $author;
        public $year;
        public $status; //in or out
        public $quantity;
        public $borrowed;
        public $remaining;
        public $category;
        public $type;
        public $borrowCount;
        public $timeAdded;
        public $increaseTime;
        public $addedBy;
    }
?>
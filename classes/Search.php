<?php
    include_once "DataModel.php";
    
    // this class provides db connection for the search class
    // extends the DataModel class since its abtract
    class DBConnect extends DataModel{
        
    }
    
    
    // search class
    // search objects are intantiated from a query string
    // results are stored in a property
    class Search {
        private $qString; //query string
        private $results; //result property
        private $db; //this property handles interfacing with the db
        
               
        public function __construct($qString){ // object constructor
            $this->qString = $qString;
        }
             
        public function getResult(){
            if (isNullOrEmptyString($this->qString)){
                $this->results[] = "Query String cannot be empty";
            }else{
                $this->db = DBConnect::connectDB();
                if(preg_match('/\s/', $this->qString)){ // if string contains whitespace
                    $keywords = preg_split('/ +/', $this->qString); // split query string into array of keywords
                    
                    // search book titles
                    $bookResult = array();
                    foreach($keywords as $keyword){
                        $query = "SELECT * FROM Book WHERE title LIKE '%{$keyword}%'";
                        $result = $this->db->query($query);
                        while($row = $result->fetch_object()){
                            $bookResult[] = $row;
                        }
                    }
                    
                    
                    // search book types
                    $bookTypeResult = array();
                    foreach($keywords as $keyword){
                        $query = "SELECT * FROM Book WHERE type LIKE '%{$keyword}%'";
                        $result = $this->db->query($query);
                        while($row = $result->fetch_object()){
                            $bookTypeResult[] = $row;
                        }
                    }
                    
                    // search book categories
                    $bookCatResult = array();
                    foreach($keywords as $keyword){
                        $query = "SELECT * FROM Book WHERE category LIKE '%{$keyword}%'";
                        $result = $this->db->query($query);
                        while($row = $result->fetch_object()){
                            $bookCatResult[] = $row;
                        }
                    }
                    
                    // search book authors
                    $bookAuthorResult = array();
                    foreach($keywords as $keyword){
                        $query = "SELECT * FROM Book WHERE author LIKE '%{$keyword}%'";
                        $result = $this->db->query($query);
                        while($row = $result->fetch_object()){
                            $bookAuthorResult[] = $row;
                        }
                    }
                    
                    
                    // search students
                    $userResult = array();
                    
                    // search with first name
                    foreach($keywords as $keyword){
                        $query = "SELECT * FROM Student WHERE firstName LIKE '%{$keyword}%'";
                        $result = $this->db->query($query);
                        while($row = $result->fetch_object()){
                            $userResult[] = $row;
                        }
                    }
                    
                    // search with last name
                    foreach($keywords as $keyword){
                        $query = "SELECT * FROM Student WHERE lastName LIKE '%{$keyword}%'";
                        $result = $this->db->query($query);
                        while($row = $result->fetch_object()){
                            $userResult[] = $row;
                        }
                    }
                    
                    
                }else{ //querystring is a without whitespace
                    
                    // search books
                    $bookResult = array(); 
                    $query = "SELECT * FROM Book WHERE title LIKE '%{$this->qString}%'";
                    $result = $this->db->query($query);
                    while($row = $result->fetch_object()){
                        $bookResult[] = $row;
                    }
                    
                    //search book categories
                    $bookCatResult = array();
                    $query = "SELECT * FROM Book WHERE category LIKE '%{$this->qString}%'";
                    $result = $this->db->query($query);
                    while($row = $result->fetch_object()){
                        $bookCatResult[] = $row;
                    }
                    
                    //search book types
                    $bookTypeResult = array();
                    $query = "SELECT * FROM Book WHERE type LIKE '%{$this->qString}%'";
                    $result = $this->db->query($query);
                    while($row = $result->fetch_object()){
                        $bookTypeResult[] = $row;
                    }
                    
                    //search authors
                    $bookAuthorResult = array();
                    $query = "SELECT * FROM Book WHERE author LIKE '%{$this->qString}%'";
                    $result = $this->db->query($query);
                    while($row = $result->fetch_object()){
                        $bookAuthorResult[] = $row;
                    }
                    
                    //search students
                    
                    //search with firstname
                    $userResult = array();
                    $query = "SELECT * FROM Student WHERE firstName LIKE '%{$this->qString}%'";
                    $result = $this->db->query($query);
                    while($row = $result->fetch_object()){
                        $userResult[] = $row;
                    }
                    
                    //search with last name
                    $query = "SELECT * FROM Student WHERE lastName LIKE '%{$this->qString}%'";
                    $result = $this->db->query($query);
                    while($row = $result->fetch_object()){
                        $userResult[] = $row;
                    }
                }
                
                // combine all results into one array
                $this->results = array(
                    "bookResult"=>$bookResult,
                    "bookAuthorResult"=>$bookAuthorResult,
                    "bookCatResult"=>$bookCatResult,
                    "bookTypeResult"=>$bookTypeResult,
                    "userResult"=>$userResult
                );
                               
                return $this->results;
            }
        }
    }
    
?>
<?php include_once '../helper/functions.php'; ?>

<?php
    // This class handles all database related aspects of the project
    // queries are built and made here. A convinient API is provided
    // to be used in the scripts.
    // All database table have been defined in different class files
    // and all extent his class.
    //
    // it abstract and hence cant be intantiated on its own.
    // Useless unless extended!
    abstract class DataModel {
        public $id; //id field, common to every table
        private static $db; //static db object, only used within the class
        private static $filters = array();  //array of fields to be used for "where" queries      
        public static function connectDB(){ 
            include '../config.php'; // $dbhost, $dbuser, $dbpass and $dbname are all defined here
            self::$db =  new mysqli("$dbhost", "$dbuser", "$dbpass", "$dbname");
            if (self::$db->connect_error) { // if there's error in connection
                die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
            }
            return self::$db;
        }
        
        //function for basic "SELECT...WHERE" statement
        public static function filter($table, $fields){ 
            $queryType = "filter";
            include '../helper/retrieve_data.php'; //query and data rertrieval are handled here
            return $querySet;
        }
        
        //function for "SELECT...WHERE...ORDER BY... LIMIT" statement
        //this is static because the 
        public static function xfilter($table, $fields, $orderBy, $limit){
            $queryType = "xfilter"; 
            include '../helper/retrieve_data.php';
            return $querySet;
        }
        
        
        //function to query single entry from db, can only return one data object
        public static function get($table, $fields){
            $queryType = "get";
            
            include '../helper/retrieve_data.php';
            return $dataobj;
        }
        
        //function to delete entry from a given table
        public function delete($table){
            $this->connectDB();
            $query = "DELETE FROM {$table} WHERE id=".$this->id;
            if(self::$db->query($query)){
                return true;
            }else{
                return false;
            }
        }
        
        //function to save data into db
        public function save($table){
            self::connectDB();
            $fields = get_object_vars($this); //array of fields from class properties
            $fieldsCount = count($fields);
            $query = "REPLACE INTO {$table} ("; 
            $i = 1;
            foreach ($fields as $fieldName => $fieldValue) {
                $i++;
                $query .= $fieldName;
                if ($i < $fieldsCount+1) {
                    $query .= ", ";
                }
            }
            $i = 1;
            $query .= ") VALUES (";
            foreach ($fields as $fieldName => $fieldValue) {
                $i++;
                $query .= "'";
                $query .= $fieldValue;
                $query .= "'";
                if ($i < $fieldsCount+1) {
                    $query .= ",";
                }
            }
            $query .= ")";
            self::$db->query($query);
        }
    }
    
?>
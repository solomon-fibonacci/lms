<?php
    self::connectDB();
    $query = "";
    if ($queryType == "filter" && $fields == "ALL") { // basic "SELECT *" query
        $query = "SELECT * FROM {$table}";
        $result = self::$db->query($query);
        if(!$result){
            die(self::$db->error);
        }
    }elseif($queryType == "xfilter" && $fields == "ALL"){ // "SELECT * FROM ... ORDER BY... LIMIT..."
        if($limit != ""){ //if limit is specified
            $query = "SELECT * FROM {$table} ORDER BY {$orderBy} DESC LIMIT {$limit}";
        }else{ // limit is not specified
            $query = "SELECT * FROM {$table} ORDER BY {$orderBy} DESC";
        }
        $result = self::$db->query($query);
        if(!$result){
            die(self::$db->error);
        }
    }elseif($queryType=="get" || $queryType=="filter" || $queryType=="xfilter"){
        self::$filters = []; // array to hold fields for "WHERE" clause
        
        foreach($fields as $key => $value){
            
            if (property_exists($table, $key)){ // if the class has a corresponding property as the field provided
                self::$filters[$key] = $value; // array is populated
                
            }
        }
        
        $first_clause_value = reset(self::$filters); //set array pointer to the first element
        
        
        $first_clause_key = key(self::$filters); //get the key of the first array element
        unset(self::$filters[$first_clause_key]); //remove first set of key-value paires from the filter
        if ($first_clause_key && !is_null($first_clause_value)){ //if first key-value pair are valid
            $query = "SELECT * FROM {$table} "; //build query
            $query .= "WHERE {$first_clause_key} = ";
            $query .= "'";
            $query .= "{$first_clause_value}";
            $query .= "'";
        } 
        if (count(self::$filters)>0){
            foreach(self::$filters as $key => $value){
                $query .= " AND {$key} = '";
                $query .= "{$value}'";
            }
        }
        
        if ($queryType == "xfilter"){
            $query .= " ORDER BY {$orderBy} DESC LIMIT {$limit}";
        }
        $result = self::$db->query($query);
        if(!$result){
            print $query . "<br/>";
            die(self::$db->error);
        }
    }
    
    
    // the following lines prepare the results as either queryset(as in the case of "filter" and "xfilter")
    // or data object as in the case of "get". in both cases, null is returned of result is empty
    if ($queryType == "filter" or $queryType == "xfilter") {
        $querySet = array();
        while($dataobj = $result->fetch_object()) {
            //cast the objects to conform with the class here
            //all fields that go into db are public
            $dataobj = objToObj($dataobj, $table);
            $querySet[] = $dataobj;
        }
        if(count($querySet) == 0){
            $querySet = NULL;
        }
    } elseif ($queryType == "get") {
        if($result->num_rows == 1) {
            $dataobj = $result->fetch_object();
            $dataobj = objToObj($dataobj, $table);
        } else {
            $dataobj = NULL;
        }   
    } else {
    
    }
    
?>
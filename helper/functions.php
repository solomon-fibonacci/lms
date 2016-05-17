<?php

    // cast a given object to another class
    function objToObj($instance, $endClass){
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($endClass),
            $endClass,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }
    
    // add day, month or year to a given date
    function add_date($givendate, $day=0, $mth=0, $yr=0){
        $cd = strtotime($givendate);
        $newdate =  date(
                        'Y-m-d h:i:s',
                        mktime(
                            date('h', $cd),
                            date('i', $cd),
                            date('s', $cd),
                            date('m', $cd)+$mth,
                            date('d', $cd)+$day,
                            date('Y', $cd)+$yr
                        )
                    );
        return $newdate;
    }
    
    // check if a string string is null or empty
    function isNullOrEmptyString($qString){
        return(!isset($qString)||trim($qString)===' ');
    }
        
?>
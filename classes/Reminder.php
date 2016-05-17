<?php
    include_once "Booking.php";
    
    // class to generate reminder for a given student
    class Reminder {
        private static $student;
        
        public static function getReminder($student){
            self::$student = $student;
            //get all unclaimed bookings
            $rawUnclaimeds = Booking::filter("Booking", array("student"=>self::$student, "isClaimed"=>0, "isExpired"=>0));
            $unclaimeds = [];
            //remove unclaimed bookings that have expired
            if(is_array($rawUnclaimeds)){
                foreach($rawUnclaimeds as $rawUnclaimed){
                    if ($rawUnclaimed->expiryDate < date('Y-m-d H:i:s')){
                        continue;
                    }
                    $unclaimeds[] = $rawUnclaimed;
                }
                
                //unreturned books but not overdue
                $unreturneds = Booking::filter("Booking", array("student"=>self::$student, "isClaimed"=>1, "isReturned"=>0, "isOverdue"=>0));
                //overdue books
                $overdues = Booking::filter("Booking", array("student"=>self::$student, "isClaimed"=>1, "isReturned"=>0, "isOverdue"=>1));
                // reminder combines unclaimed, unreturned and overdue books into one array 
                $reminders = array("unclaimeds"=>$unclaimeds, "unreturneds"=>$unreturneds, "overdues"=>$overdues);
                return $reminders;
            }
        }
    }
    
?>
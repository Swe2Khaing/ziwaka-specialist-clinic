<?php

class config
{
	function getRecords($conn)
    {
		$query="SELECT * FROM booking 
		INNER JOIN doctor ON doctor.Do_ID=booking.Do_ID 
		INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid
		INNER JOIN times ON times.TID=booking.TID";
		$result=mysqli_query($conn,$query);
		return $result;
	}
	function getRecordsWhere($conn,$date)
    {
		
       if($date != "---Select---")
	   {
		$query="SELECT * FROM booking 
		INNER JOIN doctor ON doctor.Do_ID=booking.Do_ID 
		INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid
		INNER JOIN times ON times.TID=booking.TID where booking.date = '$date'";
		$result=mysqli_query($conn,$query);
		return $result;
	   }
	   else
	   {
		$query="SELECT * FROM booking 
		INNER JOIN doctor ON doctor.Do_ID=booking.Do_ID 
		INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid
		INNER JOIN times ON times.TID=booking.TID";
		$result=mysqli_query($conn,$query);
		return $result;
	   }		
	}

	function getTextRecord($con,$data)
	{
		$query="SELECT * FROM booking 
		INNER JOIN doctor ON doctor.Do_ID=booking.Do_ID 
		INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid
		INNER JOIN times ON times.TID=booking.TID WHERE CONCAT(`Name`, `Phone`, `Age`, `AC`, `date`,`pname`, `Do_ID`, `TID`) LIKE '%".$data."%'";
		$result=mysqli_query($con,$query);
		return $result;
	}

	function getDataLimit($con,$data)
	{
         if($data != "---All---")
		 {
            $query="SELECT * FROM `tblproduct` limit ".$data." ";
		    $result=mysqli_query($con,$query);
		    return $result;
		 }
		 else
		 {
            $query="SELECT * FROM `tblproduct`";
		    $result=mysqli_query($con,$query);
		    return $result;
		 }		
	}	
	
}

?>

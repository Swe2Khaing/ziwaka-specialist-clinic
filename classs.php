<?php

class classs
{
	function getRecords($con)
    {
		$query="SELECT * from inpatient";
		$result=mysqli_query($con,$query);
		return $result;
	}
	/*function getRecordsWhere($con,$price)
    {
       if($price != "---Select---")
	   {
		$query="SELECT * from tblproduct where price < ".$price."";
		$result=mysqli_query($con,$query);
		return $result;
	   }
	   else
	   {
		$query="SELECT * from tblproduct ";
		$result=mysqli_query($con,$query);
		return $result;
	   }*/		
	

	function getTextRecord($con,$data)
	{
		$query="SELECT * FROM `inpatient` WHERE CONCAT(`Adm_Date`, `Adm_time`, `Inp_name`, `Age`, `AC`, `Gender`, `Ph_no`, `Querter`, `Village`, `City`, `Dc_Date`, `Death_Date`, `Death_Time`) LIKE '%".$data."%'";
		$result=mysqli_query($con,$query);
		return $result;
	}

	/*function getDataLimit($con,$data)
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
	}	*/
	
}

?>

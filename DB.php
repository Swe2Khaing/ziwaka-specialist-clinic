<?php

class db
{
    function getRecordsWhere($con,$price)
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
	   }		
	}
}

?>

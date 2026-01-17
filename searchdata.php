<table   class="table table-striped table-responsive">
	<tr>
				<th>#</th>
				<th>Admission Date</th>
				<th>Name</th>
				<th>Age</th>
				<th>Age Units</th>
				<th>Phone</th>
				<th>Querter</th>
				<th>Village</th>
				<th>City</th>
	</tr>
<?php
require('config.php');
require('classs.php');
$db = new classs;
$row1="";
$result1=$db->getTextRecord($conn,$_POST['result']);
$i=1;


	while($row1=mysqli_fetch_array($result1))
	{
		echo "<tr>
					<td>".$i++."</td>
					<td>".$row1['Adm_Date']."</td>
					<td>".$row1['Inp_name']."</td>					
					<td>".$row1['Age']."</td>
					<td>".$row1['AC']."</td>
					<td>".$row1['Ph_no']."</td>
					<td>".$row1['Querter']."</td>
					<td>".$row1['Village']."</td>
					<td>".$row1['City']."</td>
				</tr>";
	}




?>
</table>
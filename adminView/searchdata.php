<table   class="table table-striped table-responsive">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Code</th>
		<th>Image</th>
		<th>Price</th>
	</tr>
<?php
require('db.php');
require('config.php');
$db = new db;

$result1=$db->getTextRecord($conn,$_POST['result']);
$i=1;


	while($row1=mysqli_fetch_array($result1))
	{
		echo "<tr>
			<td>".$i++."</td>
			<td>".$row1['name']."</td>
			<td>".$row1['code']."</td>
			<td> <img src= '".$row1['image']."' width='20' height='20'></td>
			<td>".$row1['price']."</td>
		</tr>";
	}




?>
</table>
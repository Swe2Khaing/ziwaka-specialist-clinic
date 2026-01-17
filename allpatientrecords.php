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
				<th>Action</th>
			</tr>
			<?php
			require('config.php');
			require('classs.php');
			$db = new classs;
			$result=$db->getRecords($conn);
			$i=1;
			while($row=mysqli_fetch_array($result))
			{
				echo "<tr>
					<td>".$i++."</td>
					<td>".$row['Adm_Date']."</td>
					<td>".$row['Inp_name']."</td>					
					<td>".$row['Age']."</td>
					<td>".$row['AC']."</td>
					<td>".$row['Ph_no']."</td>
					<td>".$row['Querter']."</td>
					<td>".$row['Village']."</td>
					<td>".$row['City']."</td>
					<td>
    
   <span class='btn btn-info btn-sm'><a style='color:white' href='patientDetail.php?pid=".$row['InP_ID']."   '>Edit</a></span>&nbsp;
   

    </td>
				</tr>";
			}
			
			?>
</table>
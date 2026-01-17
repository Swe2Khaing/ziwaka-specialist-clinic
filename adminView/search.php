





















<table   class="table table-striped table-responsive">
			<tr>
			<th width="10%">Name</th>
   <th width="3%">Phone</th>
  <th width="3%">Age</th>		  
   <th width="5%">Ac</th>
   <th width="15%">Doctor</th>
   <th width="10%">DATE</th>
    <th width="15%">Part of a day</th>
    <th width="10%">Start Time</th>
    <th width="10%">End Time</th>
  
			</tr>
			<?php
			require('config.php');
			require('function.php');
			$db = new config;
			$result1=$db->getRecordsWhere($conn,$_POST['selected_price']);
			
			while($row=mysqli_fetch_array($result1))
   				{
  				
   			echo "<tr>
			  

								<td>". $row['Name']."</td>
                               <td>". $row['Phone']."</td>							 
                               <td>". $row['Age']."</td>
                               <td>". $row['AC']."</td>
                               <td>". $row['Do_Name']."</td>
                               <td>".$row['date']."</td>
                               <td>". $row['pname']."</td>
                               <td>". $row['Start']."</td>
                               <td>". $row['End']."</td>
                               								  
			</tr>";
			}

			
			?>
			
</table>
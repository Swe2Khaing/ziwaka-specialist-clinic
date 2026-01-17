<?php
require 'config.php';
$res = mysqli_query($conn,"SELECT inpatient.InP_ID,inpatient.Adm_Date, inpatient.Adm_Time,inpatient.Inp_name,inpatient.Age,inpatient.AC,inpatient.Gender,inpatient.Ph_no,inpatient.Querter,inpatient.Village,
inpatient.City, doctor.Do_Name,adm_dx.Adm_Dx, adm_dx.Adm_Dx_In_Myan, dc_dx.Dc_Dx,dc_dx.Dc_Dx_In_Myan,inpatient.Dc_Date,inpatient.Dc_Time
FROM inpatient
INNER JOIN treated ON inpatient.InP_ID=treated.InP_ID
INNER JOIN doctor ON treated.Do_ID=doctor.Do_ID
INNER JOIN adm_dx ON adm_dx.InP_ID=inpatient.InP_ID
INNER JOIN dc_dx ON dc_dx.InP_ID=inpatient.InP_ID");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>aa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <style>
        @media screen and (max-width:500px){
          
        }
       
        
    </style>
  </head>
  <body>
<div class="container table-responsive table-bordred table-hover" style="background-color: lightblue;">   
 <table class="table"> 
<thead>
<tr>

  <th width="5%">ID</th>
   <th width="10%">Name</th>
  <th width="10%">Age</th>		  
   <th width="15%">Ac</th>
   <th width="18%">Querter</th>
   <th width="18%">Village</th>
   <th width="18%">City</th>
   											                                  
    
</tr>
 </thead>
 <tbody>
<?php 
$i=1;
while($row=mysqli_fetch_array($res))
   {
   ?>
		<tr>
		  <td class="serial"><?php echo $i++  ?></td>		  
                               <td><?php echo $row['Inp_name']?></td>							 
                               <td><?php echo $row['Age']?></td>
                               <td><?php echo $row['AC']?></td>
                               <td><?php echo $row['Querter']?></td>
                               <td><?php echo $row['Village']?></td>
                               <td><?php echo $row['City']?></td>								  
  <td>
<?php
echo "<a class='btn btn-sm' style='color:rgb(128, 0, 0)' href='?uid=".$row['InP_ID']."'>Detail</a></span>&nbsp; ";   
 ?>
  </td>
</tr>
<?php } ?>
 </tbody>
  </table>
 </div>
 </body>
</html>
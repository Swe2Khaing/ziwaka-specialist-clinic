


<?php
require 'config.php';
$row="";
$did="";
/*===========================================================================*/
if(isset($_GET['did']) && $_GET['did']!='' )
{
    
    $did= $_GET['did'];

    $ress=mysqli_query($conn,"SELECT * FROM schedule 
    INNER JOIN doctor ON doctor.Do_ID=schedule.Do_ID
    INNER JOIN day ON schedule.D_ID=day.D_ID
    INNER JOIN times ON times.TID=schedule.TID
    INNER JOIN part_of_a_day ON part_of_a_day.pid=times.pid
     where doctor.Do_ID='$did'");
   

}
/*========================================================================*/
?>

<?php
$row="";
$did="";
/*===========================================================================*/
if(isset($_GET['did']) && $_GET['did']!='' )
{
    
    $did= $_GET['did'];

    $res=mysqli_query($conn,"SELECT * FROM schedule 
    INNER JOIN doctor ON doctor.Do_ID=schedule.Do_ID
    INNER JOIN day ON schedule.D_ID=day.D_ID
    INNER JOIN times ON times.TID=schedule.TID
    INNER JOIN part_of_a_day ON part_of_a_day.pid=times.pid
     where doctor.Do_ID='$did'");
   $row1=mysqli_fetch_assoc($res);
   $name=$row1['Do_Name'];
   $specialist = $row1["Specialist"];

}
?>




 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <title>Document</title>
    <style>
        .table{
            height:100vh;
            
            
        }
        .hh{
        font-size:50px;
        color: aliceblue;
        display: flex;
        text-align:center;
        justify-content:center;
        align-items: center;
      }
    </style>
</head>
<body>



<?php
/*============================= Update =====================================*/

if(isset($_POST['submit']))
{

    
    $did=$_GET['did'];
    $day = $_POST["day"];
    $pday = $_POST["pday"];
    $start = $_POST["start"];
    $end = $_POST["end"];
   
   
      
    mysqli_query($conn,"INSERT INTO  schedule(D_ID, ) VALUES(");
    
      $query = array(
        'did' => $did 
        
       );          
  
        $query = http_build_query($query); 

        echo
      "<script> alert('Registration Successful'); </script>";
        header("Location:doctorSchedule.php?$query"); 
     
    }


/*============================= Update =====================================*/
?>


    <div class="modal fade" id="insertDoctor">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-white"  style="background: linear-gradient(#31B7C2,#02b23d);">
					<div class="modal-title">
          <h2>Assign Schedule</h2>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">

                <form action="" method="post"  autocomplete='on'>
        <div class="row">
            <div class="col-6">
                <label for="name">Name :</label><br>
                <label for="female">Specialist</label><br>
                <label for="female">Day</label><br>
                <label for="female">Time</label><br>
                <label for="female">Time</label><br>
                
            </div>
            <div class="col-6">
                <input type="text" id="name" name="name" required value="<?php echo $name; ?>"   readonly><br>
                <input type="text" id="specialist" name="specialist" value="<?php echo $specialist; ?>" readonly><br>



           
            <select name="day" id="day" style="border: 1px solid #5cd65c;color:black;" class="form-control"/>
            <option value="">Select Day</option>
            <?php 
                                             $query="select * from day";
                                            $res = mysqli_query($conn, $query);
                                           while($rowd = mysqli_fetch_array($res))
                                              { ?>
                <option value="<?php echo $rowd['D_ID']; ?>" > <?php echo $rowd['Day']; ?> </option>
                <?php } ?>
            </select>
            
           

            <select name="time" id="time" style="border: 1px solid #5cd65c;color:black;" class="form-control">
            <option value="">Select Time</option>
                                                
            <?php 
                $query="select * from times";
                $res = mysqli_query($conn, $query);
                while($rowp = mysqli_fetch_array($res))
            { ?>
                <option value="<?php echo $rowp['TID']; ?>" > <?php echo $rowp['Start']; ?> <?php echo $rowp['End']; ?></option>
                <?php } ?>
            </select>

            <select name="pday" id="pday" style="border: 1px solid #5cd65c;color:black;" class="form-control">
    
            </select>
           
            


                
            </div>
        </div>
        <div class="row aa">
        <button class="btn btn-success" type="submit" name="submit"  style="margin:10px;width:100%;background: linear-gradient(#31B7C2,#02b23d);">Assign</button>
        
        </div>
    </form>
                </div>
					
				</div>
				
			
			</div>
		</div>
	</div>

   

<div class="container-fluid table-responsive " style="background: linear-gradient(#31B7C2,#02b23d);">  
<div class="row hh" style="height:100px"> 
        <img src="./img/zlogo.png" alt="" style="width: 95px;height: 95px;">
      <h1 class="hh"> Doctor Schedules</h1>


      </div>
<div class="row" >
				
				
				<div class="col-md-6">
					<a href="#" class="btn btn-primary btn-block m-1" style="border-radius:0%;" data-toggle="modal" data-target="#insertDoctor"><i class="fa fa-users"></i> Assign Schedule </a>
				</div>
				
				<div class="col-md-6">
					<a href="doctortable.php" class="btn btn-danger btn-block m-1 " style="border-radius:0%;" ><i class="fa fa-angle-double-left"></i>&nbsp;Go Back</a>
				</div>
				
			
			</div>

<div class="container-fluid table-responsive table-bordred table-hover" style="background: linear-gradient(#31B7C2,#02b23d);">
<table class="table" style="background:linear-gradient(#31B7C2,#02b23d);">
    
    <tr >
        <th  width="5%" class="serial">#</th>       
        <th width="18%">Doctor</th>
        <th width="25%">Specialist</th>
        <th width="10%">Day</th>
        <th width="10%">Part Of a Day</th>         
        <th width="10%">Start Time</th> 
        <th width="10%">End Time</th>     
        <th width="30%">Action</th>               
    </tr>

<?php
$i=1;
while($row=mysqli_fetch_assoc($ress))   

{?>
    <tr >
        <td><?php echo $i; ?></td>
        <td><?php echo $row['Do_Name'] ?></td>
        <td><?php echo $row['Specialist'] ?></td>
        <td><?php echo $row['day_in_myan'] ?></td>
        <td><?php echo $row['pname'] ?></td>
        <td><?php echo $row['Start'] ?></td>
        <td><?php echo $row['End'] ?></td>
        <td>
    <?php
    echo "<span class='btn btn-primary btn-sm'><a style='color:white' href='editSchedule.php?sid=".$row['S_ID']."&did=".$row['Do_ID']."'>Edit</a></span>&nbsp;";
    echo "<span class='btn btn-danger btn-sm'><a style='color:white' href='?type=delete&sid=".$row['S_ID']."&did=".$row['Do_ID']."'>Delete</a></span>; ";
    
?>
    </td>
    </tr>
 
<?php
$i++;

}

?>
    </table>
    </div>
 
    <script>
         $(document).ready(function() {
            $('#time').on('change', function() {
        var tid = this.value;
        alert(tid);
        $.ajax({
            url: "timeDrop.php",
            type: "POST",
            data: {
                tid:tid
            },
            cache: false,
            success: function(result) {
                $("#pday").html(result);
            }
        });
    });
});
      </script>
    </body>
</html>

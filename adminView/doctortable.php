<?php
require 'config.php';
$res = mysqli_query($conn,"SELECT * FROM doctor "); 
?>
<?php
$fileName="";
$tmpName="";
if(isset($_POST["submit"]))
 {
        $name = $_POST["name"];
        $phone =$_POST["phone"];
        $eductaion=$_POST["education"];
        $specialist=$_POST["specialist"];
        $email=$_POST["email"];
        $file = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];     
       

        $img_extension = pathinfo($file, PATHINFO_EXTENSION);        
         
    if(!in_array($img_extension,['jpg','jpeg','png','gif','JPEG','JPG'])) 
    {
            echo "<script>alert('Something wrong in file type choice!')</script>";       
    }
    else
    {
       
             $newImageName =date("Y.m.d") . "-" . date("h.i.sa") . "-" . $file;

             move_uploaded_file($tmpName, 'img/' . $newImageName);
             $query = "INSERT INTO doctor VALUES('','$newImageName', '$name','$phone','$eductaion', '$specialist','$email')";
             mysqli_query($conn, $query);
             header("Location:doctortable.php");        
         }

        }      
 

?>
<?php
if(isset($_GET['type'] )&& $_GET['type']!='')
{
 $type=$_GET['type'];
 if($type=='delete')
 {
    
    $did=$_GET['did'];
    $del_sql= mysqli_query($conn,"delete from doctor where Do_ID='$did'");
    $del_sql= mysqli_query($conn,"delete from schedule where Do_ID='$did'");

    
    header("Location:doctortable.php"); 
 }
}
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
      .hh{
        color: aliceblue;
        display: flex;
        align-items: center;
      }
        @media screen and (max-width:500px){
          .btn{
            width:100%;
          }
        }
    </style>
  </head>
  <body>
  
  <div class="modal fade" id="insertDoctor">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-white"  style="background: linear-gradient(#31B7C2,#02b23d);">
					<div class="modal-title">
          <h2>Doctor Registration</h2>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">


  


 
    <form class="" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
      <label for="image">Image : </label>
      <input type="file" name="image" id="image" value="" > <br>
      <label for="name">Name : </label>
      <input type="text" name="name" id = "name" value=""> <br>
      <label for="phone">Phone : </label>
      <input type="tel" id="phone" name="phone" placeholder="09-12345-6789" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" required value=""><br>
      <label for="education">Education  : </label>
      <input type="text" name="education" id = "education" value=""> <br>
      <label for="specialist">Specialist : </label>
      <input type="text" name="specialist" id = "specialist"  value=""> <br>
      <label for="email">Email : </label>
      <input type="text" name="email" id = "email"  value=""> <br>
      <button type="submit" name="submit"  style="width:100%;background: linear-gradient(#31B7C2,#02b23d);">Register</button>
    </form>
    </div>
					
				</div>
				
			
			</div>
		</div>
	</div>

    <div class="container" style="background: linear-gradient(#31B7C2,#02b23d);">
    <div class="row" style="height:100px"> 
        <img src="./img/zlogo.png" alt="" style="width: 95px;height: 95px;">
      <h1 style="color:white;display:flex;justify-content:center;align-item:center;font-size:40px;" class="hh"> ဇီဝကရဲ့ဇီဝကများ</h1>


      </div>
      
			<div class="row">
				<div class="col-md-6">
					<a href="#" class="btn btn-primary btn-block m-1" style="border-radius:0%;" data-toggle="modal" data-target="#insertDoctor"><i class="fa fa-users"></i> Doctor Register </a>
				</div>
				
				<div class="col-md-6">
					<a href="dashboard.php" class="btn btn-danger btn-block m-1 " style="border-radius:0%;" ><i class="fa fa-angle-double-left"></i>&nbsp;Go Back</a>
				</div>
				
			
			</div>
<div class="container table-responsive table-bordred table-hover" style="background: linear-gradient(#31B7C2,#02b23d);">   
 <table class="table"> 
<thead>
<tr>

  <th width="5%">ID</th>
   <th width="10%">Doctor</th>
  <th width="10%">Specialist</th>
  <th width="10%">Action</th>		  							                                  
    
</tr>
 </thead>
 <tbody>
<?php 
$i=1;
while($row=mysqli_fetch_assoc($res))
   {
   ?>
		<tr>
		  <td class="serial"><?php echo $i++  ?></td>		  
          <td style = "display: flex; align-items: center;"> <img src="img/<?php echo $row['do_image']; ?>" alt="" width = 25>  &nbsp;<?php echo $row["Do_Name"]; ?> </td>							 
                               <td><?php echo $row['Specialist']?></td>
                               					  
  <td>
<?php
echo "<a class='btn btn-primary btn-sm' style='color:white' href='doctorSchedule.php?did=".$row['Do_ID']."'>Assign Schedule</a></span>&nbsp; ";
echo "<span class='btn btn-primary btn-sm'><a style='color:white' href='editDoctor.php?did=".$row['Do_ID']."'>Edit</a></span>&nbsp;";
echo "<span class='btn btn-danger btn-sm'><a class='confirmation' style='color:white' href='?type=delete&did=".$row['Do_ID']."'>Delete</a></span>; ";

 ?>
  </td>
</tr>
<?php } ?>
 </tbody>
  </table>
 </div>
 
 </div>
 </body>
 <script type="text/javascript">
    $('.confirmation').on('click', function () 
    {
        return confirm('Are you sure to delete this doctor from the list ?');
    });
</script>

</html>
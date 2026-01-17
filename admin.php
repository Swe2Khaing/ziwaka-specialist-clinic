<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

}
else{
  header("Location: login.php");
}
?>

<?php

$restable = mysqli_query($conn,"SELECT inpatient.InP_ID,inpatient.Adm_Date, inpatient.Inp_name,inpatient.Age,inpatient.AC,inpatient.Gender,inpatient.Ph_no,inpatient.Querter,inpatient.Village,
inpatient.City, doctor.Do_Name,adm_dx.Adm_Dx, adm_dx.Adm_Dx_In_Myan, dc_dx.Dc_Dx,dc_dx.Dc_Dx_In_Myan,inpatient.Dc_Date,inpatient.Dc_Time
FROM inpatient
INNER JOIN treated ON inpatient.InP_ID=treated.InP_ID
INNER JOIN doctor ON treated.Do_ID=doctor.Do_ID
INNER JOIN adm_dx ON adm_dx.InP_ID=inpatient.InP_ID
INNER JOIN dc_dx ON dc_dx.InP_ID=inpatient.InP_ID");

?>


<?php

$res=mysqli_query($conn,"SELECT COUNT(InP_ID) FROM inpatient;");
$count=mysqli_fetch_assoc($res);
$a=implode(" ",$count);;
?>

<?php

$res=mysqli_query($conn,"SELECT COUNT(Do_ID) FROM doctor;");
$count=mysqli_fetch_assoc($res);
$aa=implode(" ",$count);;
?>

<?php

$res=mysqli_query($conn,"SELECT COUNT(id) FROM admin;");
$count=mysqli_fetch_assoc($res);
$aaa=implode(" ",$count);;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ziwaka specialist clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
<style>
  *{
    padding:0px;
    margin:0px;
    box-sizing: border-box;
  }
  body{
    overflow-x: hidden;
  }
 .aa{
  width: 100%;
    padding: 0px;
    margin: 0px;
  }
.navbar{
  width: 100%;
  display: flex;
  justify-content: space-between;

}
.navbar{

  background-color:rgb(157, 214, 70);
}

.logo{
  border-radius:100%;
  border:2px solid white;
  width: 100px;
  height: 100px;
  background-color:white;
}

.aaa{
  height: 58vh;
  width: 100%;
  background: rgb(204, 221, 255);
 
}

.col-sm-9{
  
  background: rgb(219, 216, 216);
}

.card{
  background: rgb(230, 238, 255);
}


nav>div>.list-group .list-group-item{

  background:rgb(2, 30, 70);
}

.row>nav{
  background:rgb(219, 216, 216);
}
div.tb{
  margin-left:14px;
  width:99%;
  overflow-y: scroll;
}
.form-control{
  margin-bottom: 10px;
  background: white;
}
.btn-group-vertical{
  background-color:blue;
  width:107%;
  border-radius:0px 0px 20px 20px;
  
.btnmenu{
  border-bottom:1px solid red;
  
}
.btnmenu:last-child{
  border:none;
}
nav{
  background:red;
  padding:0px;
 
}
@media screen and (max-width:1800px){
.aaa{
  height: 45vh;
  width: 100%;
  background: rgb(204, 221, 255);
 
}
}

</style>
</head>

<body>
  
  <div class="aa">

    <nav class="navbar navbar-expand-sm navbar-dark ">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">
        <img src="img/ziwaka33-removebg.png" alt="logo" class="logo">
      </a>

      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">
          <h1 class="d-none d-md-block">ဇီဝက အထူးကုဆေးခန်း</h1>
        </a>
      
      <!-- Links -->
      <div class="dropdown ml-4">        
          
        <span class="h4 text-light"><?php echo $row["name"]; ?></span>  <a href="#" class="dropdown-toggle text-light " data-toggle="dropdown" > <i class="fa fa-user "style="font-size:22px;" aria-hidden="true"></i></a>
         
         <ul class="dropdown-menu">
             <li>
             <a href="logout.php" class="dropdown-item text-danger">Logout <i class='fas fa-sign-out-alt'></i> </a>
             </li>
         </ul>
     
         </div>
      
    </nav>
    
    </div>



    <div class="row g-0">     

    <nav class="col-sm-3 col-md-2 col-lg-2 col-xl-2 a1 bg-success">

    

    <div class="btn-group-vertical btn-group-lg ">
    <button type="button" class="btn btnmenu"> <i class="fas fa-home"></i>
          <span class="">Dashboard</span></button>
    <button type="button" class="btn btnmenu dropdown" href="#" id="buttondrop" data-toggle="dropdown"><i class="fas fa-users"></i>
            <span class="">Inpatient</span>
            <span class="badge bg-danger
            rounded-pill float-end">20</span>
           
            <div class="dropdown-menu">
            <div class="sub-sub-menu">
            <a class="dropdown-item" href="#" >Java Developer</a>


    
  
    <div class="menu" id="menu"> 
      
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Contact</a></li>
        <li><a href="">Service</a></li>
        <li><a href="">About</a></li>
      </ul>  
    
    </div>
  
</div>


<a class="dropdown-item" href="#">PHP Developer</a>

<a class="dropdown-item" href="#">C# Developer</a>
</div>
          </button>
    <button type="button" class="btn btnmenu"><i class="fas fa-chart-line"></i>
            <span class="">Statistics</span></button>
    <button type="button" class="btn btnmenu"><i class="fas fa-flag"></i>
            <span class="">Reports</span>y</button>
  </div>
  
    </nav>
    
    
    <main class="col-sm-9 col-md-10 col-lg-10 col-xl-10 ">
     
      <div class="row flex-column flex-lg-row mt-3">
        
        <div class="col">
        <div class="card mb-4">
        <div class="card-body">
        <h3 class="card-title h2"><?php echo $aaa; ?></h3>
        <span class="text-info">
        <i class="fas fa-chart-line"></i>
        Hospital admin
        </span>
        </div>
        </div>
        </div>

        <div class="col">
        <div class="card mb-3">
        <div class="card-body">
        <h3 class="card-title h2"><?php echo $aa; ?></h3>
        <span class="text-success">
        <i class="fas fa-chart-line"></i>
        Doctors
        </span>
        </div>
        </div>
        </div>

        <div class="col">
        <div class="card mb-3">
        <div class="card-body">
        <h3 class="card-title h2"><?php echo $a; ?></h3>
        <span class="text-success">
        <i class="fas fa-chart-line"></i>
        Patients
        </span>
        </div>
        </div>
        </div>

        <div class="col">
        <div class="card mb-3">
        <div class="card-body">
        <h3 class="card-title h2">102,250</h3>
        <span class="text-success">
        <i class="fas fa-chart-line"></i>
        Yearly visitors
        </span>
        </div>
        </div>
        </div>
        </div>



        <div class="row mt-4 flex-column flex-lg-row ">
          
          <div class="col ">
          <h2 class="h6 text-black-50">Inpatient Data</h2>
          <input class="form-control"  id="myInput" type="text" placeholder="Search..">


          <////button class="btn btn-sm
          ///btn-outline-secondary">
<///i class="fas fa-sort-amount-up"><//i>
          <///button>
          <//button class="btn btn-sm
          btn-outline-secondary">
<//i class="fas fa-filter"><//i>
          <///button>
</div>


<div class="tb">
<table class="table table-responsive aaa"> 
  <thead>
    <tr>

    <th width="3%">ID</th>
   <th width="8%">Name</th>
  <th width="3%">Age</th>		  
   <th width="5%">Ac</th>
   <th width="18%">Querter</th>
   <th width="18%">Village</th>
   <th width="18%">City</th>
   											                                  
    
</tr>
 </thead>
 <tbody id="myTable">
<?php 
$i=1;
while($row=mysqli_fetch_assoc($restable))
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
echo "<a class='btn bg-danger btn-sm' style='color:white' href='?uid=".$row['InP_ID']."'>Detail</a></span>&nbsp; ";   
 ?>
  </td>
</tr>
<?php } ?>
 </tbody>
  </table>
   </div>
          
          </div>




    </main>
    </div>



    <footer class="text-center py-4 text-muted">
      &copy; Copyright 2022
      </footer>

    </div>
    <script>
$(document).ready(function()
{
  $("#myInput").on("keyup", function() 
  {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() 
    {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>

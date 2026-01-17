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

$restable = mysqli_query($conn,"SELECT * FROM booking 
INNER JOIN doctor ON doctor.Do_ID=booking.Do_ID 
INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid
INNER JOIN times ON times.TID=booking.TID");

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

<?php

/*===============================Patient Registration============================================*/
if(isset($_POST["submit"])){
    $adm_date = $_POST["adm-date"];
    $adm_time = $_POST["adm-time"];
    $name = $_POST["name"];
  $age = $_POST["age"];
  $ac = $_POST["ac"];
  $gender =$_POST['gender'];
  $phone = $_POST["phone"];
  $querter = $_POST["querter"];
  $village = $_POST["village"];
  $city = $_POST["city"];
  $doctor = $_POST["doctor"];
  $admdx = $_POST["admdx"];
  $dcdx = $_POST["dcdx"];
  $dc_date = $_POST["dc-date"];
  $death_date = $_POST["death-date"];
  $death_time = $_POST["death-time"];

  $duplicate = mysqli_query($conn, "SELECT * FROM inpatient WHERE  Ph_no = '$phone' AND Inp_name='$name");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Patient Has Already Taken'); </script>";
  }
  else{
    
      $query = "INSERT INTO inpatient VALUES('','$adm_date','$adm_time','$name','$age','$ac','$gender','$phone',
      '$querter','$village','$city','$doctor','$admdx','$dcdx','$dc_date','$death_date','$death_time')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Patient Registration Successful'); </script>";
      header("Location:inpatient.php"); 
    
  }
}
/*==============================Patient Registration End=============================================*/
?>

<?php
if(isset($_GET['type'] )&& $_GET['type']!='')
{
 $type=$_GET['type'];
 if($type=='delete')
 {
    
    $bid=$_GET['bid'];
   mysqli_query($conn,"delete from booking where B_ID='$bid'");


    
    header("Location:booking.php"); 
 }
}
?>


<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!--<title>Admin Dashboard Panel</title>--> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function()
		{
			$(".tb").load("allrecords.php");

        
				
            
            
            var date_id;
            var part; 
    $('#date').on('change', function() {
      date_id = this.value;
        alert(date_id);
    });


    $('#part').on('change', function() {
                part = this.value;
                alert(part);
                $.ajax({
                    url: "aaa.php",
                    type: "POST",
                    data: {
                        part:part,
                        date_id:date_id
                    },
                    cache: false,
                    success: function(result) {
                        $(".tb").html(result);
                    }
                });
            });

            $('#sub-category-dropdown').on('change', function() {
                var d_id = this.value;
                alert(d_id);
                $.ajax({
                    url: "fetch-subcourse1.php",
                    type: "POST",
                    data: {
                        part:part,
                        date_id:date_id,
                        d_id:d_id
                        
                    },
                    cache: false,
                    success: function(result1) {
                        $("#sub-category-dropdown1").html(result1);
                    }
                });
            });



			$("#text_search").keyup(function(){
				var data=$(this).val();
				$("#ajaxdata").load("searchdata.php",{result: data});
			});

			$("#refresh").click(function(){
				$("#ajaxdata").load("allrecords.php");
			});
		});
	</script>

    <style>
        /* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

:root{
    /* ===== Colors ===== */
    --primary-color: #0E4BF1;
    --panel-color: #FFF;
    --text-color: #000;
    --black-light-color: #707070;
    --border-color: #e6e5e5;
    --toggle-color: #DDD;
    --box1-color: #4DA3FF;
    --box2-color: #a3c646;
    --box3-color: #E7D1FC;
    --title-icon-color: #fff;
    
    /* ====== Transition ====== */
    --tran-05: all 0.5s ease;
    --tran-03: all 0.3s ease;
    --tran-03: all 0.2s ease;
}

body{
    min-height: 100vh;
    background-color: var(--primary-color);
}
body.dark{
    --primary-color: #3A3B3C;
    --panel-color: #242526;
    --text-color: #CCC;
    --black-light-color: #CCC;
    --border-color: #4D4C4C;
    --toggle-color: #FFF;
    --box1-color: #3A3B3C;
    --box2-color: #3A3B3C;
    --box3-color: #3A3B3C;
    --title-icon-color: #CCC;
}
/* === Custom Scroll Bar CSS === */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 12px;
    transition: all 0.3s ease;
}

::-webkit-scrollbar-thumb:hover {
    background: #0b3cc1;
}

body.dark::-webkit-scrollbar-thumb:hover,
body.dark .activity-data::-webkit-scrollbar-thumb:hover{
    background: #3A3B3C;
}

nav{
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
   
    background-color: var(--panel-color);
    border-right: 1px solid var(--border-color);
    transition: var(--tran-05);
}
nav.close{
    width: 73px;
}
nav .logo-name{
    display: flex;
    align-items: center;
    height: 10vh;
}
nav .logo-image{
    display: flex;
    justify-content: center;
    min-width: 45px;
}
nav .logo-image img{
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

nav .logo-name .logo_name{
    font-size: 30px;
    font-weight: 600;
    color: var(--text-color);
    margin-left: 14px;
    transition: var(--tran-05);
}
nav.close .logo_name{
    opacity: 0;
    pointer-events: none;
}
nav .menu-items{
    margin-top: 40px;
    height: calc(100% - 90px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.menu-items li{
    list-style: none;
}
.menu-items li a{
    display: flex;
    align-items: center;
    height: 50px;
    text-decoration: none;
    position: relative;
}
.nav-links li a:hover:before{
    content: "";
    position: absolute;
    left: -7px;
    height: 5px;
    width: 5px;
    border-radius: 50%;
    background-color: var(--primary-color);
}
body.dark li a:hover:before{
    background-color: var(--text-color);
}
.menu-items li a i{
    font-size: 24px;
    min-width: 45px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: black;
}
.menu-items li a .link-name{
    font-size: 18px;
    font-weight: 400;
    color: black;    
    transition: var(--tran-05);
}
nav.close li a .link-name{
    opacity: 0;
    pointer-events: none;
}
.nav-links li a:hover i,
.nav-links li a:hover .link-name{
    color: red;
}
body.dark .nav-links li a:hover i,
body.dark .nav-links li a:hover .link-name{
    color: var(--text-color);
}
.menu-items .logout-mode{
    padding-top: 10px;
    border-top: 1px solid var(--border-color);
}
.menu-items .mode{
    display: flex;
    align-items: center;
    white-space: nowrap;
}
.menu-items .mode-toggle{
    position: absolute;
    right: 14px;
    height: 50px;
    min-width: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.mode-toggle .switch{
    position: relative;
    display: inline-block;
    height: 22px;
    width: 40px;
    border-radius: 25px;
    background-color: var(--toggle-color);
}
.switch:before{
    content: "";
    position: absolute;
    left: 5px;
    top: 50%;
    transform: translateY(-50%);
    height: 15px;
    width: 15px;
    background-color: var(--panel-color);
    border-radius: 50%;
    transition: var(--tran-03);
}
body.dark .switch:before{
    left: 20px;
}

.dashboard{
    position: relative;
    left: 250px;
    background-color: var(--panel-color);
    min-height: 100vh;
    width: calc(100% - 250px);
    padding: 10px;
    padding-top:12vh;
    transition: var(--tran-05);
}
nav.close ~ .dashboard{
    left: 73px;
    width: calc(100% - 73px);
}
.dashboard .top{
    position: fixed;
    top: 0;
    left: 250px;
    display: flex;
    width: calc(100% - 250px);
    min-height: 10vh;
    justify-content: space-between;
    align-items: center;
    padding: 10px 14px;
    background-color: #dbdee1fe;
    transition: var(--tran-05);
    z-index: 10;
}
nav.close ~ .dashboard .top{
    left: 73px;
    width: calc(100% - 73px);
}
.dashboard .top .sidebar-toggle{
    font-size: 26px;
    color: var(--text-color);
    cursor: pointer;
}
.dashboard .top .search-box{
    position: relative;
    height: 45px;
    max-width: 600px;
    width: 100%;
    margin: 0 30px;
}
.top .search-box input{
    position: absolute;
    border: 1px solid var(--border-color);
    background-color: var(--panel-color);
    padding: 0 25px 0 50px;
    border-radius: 5px;
    height: 100%;
    width: 100%;
    color: var(--text-color);
    font-size: 15px;
    font-weight: 400;
    outline: none;
}
.top .search-box i{
    position: absolute;
    left: 15px;
    font-size: 22px;
    z-index: 10;
    top: 50%;
    transform: translateY(-50%);
    color: var(--black-light-color);
}
.top img{
    width: 40px;
    border-radius: 50%;
}
.dashboard .dash-content{
    padding-top: 50px;
}
.dash-content .title{
    display: flex;
    align-items: center;
    margin: 60px 0 30px 0;
}
.dash-content .title i{
    position: relative;
    height: 35px;
    width: 35px;
    background-color: var(--primary-color);
    border-radius: 6px;
    color: var(--title-icon-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
.dash-content .title .text{
    font-size: 24px;
    font-weight: 500;
    color: var(--text-color);
    margin-left: 10px;
}
.dash-content .boxes{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.dash-content .boxes .box{
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 12px;
    width: calc(100% / 3 - 15px);
    padding: 15px 20px;
    background-color: var(--box1-color);
    transition: var(--tran-05);
}
.boxes .box i{
    font-size: 35px;
    color: var(--text-color);
}
.boxes .box .text{
    white-space: nowrap;
    font-size: 18px;
    font-weight: 500;
    color: var(--text-color);
}
.boxes .box .number{
    font-size: 40px;
    font-weight: 500;
    color: var(--text-color);
}
.boxes .box.box2{
    background-color: var(--box2-color);
}
.boxes .box.box3{
    background-color: var(--box3-color);
}
.dash-content .activity .activity-data{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}
.activity .activity-data{
    display: flex;
}
.activity-data .data{
    display: flex;
    flex-direction: column;
    margin: 0 15px;
}
.activity-data .data-title{
    font-size: 20px;
    font-weight: 500;
    color: var(--text-color);
}
.activity-data .data .data-list{
    font-size: 18px;
    font-weight: 400;
    margin-top: 20px;
    white-space: nowrap;
    color: var(--text-color);
}
.aaa {
  height: 500px;
  width: 100%;
  color:blue;
  margin:0px;
  overflow-y: scroll;
}
img{
    width: 50px;
    height: 50px;
}
.search-box{
    width: 100%;
}
.uil{
    float: left;
}
@media (max-width: 1000px) {
    nav{
        width: 73px;
    }
    nav.close{
        width: 250px;
    }
    nav .logo_name{
        opacity: 0;
        pointer-events: none;
    }
    nav.close .logo_name{
        opacity: 1;
        pointer-events: auto;
    }
    nav li a .link-name{
        opacity: 0;
        pointer-events: none;
    }
    nav.close li a .link-name{
        opacity: 1;
        pointer-events: auto;
    }
    nav ~ .dashboard{
        left: 73px;
        width: calc(100% - 73px);
    }
    nav.close ~ .dashboard{
        left: 250px;
        width: calc(100% - 250px);
    }
    nav ~ .dashboard .top{
        left: 73px;
        width: calc(100% - 73px);
    }
    nav.close ~ .dashboard .top{
        left: 250px;
        width: calc(100% - 250px);
    }
    .activity .activity-data{
        overflow-X: scroll;
    }
}

@media (max-width: 780px) {
    .dash-content .boxes .box{
        width: calc(100% / 2 - 15px);
        margin-top: 15px;
    }
}
@media (max-width: 560px) {
    .dash-content .boxes .box{
        width: 100% ;
    }
}
@media (max-width: 400px) {
    nav{
        width: 0px;
    }
    nav.close{
        width: 73px;
    }
    nav .logo_name{
        opacity: 0;
        pointer-events: none;
    }
    nav.close .logo_name{
        opacity: 0;
        pointer-events: none;
    }
    nav li a .link-name{
        opacity: 0;
        pointer-events: none;
    }
    nav.close li a .link-name{
        opacity: 0;
        pointer-events: none;
    }
    nav ~ .dashboard{
        left: 0;
        width: 100%;
    }
    nav.close ~ .dashboard{
        left: 73px;
        width: calc(100% - 73px);
    }
    nav ~ .dashboard .top{
        left: 0;
        width: 100%;
    }
    nav.close ~ .dashboard .top{
        left: 0;
        width: 100%;
    }
}
.active{
    background-color:#4d4dff;
}
.page-item{
   background-color: #707070;
}

    </style>
</head>
<body>
    <nav>
        <div class="logo-name ">
            <div class="logo-image">
                <img src="img/ziwaka33-removebg.png" alt="">
                
            </div>
            <span class="logo_name">Ziwaka</span>
           
        </div>

        <div class="menu-items">
        <ul class="nav-links">
                <li><a href="dashboard.php">
                    <i class="fa fa-home"></i>
                    <span class="link-name ">Dahsboard</span>
                </a></li>
                <li>
                    <a href="inpatient.php" >
                    <i class="fa fa-plus-square"></i>
                    <span class="link-name">Inpatient</span>
                    </a>
                    
                </li>
                <li class="active"><a href="booking.php">
                    <i class="fa fa-calendar"></i>
                    <span class="link-name">Booking</span>
                </a></li>
                <li><a href="doctortable.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Doctor</span>
                </a></li>
                
                
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top ">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="admin-name">
            <span class="h4 text-dark"><i class="fa fa-user "style="font-size:22px;" aria-hidden="true">&nbsp;</i><?php echo $row["name"]; ?></span> 
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        
        
           
           
                <div class="search-box">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                
            </div>
            	
		<form method="post" class="form-horizontal">
<div class="row">

<div class="col-6 " >
<label for="date" class="control-label" >Search with date</label>
      <input type="date" name="date" id="date" class="form-control">
   </div>

   <div class="col-6 " >
   <label for="part">Select Part of a day</label>
                                        <select class="form-control" id="part" name="part" >
                                        <option value="">Select Part of a day</option>
                                   
                                        <?php
                                            
                                             $result = mysqli_query($conn,"SELECT * FROM part_of_a_day");
                                             while($row = mysqli_fetch_array($result)) 
                                             {
                                             ?>
                                                  <option value="<?php echo $row['pid'];?>"> <?php echo $row["pname"];?> </option>
                                             <?php
                                                  }
                                             ?>
                                        </select>
   </div>
   

   </div>
   <br>
   <button type="button" name="refresh" id="refresh" class="btn btn-primary">Refresh</button>
</form>

                

                <div class="tb mt-5">
               
                

 
   </div>
            
    </section>

   


    <!--<script src="script.js"></script>-->
</body>
<script>
   


    const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");
      table=body.querySelector(".aaa");
      
let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
    table.style.color="dark";
    
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})
$(document).ready(function()
{
  $("#myInput").on("keyup", function() 
  {
    var value = $(this).val().toLowerCase();
    $(".tb table tr").filter(function() 
    {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
</html>

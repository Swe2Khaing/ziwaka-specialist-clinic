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

<?php
$data_item = array(
    array("id" => 1, "item" => "AGE, COL, H^/T"),
    array("id" => 2, "item" => "severe pneumonitis, COPD, IHD"),
    array("id" => 3, "item" => "AGE, Chr:hepatitis, left severe hydronephrosis"),
    array("id" => 4, "item" => "Renal failure, CKD, H^/T, HF"),
    array("id" => 5, "item" => "UTI, RA, DM"),
    array("id" => 6, "item" => "old stroke"),
    array("id" => 7, "item" => "severe pneumonitis, COPD, IHD"),
    array("id" => 8, "item" => "PUO, DM"),
    array("id" => 9, "item" => "oldstroke, IHD, Psychosis"),
    array("id" => 10, "item" => "severe pneumonitis, COPD, IHD"),
    array("id" => 11, "item" => "old stroke,IHD"),
   array("id" => 12, "item" => "Fainting attack"),
   array("id" => 13, "item" => "AGE"),
   array("id" => 14, "item" => "DM, HF"),
   array("id" => 15, "item" => "Severe Anemia, HCC, COL"),
   array("id" => 16, "item" => "severe pneumonitis , COPD, IHD")


    
);
$minSupport =3;
$arr = [];
for ($i = 0; $i < count($data_item); $i++) {
    $ar = [];
    $val = explode(",", $data_item[$i]["item"]);
    for ($j = 0; $j < count($val); $j++) {
        $ar[] = $val[$j];
    }
    array_push($arr, $ar);
}

$frekuensi_item = frekuensiItem($arr);
$dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);

// print_r($dataEliminasi);

do {
    $pasangan_item = pasanganItem($dataEliminasi);
    $frekuensi_item = FrekuensiPasanganItem($pasangan_item, $arr);
    $dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);
} while ($dataEliminasi == $frekuensi_item);


function frekuensiItem($data)
{
    $arr = [];
    for ($i = 0; $i < count($data); $i++) {
        $jum = array_count_values($data[$i]);
        foreach ($jum as $key => $v) {
            if (array_key_exists($key, $arr)) {
                $arr[$key] += 1;
            } else {
                $arr[$key] = 1;
            }
        }
    }
    return $arr;
}

function eliminasiItem($data, $minSupport)
{
    $arr = [];
    foreach ($data as $key => $v) {
        if ($v >= $minSupport) {
            $arr[$key] = $v;
        }
    }
    return $arr;
}
function pasanganItem($data_filter)
{
    $n = 0;
    $arr = [];
    foreach ($data_filter as $key1 => $v1) {
        $m = 1;
        foreach ($data_filter as $key2 => $v2) {
            $str = explode("_", $key2);
            for ($i = 0; $i < count($str); $i++) {

                if (!strstr($key1, $str[$i])) {
                    if ($m > $n + 1 && count($data_filter) > $n + 1) {
                        $arr[$key1 . "_" . $str[$i]] = 0;
                    }
                }
            }
            $m++;
        }
        $n++;
    }
    return $arr;
}

function frekuensiPasanganItem($data_pasangan, $data)
{
    $arr = $data_pasangan;
    $ky = "";
    $kali = 0;
    foreach ($data_pasangan as $key1 => $k) {
        for ($i = 0; $i < count($data); $i++) {
            $kk = explode("_", $key1);
            $jm = 0;
            for ($k = 0; $k < count($kk); $k++) {

                for ($j = 0; $j < count($data[$i]); $j++) {
                    if ($data[$i][$j] == $kk[$k]) {
                        $jm += 1;
                        break;
                    }
                }
            }
            if ($jm > count($kk) - 1) {
                $arr[$key1] += 1;
            }
        }
    }
    return $arr;
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
    height:10vh;
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
    padding: 10px 14px;
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
    background-color:#dbdee1fe;
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
.aaa{
  height: 58vh;
  width: 100%;
  color:gray;
 
}
img{
    width: 50px;
    height: 50px;
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
nav{
    background-color:white;
}


    </style>
</head>
<body>
    <nav>
    <div class="logo-name">
            <div class="logo-image">
                <img src="img/ziwaka33-removebg.png" alt="">
                
            </div>
            <span class="logo_name">Ziwaka</span>
           
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li class="active"><a href="dashboard.php">
                    <i class="fa fa-home"></i>
                    <span class="link-name active">Dahsboard</span>
                </a></li>
                <li>
                    <a href="inpatient.php" >
                    <i class="fa fa-plus-square"></i>
                    <span class="link-name">Inpatient</span>
                    </a>
                    
                </li>
               
                <li><a href="booking.php">
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
                    <i class='fas fa-sign-out-alt'></i>
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
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="admin-name">
            <span class="h4 text-dark"><i class="fa fa-user "style="font-size:22px;" aria-hidden="true">&nbsp;</i><?php echo $row["name"]; ?></span> 
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <span class="number"><?php echo $aaa; ?></span>
                        <img src="img/admin.png" alt="">
                        <span class="text">Admin</span>
                    </div>
                    <div class="box box2">
                        <span class="number"><?php echo $aa; ?></span>
                        <img src="img/doctor1.png" alt="">
                        <span class="text">Doctor</span>
                    </div>
                    <div class="box box3">
                        <span class="number"><?php echo $a; ?></span>
                        <img src="img/patient (3).png" alt="">
                        <span class="text">Inpatient</span>
                    </div>
                </div>
            </div>
            
            <h3 class="text-left">Apriori Algorithm</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                  Be discovered
                </div>
                <div class="panel-footer">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2" valign="middle" class="text-center">Id</th>
                                <th colspan="5" class="text-left">Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($data_item); $i++) {
                                echo ("<tr>");
                                echo ("<td class='text-center'>" . $data_item[$i]["id"] . "</td>");
                                echo ("<td>" . $data_item[$i]["item"] . "</td>");
                                echo ("</tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                   Question?
                </div>
                <div class="panel-footer">
                     How to know the pattern or rule if one item is selected, then it is possible to choose another item?
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="" method="post">
                         Solution <button name="submit" type="submit">Click Process</button>
                    </form>
                </div>
                <?php if (isset($_POST['submit'])) { ?>
                    <div class="panel-footer">
                        <b>Iteration 1 (Calculating Initial Itemset Frequency:)</b>
                        <div class="table-responsive">
                            <table class="table table-bordered table-earning">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th width="50%">Frekuensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $frekuensi_item = frekuensiItem($arr);
                                        foreach ($frekuensi_item as $key => $val) {
                                            echo ("<tr>");
                                            echo ("<td>" . $key . "</td>");
                                            echo ("<td>" . $val . "</td>");
                                            echo ("</tr>");
                                        }
                                        ?>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                        <span style="margin-left:8px">
                        Eliminate Iteration 1 (Remove items that do not meet the minimum support value) so that they become:
                        </span>
                        <div class="table-responsive">
                            <table class="table table-bordered table-earning">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th width="50%">Frequency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);
                                        foreach ($dataEliminasi as $key => $val) {
                                            echo ("<tr>");
                                            echo ("<td>" . $key . "</td>");
                                            echo ("<td>" . $val . "</td>");
                                            echo ("</tr>");
                                        }
                                        ?>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                        <?php
                        $iterasi = 2;
                        do {
                        ?>
                            <b>Iterasi <?php echo $iterasi; ?> (Menghitung Frekuensi Awal Itemset:)</b>
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-bordered table-earning">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th width="50%">Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $pasangan_item = pasanganItem($dataEliminasi);
                                            $frekuensi_item = FrekuensiPasanganItem($pasangan_item, $arr);
                                            foreach ($frekuensi_item as $key => $val) {

                                                $ex = explode("_", $key);
                                                $item = "";
                                                $vl = "";
                                                for ($k = 0; $k < count($ex); $k++) {
                                                    if ($k !== count($ex) - 1) {
                                                        $item .= "," . $ex[$k];
                                                    } else {
                                                        $vl = $ex[$k];
                                                    }
                                                }
                                                $aturan_asosiasi[] = array("item" => substr($item, 1), "val" => $vl, "sc" => $val);
                                                echo ("<tr>");
                                                echo ("<td>" . $key . "</td>");
                                                echo ("<td>" . $val . "</td>");
                                                echo ("</tr>");
                                            }
                                            ?>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                            <span style="margin-left:8px">
                            Iteration Elimination <?php echo $iterasi; ?> (Removing items that do not meet the minimum support value) until it becomes:
                            </span>
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-bordered table-earning">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th width="50%">Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);
                                            foreach ($dataEliminasi as $key => $val) {
                                                echo ("<tr>");
                                                // for ($j = 0; $j < count($frekuensi_item[$i]); $j++) { 
                                                echo ("<td>" . $key . "</td>");
                                                echo ("<td>" . $val . "</td>");
                                                // }
                                                echo ("</tr>");
                                            }
                                            ?>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                        <?php $iterasi++;
                        } while ($dataEliminasi == $frekuensi_item)
                        ?>
                        <b>Because there are no more frequencies to be eliminated, the iteration is stopped.</b><br>
                        <b>Hitung Support dan Confident:</b><br>
                        <?php
                        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
                            $x = 0;
                            echo $i + 1 . "Nilai confident, ";
                            echo $aturan_asosiasi[$i]["item"] . " => " . $aturan_asosiasi[$i]["val"] . "=";
                            $ex = explode(",", $aturan_asosiasi[$i]["item"]);

                            for ($l = 0; $l < count($arr); $l++) {
                                $jum = 0;
                                for ($k = 0; $k < count($ex); $k++) {

                                    for ($j = 0; $j < count($arr[$l]); $j++) {
                                        if ($arr[$l][$j] == $ex[$k]) {
                                            $jum += 1;
                                        }
                                    }
                                }
                                if (count($ex) == $jum) {
                                    $x += 1;
                                }
                            }

                            $convident = (floatval($aturan_asosiasi[$i]["sc"]) / floatval($x)) * 100;
                            
                            if($convident>=70){
                            $aturan_asosiasi[$i]["c"] = number_format($convident, 2, ".", ",");
                            echo $aturan_asosiasi[$i]["sc"] . "/" . $x . "=" . number_format(floatval($aturan_asosiasi[$i]["sc"]) / floatval($x), 2, ".", ",") . "=" . number_format($convident, 0, ".", ",") . "%";
                            echo  "<br>";
                            }
                        }
                        ?>
                        <b>Based on the Apriori algorithm, the association rules that were successfully obtained are as follows: </b>
                        <br>
                        <?php
                        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
                            $x = 0;
                            echo $i + 1 . ". Jika " . $aturan_asosiasi[$i]["item"] . " maka " . $aturan_asosiasi[$i]["val"] . "<br>";
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
            
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

</script>
</html>

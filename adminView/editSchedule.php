<?php
require 'config.php';
$row="";
$did=0;
$sid=0;
$tid=0;

/*===========================================================================*/
if(isset($_GET['did']) && isset($_GET['sid'] ))
{
    
    $did= $_GET['did'];
    $sid=$_GET['sid'];
    $ress=mysqli_query($conn,"SELECT * FROM schedule 
    INNER JOIN doctor ON doctor.Do_ID=schedule.Do_ID
    INNER JOIN day ON schedule.D_ID=day.D_ID
    INNER JOIN times ON times.TID=schedule.TID
    INNER JOIN part_of_a_day ON part_of_a_day.pid=times.pid
     where schedule.S_ID='$sid' And doctor.Do_ID='$did'" );
   $row=mysqli_fetch_assoc($ress);

   $Do_Name = $row["Do_Name"];
    $specialist = $row["Specialist"];
    $day = $row["Day"];
    $part_of_day = $row["pid"];
    $start = $row["Start"];
    $end =$row['End'];
    $tid=$row['TID'];
    $daid=$row['D_ID'];

}
/*========================================================================*/
?>
<?php
/*============================= Update =====================================*/

if(isset($_POST['submit']))
{

    $sid=$_GET['sid'];
    $did=$_GET['did'];
    $name=$_POST['name'];
    $day = $_POST["day"];
    $pday = $_POST["pday"];
    $start = $_POST["start"];
    $end = $_POST["end"];
   
   
      
    mysqli_query($conn,"update times set Start='$start', End='$end',pid='$pday' where TID='$tid'");
      mysqli_query($conn,"update schedule set D_ID='$day'where S_ID='$sid' and Do_ID='$did'");
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
        body{
            display:flex;
           align-items:center;
            
        }
        .container{
            margin-top:100px;
            width:60%;
            height:350px;
            border-radius:50px;
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
    <div class="container" style="background:linear-gradient(#31B7C2,#02b23d);">
    <div class="row hh">
    <img src="./img/zlogo.png" alt="" style="width: 95px;height: 95px;">
        <h1>Doctor Schedule Editing</h1>
        </div>
        <form action="" method="post"  autocomplete='on'>
        <div class="row">
            <div class="col-6 " style="text-align:right;">
                <label for="name">Name :</label><br>
                <label for="female">Specialist</label><br>
                <label for="female">Day</label><br>
                <label for="female">Part of a day</label><br>
                <label for="female">Start time</label><br>
                <label for="female">End time</label><br>
                <button class="btn btn-primary" type="submit" name="submit">Change</button>
            </div>
            <div class="col-6"  style="padding:0px;">
                <input type="text" id="name" name="name" required value="<?php echo $Do_Name ?>"   readonly><br>
                <input type="text" id="specialist" name="specialist" value="<?php echo  $specialist ?>" readonly><br>



           
            <select name="day" id="day" style="border: 1px solid #5cd65c;color:black;width:150px;" class="form-control"/>
            <?php 
                                             $query="select * from day";
                                            $res = mysqli_query($conn, $query);
                                           while($rowd = mysqli_fetch_array($res))
                                              { ?>
                <option value="<?php echo $rowd['D_ID']; ?>"<?php if($rowd['Day']==$day) echo 'selected="selected"'; ?> > <?php echo $rowd['day_in_myan']; ?> </option>
                <?php } ?>
            </select>
            
            <select name="pday" id="pday" style="border: 1px solid #5cd65c;color:black;width:150px;" class="form-control"/>
        
            <?php 
                $query="select * from part_of_a_day";
                $res = mysqli_query($conn, $query);
                while($rowp = mysqli_fetch_array($res))
            { ?>
                <option value="<?php echo $rowp['pid']; ?>"<?php if($rowp['pid']==$part_of_day) echo 'selected="selected"'; ?> > <?php echo $rowp['pname']; ?> </option>
                <?php } ?>
            </select>

            <input type="time" id="start" name="start" required value="<?php echo $start ?>"  ><br>
            <input type="time" id="end" name="end" value="<?php echo $end ?>" ><br>
           
            <?php
    echo "<span class='btn btn-danger '><a style='color:white;height:50px;' href='doctorSchedule.php?did=".$_GET['did']."'>Back</a></span>&nbsp;";
?>


                
            </div>
        </div>
        
    </form>
    </div>
</body>
</html>
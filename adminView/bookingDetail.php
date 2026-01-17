
<?php
require 'config.php';

$bid="";
if(isset($_GET['bid']) )
{
    $bid= $_GET['bid'];
    

    $res=mysqli_query($conn,"select * from booking 
    INNER JOIN doctor ON booking.Do_ID=doctor.Do_ID 
    INNER JOIN times ON times.TID=booking.TID 
    INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid where B_ID='$bid'");
    $row=mysqli_fetch_assoc($res);

    $bno = $row["B_no"];
    $name = $row["Name"];
    $phone = $row["Phone"];
    $age = $row["Age"];
    $ac =$row['AC'];
    $date = $row["date"];
    $pid =$row['pid'];
    $dname =$row['Do_Name'];
    $did = $row["Do_ID"];
    $tid = $row["TID"];
    
}
?>
<?php
/*============================= Update =====================================*/

if(isset($_POST['submit']))
{

    $pid=$_GET['pid'];

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
   
      mysqli_query($conn,"update inpatient set Adm_Date='$adm_date',Adm_time='$adm_time', Inp_name='$name',Age='$age',AC='$ac',Gender='$gender',
       Ph_no='$phone',Querter='$querter',Village='$village',City='$city',doctor='$doctor',
      adm_dx='$admdx',dc_dx='$dcdx',Dc_Date='$dc_date',
      Death_Date='$death_date',Death_Time='$death_time' 
      where InP_ID='$pid'");

      
        echo
      "<script> alert('Registration Successful'); </script>";
        header("Location:inpatient.php?"); 
     
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
    
</head>
<body>
    <div class="container ">
    <form class="" action="" method="POST" autocomplete="off" enctype="multipart/form-data">


<label for="bno">Booking number : </label>
<input type="text" name="bno" id = "bno" value="<?php echo $bno ?>"><br>
<label for="name">Name : </label>
<input type="text" name="name" id = "name" value="<?php echo $name ?>">
<label for="phone">Phone : </label>
<input type="tel" id="phone" name="phone" placeholder="09-12345-6789" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" required value="<?php echo $phone ?>"><br>
<label for="age">Age  : </label>
<input type="text" name="age" id = "age" value="<?php echo $age ?>">

                                  <select  name="ac" id="ac">
                                       <option value="">အသက် အပိုင်းအခြား</option>
                                       <option value="day" <?php if($ac == 'day') echo 'selected= "selected"'; ?>>ရက်</option>
                                       <option value="month" <?php if($ac == 'month') echo 'selected= "selected"'; ?>>လ</option>
                                       <option value="year" <?php if($ac == 'year') echo 'selected= "selected"'; ?>>နှစ်</option>
                                  </select><br>

<label for="specialist">Doctor : </label>
<input type="text" name="doctor" id = "doctor"  value="<?php echo $dname ?>"> 
<label for="date">Date : </label>
<input type="date" name="date" id = "date"  value="<?php echo $date ?>"> <br>
<label for="part">Part of a day : </label>
<select name="part" id="part" >
          <option value="">Select Part of a day</option>
      <?php 
                                       $query="select * from part_of_a_day";
                                      $res = mysqli_query($conn, $query);
                                     while($rowd = mysqli_fetch_array($res))
                                        { ?>
          <option value="<?php echo $rowd['pid']; ?>"<?php if($rowd['pid']==$pid) echo 'selected="selected"'; ?>> <?php echo $rowd['pname']; ?> </option>
          <?php } ?>
      </select>
      <label for="time">Time : </label>
        <select name="times" id="times" >
          <option value="">Select Time</option>
      <?php 
                                       $query="select * from times inner join schedule on times.TID=schedule.TID where schedule.Do_ID='$did' and times.pid='$pid'";
                                      $res = mysqli_query($conn, $query);
                                     while($rowd = mysqli_fetch_array($res))
                                        { ?>
          <option value="<?php echo $rowd['TID']; ?>"<?php if($rowd['TID']==$tid) echo 'selected="selected"'; ?>> <?php echo $rowd['Start']; ?>-----<?php echo $rowd['End']; ?> </option>
          <?php } ?>
      </select>
      <label for="times">Time</label>
                                   <select class="form-control" id="time" name="time">
                                   </select>
<button type="submit" name="submit">Register</button>
</form>
    </div>
</body>
<script>
         $(document).ready(function() {
            
           
            var part; 
    
        
        var doctor=document.getElementById('doctor');
            var d_id=doctor.value ;
            alert(d_id);

            $('#date').on('change', function() {
      date_id = this.value;
        alert(date_id);
    });



    $('#part').on('change', function() {
                part = this.value;
                alert(part);
                $.ajax({
                    url: "fetch-subcourse.php",
                    type: "POST",
                    data: {
                        part:part,
                        date_id:date_id,
                        d_id:d_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#time").html(result);
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
});
   
      </script>
</html>
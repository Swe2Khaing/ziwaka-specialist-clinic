<?php
require 'config.php';

if(isset($_GET['pid']) )
{
    $pid= $_GET['pid'];
    

    $res=mysqli_query($conn,"select * from inpatient where InP_ID='$pid'");
    $row=mysqli_fetch_assoc($res);

    $adm_date = $row["Adm_Date"];
    $adm_time = $row["Adm_time"];
    $name = $row["Inp_name"];
    $age = $row["Age"];
    $ac = $row["AC"];
    $gender =$row['Gender'];
    $phone = $row["Ph_no"];
    $querter = $row["Querter"];
    $village = $row["Village"];
    $city = $row["City"];
    $doctor = $row["doctor"];
    $admdx = $row["adm_dx"];
    $dcdx = $row["dc_dx"];
    $dc_date = $row["Dc_Date"];
    $death_date=$row['Death_Date'];
    $death_time=$row['Death_Time'];

   
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
    <style>
        *{
            box-sizing:border-box;
        }
        body{
            background: #a6a6a6;
        }
        .container{
            width: 40%;
            margin: 10px auto;
            background-color:white;
            border-radius:10px;
        }
        img{
            border-radius:50%;
            box-shadow: 5px 5px 5px #ccc;
      -moz-box-shadow: 5px 5px 5px #ccc;
      -webkit-box-shadow: 5px 5px 5px #ccc;
      -khtml-box-shadow: 5px 5px 5px #ccc;
        }
        h1{
            margin-top:20px;
            margin-right:50px;
            font-weight:600;
            font-size:35px;
            font-family: "Trirong", serif;
        }
        .header{
            display:flex;
            justify-content:space-between;
        }
        label{
            margin:12px;
            
        }
        input{
            margin:10px;
            border-left: none;
            border-right: none;
            border-top: none;
            border-bottom: 3px solid green;
          

            outline:none;

        }
        select{
            margin: 10px;
            width: 170px;
            background-color: rgb(215, 208, 208);
        }
        .aa{
            display: flex;
            justify-content: center;
            margin: 20px;
        }
        .aa button{
            width: 70px;
            margin-right: 20px;
        }
     
        @media screen and (max-width:992px) {
            .container{
                width: 80%;
            }
            
        }
        @media screen and (max-width:500px) {
            .container{
                width: 100%;
            }
            
        }

    </style>
</head>
<body>
    <div class="container ">
        <form action="" method="post" autocomplete="on">
            <div class="header">
        <img src="./img/zlogo.png" alt="" style="width: 85px;height: 85px;">
        <h1>Patient Information Details</h1>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="adm-date">Admission Date :</label><br>
                <label for="adm-time">Admission Time :</label><br>
                <label for="name">Name :</label><br>
                <label for="age">Age :</label><br>
                <label for="ac">Age Category :</label><br>
                <label for="gender">Gender :</label><br>
                <label for="phone">Phone No:</label><br>
                <label for="name">Querter :</label><br>
                <label for="name">Village :</label><br>
                <label for="name">City :</label><br>
                <label for="name">Doctor :</label><br>
                <label for="adm-date">Admission Diagnosis :</label><br>
                <label for="adm-time">Discharge Diagnosis :</label><br>
                <label for="adm-date">Discharge Date :</label><br>
                <label for="adm-time">Death Date :</label><br>
                <label for="adm-time">Death Time :</label><br>
                
            </div>
            <div class="col-6">
                <input type="date" id="adm-date" name="adm-date" required value="<?php echo  $adm_date ?>" ><br>
                <input type="time" id="adm-time" name="adm-time" required value="<?php echo $adm_time ?>" ><br>
                <input type="text" id="name" name="name" required value="<?php echo $name ?>"  ><br>
                <input type="number" id="age" name="age" required value="<?php echo $age ?>"  ><br>
                <select name="ac" id="ac">
                    <option value="">Select Age Category</option>
                    <option value="day" <?php if($ac == 'day') echo 'selected= "selected"'; ?> >day</option>
                    <option value="month" <?php if($ac == 'month') echo 'selected= "selected"'; ?> >month</option>
                    <option value="year" <?php if($ac == 'year') echo 'selected= "selected"'; ?> >year</option>
                </select><br>
                <input type="radio" id="male" name="gender" value="male"<?php if($gender == 'male') echo 'checked= "checked"'; ?> required >
                <label for="male">male</label>
                <input type="radio" id="female" name="gender" value="female" <?php if($gender == 'female') echo 'checked= "checked"'; ?> required >
                <label for="female">female</label><br>
                
                <input type="tel" id="phone" name="phone" placeholder="09-12345-6789" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" value="<?php echo $phone ?>" ><br>
                <input type="text" id="querter" name="querter" value="<?php echo $querter ?>" ><br>
                <input type="text" id="village" name="village" value="<?php echo $village ?>" ><br>
                <input type="text" id="city" name="city" value="<?php echo $city ?>"><br>
                <select name="doctor" id="doctor" style="border: 1px solid #5cd65c;color:black;width: 200px;">
                <option value="">Select Doctor</option>
            <?php 
                                             $query="select * from doctor";
                                            $res = mysqli_query($conn, $query);
                                           while($rowd = mysqli_fetch_array($res))
                                              { ?>
                <option value="<?php echo $rowd['Do_ID']; ?>"<?php if($rowd['Do_ID']==$doctor) echo 'selected="selected"'; ?>> <?php echo $rowd['Do_Name']; ?> </option>
                <?php } ?>
            </select>
                <input type="text" id="admdx" name="admdx" value="<?php echo $admdx ?>"><br>
                <input type="text" id="dcdx" name="dcdx" value="<?php echo $dcdx ?>"><br>
                <input type="date" id="dc-date" name="dc-date" value="<?php echo $dc_date ?>" ><br>
                <input type="text" id="death-date" name="death-date" value="<?php  echo $death_date ?>" ><br>
                <input type="text" id="death-time" name="death-time" value="<?php echo $death_time ?>" ><br>
            </div>
        </div>
        <div class="row aa">
        <button class="btn btn-success" type="submit" name="submit">Change</button>
        <span class='btn btn-danger btn-lg'><a style='color:white' href='inpatient.php'>Back</a></span>
        </div>
    </form>
    </div>
</body>
</html>
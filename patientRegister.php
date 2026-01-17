<?php
require 'config.php';

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
  $dc_date = $_POST["dc-date"];
  $death_date = $_POST["death-date"];
  $death_time = $_POST["death-time"];

  $duplicate = mysqli_query($conn, "SELECT * FROM  inpatient WHERE  Ph_no = '$phone'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Patient Has Already Taken'); </script>";
  }
  else{
    
      $query = "INSERT INTO  inpatient VALUES('','$adm_date','$adm_time','$name','$age','$ac','$gender','$phone','$querter','$village','$city','$dc_date','$death_date','$death_time')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Patient Registration Successful'); </script>";
      header("Location: inpatient.php");
      
    
  }
}
?>
<?php



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
        .container{
            width: 40%;
            margin: 10px auto;
        }
        label{
            margin:12px;
        }
        input{
            margin:10px;
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
            width: 80px;
            margin-right: 20px;
        }
        @media screen and (max-width:500px) {
            .container{
                width: 100%;
            }
            
        }
    </style>
</head>
<body>
    <div class="container bg-primary">
        <form action="" method="post" autocomplete="on">
        <div class="row">
            <div class="col-6">
                <label for="adm-date">Admission Date :</label><br>
                <label for="adm-time">Admission Time :</label><br>
                <label for="name">Name :</label><br>
                <label for="age">Age :</label><br>
                <label for="ac">Age Category :</label><br>
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">male</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">female</label><br>
                <label for="phone">Phone No:</label><br>
                <label for="name">Querter :</label><br>
                <label for="name">Village :</label><br>
                <label for="name">City :</label><br>
                <label for="adm-date">Discharge Date :</label><br>
                <label for="adm-time">Death Date :</label><br>
                <label for="adm-time">Death Time :</label><br>
                
            </div>
            <div class="col-6">
                <input type="date" id="adm-date" name="adm-date" required><br>
                <input type="time" id="adm-time" name="adm-time" required><br>
                <input type="text" id="name" name="name" required><br>
                <input type="number" id="age" name="age" required><br>
                <select name="ac" id="ac">
                    <option value="">Select Age Category</option>
                    <option value="day">day</option>
                    <option value="month">month</option>
                    <option value="year">year</option>
                </select><br><br><br>
                <input type="tel" id="phone" name="phone" placeholder="09-12345-6789" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" required><br>
                <input type="text" id="querter" name="querter" ><br>
                <input type="text" id="village" name="village" ><br>
                <input type="text" id="city" name="city" required><br>
                <input type="date" id="dc-date" name="dc-date" ><br>
                <input type="date" id="death-date" name="death-date" ><br>
                <input type="time" id="death-time" name="death-time" ><br>
            </div>
        </div>
        <div class="row aa">
         
        
            <button class="btn btn-success" type="submit" name="submit">Save</button>
            <span class='btn btn-danger btn-lg'><a style='color:white' href='dashboard.php'>Back</a></span>

        </div>
    </form>
    </div>
</body>
</html>
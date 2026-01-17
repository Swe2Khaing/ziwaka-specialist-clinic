<?php
require 'config.php';
$did="";
if(isset($_GET['did']) )
{
    $did= $_GET['did'];
    

    $res=mysqli_query($conn,"select * from doctor where Do_ID='$did'");
    $row=mysqli_fetch_assoc($res);

    
    $name = $row["Do_Name"];
    $phone = $row["Ph_no"];
    $education = $row["Education"];
    $specialist =$row['Specialist'];
    $email = $row["Email"];
    
}
?>

<?php
/*============================= Update =====================================*/

if(isset($_POST['submit']))
{

    $name = $_POST["name"];
    $phone =$_POST["phone"];
    $education=$_POST["education"];
    $specialist=$_POST["specialist"];
    $email=$_POST["email"];
    $file = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name']; 
    
    $img_extension = pathinfo($file, PATHINFO_EXTENSION);  

    
            $newImageName =date("Y.m.d") . "-" . date("h.i.sa") . "-" . $file;
             move_uploaded_file($tmpName, 'img/' . $newImageName);

      mysqli_query($conn,"update doctor set do_image='$newImageName', Do_Name='$name', Ph_no='$phone', Education='$education',
      Specialist='$specialist', Email='$email' where Do_ID='$did'");
      echo "<script>alert('Update Successfully!')</script>";   

      $query = array(
        'did' =>  $did          
       );          
  
        $query = http_build_query($query); 
        header("Location:doctortable.php?$query"); 
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
        
    </style>
</head>
<body>
    <div class="container bg-primary">
        <h1>Doctor Editing</h1>
        <form action="" method="POST" autocomplete="on" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <label for="image">Doctor Photo :</label><br>
                <label for="name">Name :</label><br>
                <label for="phone">Phone Number :</label><br>
                <label for="education">Education :</label><br>
                <label for="female">Specialist</label><br>
                
                
            </div>
            <div class="col-6">
                <input type="file" id="image" name="image" required value="<?php echo $_FILES['do_image']; ?>"  ><br>
                <input type="text" id="name" name="name" required value="<?php echo $name ?>"  readonly><br>
                <input type="tel" id="phone" name="phone" required value="<?php echo $phone ?>" readonly><br>
                <input type="text" id="education" name="education" value="<?php echo $education ?>" ><br>
                <input type="text" id="specialist" name="specialist" value="<?php echo $specialist ?>" ><br>
                <input type="text" id="email" name="email" value="<?php echo $email ?>" >
                
            </div>
        </div>
        <div class="row aa">
        <button class="btn btn-success" type="submit" name="submit">Change</button>
        <span class='btn btn-danger btn-lg'><a style='color:white' href='doctortable.php'>Back</a></span>
        </div>
    </form>
    </div>
</body>
</html>
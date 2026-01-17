<?php
require 'config.php';
if(isset($_GET['InP_ID']) )
{
    
    $inp_id= $_GET['InP_ID'];

    $res=mysqli_query($conn,"select * from inpatient where InP_ID='$inp_id'");
    $row=mysqli_fetch_assoc($res);
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <span><?php echo $row["Inp_name"]; ?></span>
</body>
</html>
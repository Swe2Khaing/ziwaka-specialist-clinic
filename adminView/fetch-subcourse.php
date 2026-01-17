<?php
require_once "config.php";
$d_id = $_POST["d_id"];
$part = $_POST["part"];
$date_id = $_POST["date_id"];

if($date_id!=''){
$date = $date_id;

$day_name=date('l', strtotime($date));
}
echo "<script type='text/javascript'>alert('{$day_name}');</script>";
$result = mysqli_query($conn,"select * from times INNER JOIN schedule ON schedule.TID=times.TID
INNER JOIN doctor ON doctor.Do_ID=schedule.Do_ID INNER JOIN day ON schedule.D_ID=day.D_ID 
WHERE doctor.Do_Name='$d_id' AND day.Day='$day_name' AND times.pid='$part' ");
?>

<option value="">Select SubCategory</option>
<?php

while($row = mysqli_fetch_array($result)) 
{
?>
<option value="<?php echo $row["TID"];?>"><?php echo $row["Start"];?>----<?php echo $row["End"];?></option>
<?php
}
?>

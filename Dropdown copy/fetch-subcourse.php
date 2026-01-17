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
$result = mysqli_query($conn,"SELECT * FROM doctor INNER JOIN schedule ON schedule.Do_ID=doctor.Do_ID 
INNER JOIN times ON times.TID=schedule.TID INNER JOIN part_of_a_day ON part_of_a_day.pid=times.pid 
INNER JOIN day on day.D_ID=schedule.D_ID where day.Day = '$day_name' AND times.pid='$part'");
?>

<option value="">Select SubCategory</option>
<?php

while($row = mysqli_fetch_array($result)) 
{
?>
<option value="<?php echo $row["Do_ID"];?>"><?php echo $row["Do_Name"];?></option>
<?php
}
?>

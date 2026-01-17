

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
$result = mysqli_query($conn,"SELECT * FROM times INNER JOIN schedule ON schedule.TID=times.TID 
INNER JOIN day ON day.D_ID=schedule.D_ID 
INNER JOIN part_of_a_day ON part_of_a_day.pid=times.pid 
INNER JOIN doctor ON doctor.Do_ID=schedule.Do_ID 
WHERE schedule.Do_ID='$d_id' AND  day.Day='$day_name' AND part_of_a_day.pid ='$part'");
?>

<option value="">Select time </option>
<?php

while($row = mysqli_fetch_assoc($result)) 
{
?>
<option value="<?php echo $row["TID"];?>"><?php echo $row["Start"];?><?php echo $row["End"];?></option>
<?php
}
?>
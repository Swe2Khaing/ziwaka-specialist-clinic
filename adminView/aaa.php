<?php
require_once "config.php";

$part = $_POST["part"];
$date_id = $_POST["date_id"];


echo "<script type='text/javascript'>alert('{$date_id}');</script>";
$result = mysqli_query($conn,"SELECT * FROM booking 
INNER JOIN doctor ON doctor.Do_ID=booking.Do_ID 
INNER JOIN part_of_a_day ON part_of_a_day.pid=booking.pid
INNER JOIN times ON times.TID=booking.TID where booking.date = '$date_id'");
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

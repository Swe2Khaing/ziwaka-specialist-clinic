<?php
require_once "config.php";
$category_id = $_POST["doctor_id"];
$result = mysqli_query($conn,"SELECT *
FROM ((schedule
INNER JOIN time ON schedule.TID = time.TID)
INNER JOIN doctor ON schedule.Do_ID = doctor.Do_ID)
WHERE doctor.Do_ID='$category_id ' ; ");
?>
<option value="">Select SubCategory</option>
<?php
while($row = mysqli_fetch_array($result)) 
{
?>
<option value="<?php echo $row["TID"];?>"><?php echo $row["TID"];?><?php echo $row["Start"];?>--<?php echo $row["End"];?>--<?php echo $row["Part_of_a_day"];?></option>
<?php
}
?>
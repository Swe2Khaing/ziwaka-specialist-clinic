<?php
require_once "config.php";
$p_id = $_POST["p_id"];
$result = mysqli_query($conn,"SELECT * FROM times where pid = '$p_id' ");
?>
<option value="">Select Time</option>
<?php
while($row = mysqli_fetch_array($result)) 
{
?>
<option value="<?php echo $row["TID"];?>"><?php echo $row["Start"];?><?php echo $row["End"];?></option>
<?php
}
?>
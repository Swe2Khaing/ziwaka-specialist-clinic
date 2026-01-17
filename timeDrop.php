<?php
require_once "config.php";
$tid = $_POST["tid"];
$result = mysqli_query($conn,"SELECT * FROM part_of_a_day INNER JOIN times ON times.pid=part_of_a_day.pid where tid = '$tid' ");
?>
<option value="">Select Time</option>
<?php
while($row = mysqli_fetch_array($result)) 
{
?>
<option value="<?php echo $row["pid"];?>"><?php echo $row["pname"];?></option>
<?php
}
?>
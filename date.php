<?php
    require 'config.php';

     date_default_timezone_set('Asia/Yangon');
     $day=$date;
    //$day="2023-01-24";  // Date Format: Y/m/dd
    $date = date_create($day);
    $day_name=date_format($date,"l");
    
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
<?php $date="1";
      ?>
<form name="form" action="" method="get">
   
  <input type="text" name="subject" id="subject" value="<?php echo "Today is ".$day_name; ?>">
  <input type="text" value="<?php $date; ?>">
</form>
</body>

</html>

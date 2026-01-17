<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dependent Dropdown</title>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <!-- Styles -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
   </head>
   <body>
      <div class="container mt-5">
         <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card">
                  <div class="card-header">
                     <h2 class="text-primary">Make Appointment</h2>
                  </div>
                  <div class="card-body">
                     <form>
                     <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                    <label for="name">Age:</label>
                    <input type="text" id="name" name="name">
                    <select name="AC" id="AC">
                    <option value="">Age Category</option>
                            <option value="">days</option>
                            <option value="">months</option>
                            <option value="">years</option>
                    </select><br>
                    <label for="phone">Phone No:</label>
                    <input type="tel" id="phone" name="phone" placeholder="09-12345-6789" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" required><br>
                          
                           <div class="date">
                              <label for="date">Select Date</label>
                              <input type="date" name="date" id="date">
                           </div>
                           
                           <label for="CATEGORY-DROPDOWN">Doctor</label>
                           <select class="" id="select-doctor">
                              <option value="">Select Doctor
                              </option>
                              <?php
                                 require_once "config.php";
                                 $result = mysqli_query($conn,"SELECT * FROM doctor");
                                 while($row = mysqli_fetch_array($result)) 
                                 {
                                 ?>
                                  <option value="<?php echo $row['Do_ID'];?>"> <?php echo $row["Do_Name"];?> </option>
                              <?php
                                 }
                                 ?>
                           </select>
                           <label for="CATEGORY-DROPDOWN">Day</label>
                           <select class="" id="select-day">
                              <option value="">Select Day
                              </option>
                              <?php
                                 require_once "config.php";
                                 $result = mysqli_query($conn,"SELECT * FROM day");
                                 while($row = mysqli_fetch_array($result)) 
                                 {
                                 ?>
                                  <option value="<?php echo $row['D_ID'];?>"> <?php echo $row["Day"];?> </option>
                              <?php
                                 }
                                 ?>
                           </select>
                        
                        
                        
                           <label for="SUBCATEGORY">Time</label>
                           <select class="" id="select-time">
                           </select>
                        
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function() {

    $('#date').on('change', function() {
        var date = this.value;
        alert(date);
        $.ajax({
            url: "timeDrop.php",
            type: "POST",
            data: {
                date:date
            },
            cache: false,
            success: function(result) {
                $("#select-time").html(result);
            }
        });
    });
});
      </script>
   </body>
</html>
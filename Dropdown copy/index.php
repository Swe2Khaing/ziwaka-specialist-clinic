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
                     <h2 class="text-primary">Dependent Dropdown</h2>
                  </div>
                  <div class="card-body">
                     <form>
                        <div class="form-group">
                           <input type="date" id="date" name="date" >
                           <label for="CATEGORY-DROPDOWN">Category</label>
                           <select class="form-control" id="category-dropdown">
                              <option value="">Select Category</option>
                              <?php
                                 require_once "config.php";
                                 $result = mysqli_query($conn,"SELECT * FROM part_of_a_day");
                                 while($row = mysqli_fetch_array($result)) 
                                 {
                                 ?>
                                  <option value="<?php echo $row['pid'];?>"> <?php echo $row["pname"];?> </option>
                              <?php
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="">
                           <label for="doctor">Doctor</label>
                           <select class="form-control" id="sub-category-dropdown">
                           </select>
                        </div>
                        <div class="">
                           <label for="times">Time</label>
                           <select class="form-control" id="sub-category-dropdown1">
                           </select>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function() {
            
            var date_id;
            var part; 
    $('#date').on('change', function() {
      date_id = this.value;
        alert(date_id);
    });


    $('#category-dropdown').on('change', function() {
                part = this.value;
                alert(part);
                $.ajax({
                    url: "fetch-subcourse.php",
                    type: "POST",
                    data: {
                        part:part,
                        date_id:date_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#sub-category-dropdown").html(result);
                    }
                });
            });

            $('#sub-category-dropdown').on('change', function() {
                var d_id = this.value;
                alert(d_id);
                $.ajax({
                    url: "fetch-subcourse1.php",
                    type: "POST",
                    data: {
                        part:part,
                        date_id:date_id,
                        d_id:d_id
                        
                    },
                    cache: false,
                    success: function(result1) {
                        $("#sub-category-dropdown1").html(result1);
                    }
                });
            });
});
   
      </script>
   </body>
</html>
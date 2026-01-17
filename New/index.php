<!DOCTYPE html>
<html>
<head>
	<title>Search Data</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#ajaxdata").load("allpatientrecords.php");


		


			$("#text_search").keyup(function(){
				var data=$(this).val();
				$("#ajaxdata").load("searchdata.php",{result: data});
			});

			
		});
	</script>

</head>
<body>
<div class="container">
	<br><br>
	<center><h1><strong>Search/Filter Product Data</strong></h1></center>
	<br>
	
		
			
		


	<input type="text" name="valueToSearch" placeholder="Value To Search" id="text_search">
	<br><br>
	<div id="ajaxdata">
		
	</div>
</div>

</body>
</html
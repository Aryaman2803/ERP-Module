<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet", type="text/css", href="./css/dashboard.css">
		<script>
			function load_page(page){
				$.ajax({
					async: true,
					url: page,
					success: function(data){
						$('#frame').html(data);
					}
				});
			}
		</script>
	</head>
	<body onload="load_page('view.php')">
		<?php
			session_start();
			$desig = $_SESSION['desig'];
		?>
		<div class="header">
			<img src="./img/UPES_Logo.png" alt="www.upes.ac.in" width="20%" height="24%">
		</div>
		<div class="row menu">
			<div class="col-1">
				<ul>
					<li style="float:left;color:white"><?php echo $_SESSION['sapid'] ?></li>
					<a style = "float:right; color:white;  margin-bottom: 7px; padding: 8px" href="login.php" class="button">Logout</a>
				</ul>
			</div>
		</div>
		<div class="row menu">
			<div class="col-2">
			<ul>
					<li><a href="#" onclick="load_page('view.php')">View</a></li>
					<li><a href="#" onclick="load_page('edit.php')">Edit</a></li>
					<li><a href="#" onclick="load_page('report_chart.php?tab=r')">Report</a></li>
					<?php
					if($desig=="Manager")
					{
					?>
					<li><a href="#" onclick="load_page('report_chart.php?tab=tr')">Team Report</a></li>
					<?php
					}
					if($desig=="Administrator")
					{
					?>
					<li><a href="#" onclick="load_page('status.php?tab=ad')">Status Review</a></li>
					<li><a href="#" onclick="load_page('status.php?tab=ad')">Overall Report</a></li>
					<?php
					}
					?>
			</ul>
			</div>
			<div class="col-3" id="frame">

			</div>
		</div>
	</body>
</html>

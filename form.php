<!DOCTYPE html>
<html>

    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Research Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" href="./css/form.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
		<?php
    require('connection.php');
			session_start();
			$mon=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
			$sap_id = $_SESSION['sapid'];
			#$title = $_GET['title'];
		?>
		<form action="" method="POST">
			<fieldset style="background-color:#AFEEEE">
			<legend class= "bfont">General Information</legend>
				<div class="centerdiv" align="center">Title:<br><textarea rows="4" cols="100" name="title"></textarea><p id="p1"></p></i></span></div>
				<div class="leftdiv">Authors:<input type="text" name = "authors"></div>
				<div class="middlediv">Department:
					<select name="department" id="department">
						<option value="Computer Application">Computer Application</option>
						<option value="Cybernetics">Cybernetics</option>
						<option value="Informatics">Informatics</option>
						<option value="Systemics">Systemics</option>
						<option value="Virtualization">Virtualization</option>
					</select>
				</div>

				<div class="rightdiv">Affiliation: <input type="text" name="affiliation"></div>
			</fieldset>
			<fieldset style="background-color:#AFEEEE"">
			<legend class= "bfont">Publication Information</legend>
				<div class="middlediv">Publisher:&ensp; <input type="text" name="publisher"></div>
				<div class="middlediv">Identifier:
					<select name="identifier" id="identifier">
						<option value="ISSN">ISSN</option>
						<option value="ISBN">ISBN</option>
						<option value="ISSP">ISSP</option>
					</select>
				</div>
				<div class="rightdiv">Number:&nbsp; <input type="text" name="number"></div>
				<div class="middlediv">Indexed in:
					<select name="indexed" id="indexed">
						<option value="SCI">SCI</option>
						<option value="Scopus">Scopus</option>
						<option value="eSCI">eSCI</option>
						<option value="UGC Approved">UGC Approved</option>
						<option value="Other">Other</option>
						<option value="GOI Patent Office">GOI Patent Office</option>
						<option value="International Patent Office">International Patent Office</option>
					</select>
				</div>
				<div class="rightdiv">Volume: &ensp;<input type="text" name="value"></div>
				<div class="leftdiv">Issue: &ensp;&ensp;&ensp;<input type="text" name="issue"></div>
				<div class="middlediv">Page No.: &ensp;<input type="text" name="pageno"></div>
				<div class="leftdiv">DOI:&ensp;&ensp;&ensp;&nbsp; <input type="text" name="doi"></div>
				<div class="rightdiv">URL:&ensp;&ensp;&ensp; <input type="text" name="url"></div>


				<div class="rightdiv">Month:&ensp;&ensp;&ensp;
					<select name="month" id="month">
						<option value="<?php echo date("M");?>" select="selected"><?php echo date("M");?></option>
						<?php
							foreach($mon as $month)
							{
								if($month == date("M"))
									continue;
								echo "<option value=\"$month\">".$month."</option>";
							}
						?>
					</select>
				</div>
				<div class="leftdiv">Year: &ensp;&ensp;&ensp;&nbsp;<input type="text" name="year" value="<?php echo date("Y");?>"></div>
				<div class="leftdiv">Category:
					<select name="category" id="category">
						<option value="Journal">Journal</option>
						<option value="Conference">Conference</option>
						<option value="Book Chapter">Book Chapter</option>
						<option value="Book">Book</option>
						<option value="Magazine">Magazine</option>
						<option value="News Paper">News Paper</option>
						<option value="White Paper">White Paper</option>
						<option value="Patent">Patent</option>
						<option value="Transaction">Transaction</option>
					</select>
				</div>
			</fieldset>
			<fieldset style="background-color:#AFEEEE"">
				<legend class= "bfont">Submission Information</legend>
				<div class="leftdiv">Verification Document:
					<select name="verification" id="verification">
						<option value="Certificate">Certificate</option>
						<option value=""></option>
						<option value=""></option>
					</select>
				</div>
				<div class="middlediv">Paper Status:
					<select name="remarks" id="status">
						<option value="Submitted">Submitted</option>
						<option value="Accepted">Accepted</option>
						<option value="In-print">In-print</option>
						<option value="Published">Published</option>
					</select>
				</div>
				<div class="rightdiv"><input type="submit" value="Submit" onclick = "location.href='edit.php'" name="submit">
				<input type = "button" onclick = "location.href='edit.php'" value = "Back">
				</div>
			</fieldset>
		</form>
    <script type="text/javascript">
      var title = "<?php echo(SELECT * from data WHERE title=104)?>";
      var inputVal = document.getElementById("title").value;
      var inputVall = "inputVal";
      if(title !== inputVall){
      document.getElementById("p1").innerHTML = "&#9989;";
      document.getElementById("submit").disabled = false;
      }
      else{
      document.getElementById("p1").innerHTML = "&#10062;";
      document.getElementById("submit").disabled = true;
      }
    </script>
		<?php
			if(isset($_POST['submit']))
			{
				$title = $_POST['title'];
				$authors = $_POST['authors'];
				$department = $_POST['department'];
				$affiliation= $_POST['affiliation'];
				$category = $_POST['category'];
				$publisher = $_POST['publisher'];
				$month = $_POST['month'];
				$year = $_POST['year'];
				$identifier = $_POST['identifier'];
				$number = $_POST['number'];
				$doi = $_POST['doi'];
				$indexed = $_POST['indexed'];
				$volume = $_POST['value'];
				$issue = $_POST['issue'];
				$pageno = $_POST['pageno'];
				$url = $_POST['url'];
				$verification = $_POST['verification'];
				$remarks = $_POST['remarks'];
				$status = "Pending";
				$query = "INSERT INTO data (sap_id,title,authors,department,affiliation,category,publisher,month,year,identifier,number,doi,indexed,volume,issue,page_no,url,verification_document,status,remarks) VALUES($sap_id,'$title','$authors',
				'$department','$affiliation','$category','$publisher','$month',$year,'$identifier','$number','$doi','$indexed',$volume,$issue,'$pageno','$url','$verification','$status','$remarks')";
				#var_dump($result);
				$result = mysqli_query($db,$query);
				if(!$result)
				{
					die("You cannot leave fields empty");
				}
				else
				{
					echo "New record created successfully";


				}
			}
		?>
	</body>
</html>

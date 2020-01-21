<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/all.css">
<style type = "text/css">
#filter{
	height:380px;
	width:340px;
	margin:0
	auto;
	position:fixed;
	z-index:10;
	display:none;
	border:5px solid #cccccc;
	border-radius:10px;
	background-color: #aaaaaa;
}
</style>
<script>
function filter()
{
	document.getElementById("filter").style.display = "block";
}

</script>
</head>
<body onload="applyfilter();">
<?php
session_start();
$desig = $_SESSION['desig'];
$index = $_GET['index'];
$tab = $_SESSION['tab'];
$sap = $_SESSION["sapid"];
$dep = $_SESSION["dep"];
$mon=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
?>
<h1>REPORT<h1>
<h3>Publications indexed in SCOPUS & above</h3>
<button style="float:left;" onclick="filter();">Filter</button>
<br>
<br>
<div id="try">

</div>
<div style = "align:right;position:absolute; left:5%; top:23%" id ="filter">
<h3>Filter</h3>
<?php
if($desig == "Manager" and $tab == "tr")
	{
		?>
		Name:<input type = "text" name="name" id="name"><br><br>
		<?php
	}
?>
Category:<select name = "category" id ="category">
			<option value = "" select = "selected" name= "category" >Category</option>
			<option value="Journal" >Journal</option>
			<option value="Conference">Conference</option>
			<option value="Book Chapter">Book Chapter</option>
			<option value="Book">Book</option>
			<option value="Magazine">Magazine</option>
			<option value="News Paper">News Paper</option>
			<option value="White Paper">White Paper</option>
			<option value="Patent">Patent</option>
			<option value="Transaction">Transaction</option>
			</select><br><br>
Month:<select name="month" id="month">
						<option value="" select="selected">Month</option>
						<?php
							foreach($mon as $month)
							{

								echo "<option value=\"$month\">".$month."</option>";
							}
						?>
					</select><br><br>
Year:<input type="year" id ="year"><br><br>
Identifier:<select name="identifier" id="identifier">
					<option value = "" select = "selected" name= "identifier" >Identifier</option>
						<option value="ISSN">ISSN</option>
						<option value="ISBN">ISBN</option>
						<option value="ISSP">ISSP</option>
					</select><br><br>
Indexed in:<select name="indexed" id="indexed">
					<option value = "" select = "selected" name= "indexed" >Indexed In:</option>
						<option value="SCI">SCI</option>
						<option value="Scopus">Scopus</option>
						<option value="eSCI">eSCI</option>
						<option value="UGC Approved">UGC Approved</option>
						<option value="Other">Other</option>
						<option value="GOI Patent Office">GOI Patent Office</option>
						<option value="International Patent Office">International Patent Office</option>
					</select><br><br>
Remarks:<select name="remarks" id="remarks">
			<option value = "" select = "selected" name= "remarks" >Remarks</option>
						<option value="Submitted">Submitted</option>
						<option value="Accepted">Accepted</option>
						<option value="In-print">In-print</option>
						<option value="Published">Published</option>
					</select><br><br>
<input style="right:25%; position:absolute" type= "submit" name = "submit" onclick="applyfilter();" value = "Filter">
<input style="right:5%; position:absolute" type= "submit" name = "back" onclick="hide();" value = "Back">
</div>
<script>
function applyfilter()
{
	var index = "<?php echo $index; ?>";
	document.getElementById("filter").style.display = "none";
	var name_element = document.getElementById("name")
	if(name_element)
	{
		var name = document.getElementById("name").value;
		if(name!='')
	{
		query=query.concat(" AND name= '"+name+"'");
	}
	}
	var category = document.getElementById("category").value;
	var month = document.getElementById("month").value;
	var year = document.getElementById("year").value;
	var identifier = document.getElementById("identifier").value;
	var indexed = document.getElementById("indexed").value;
	var remarks = document.getElementById("remarks").value;
	var tab = "<?php echo $tab; ?>";
	if(tab=="tr")
	{
		var query = "SELECT * FROM data where department = '<?php echo $dep; ?>'";
	}
	else{
	var query = "SELECT * FROM data WHERE sap_id = '<?php echo $sap; ?>'";
	}
	if(category!="")
	{
		query=query.concat(" AND category = '"+category+"'");
	}
	if(month!="")
	{
		query=query.concat(" AND month = '"+month+"'");
	}
	if(year!="")
	{
		query=query.concat(" AND year = '"+year+"'");
	}
	if(identifier!="")
	{
		query=query.concat(" AND identifier = '"+identifier+"'");
	}
	if(indexed!="")
	{
		query=query.concat(" AND indexed = '"+indexed+"'");
	}
	if(remarks!="")
	{
		query=query.concat(" AND remarks = '"+remarks+"'");
	}
	var httprequest = new XMLHttpRequest();
	httprequest.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
    document.getElementById("try").innerHTML = this.responseText;
    }
  };
  httprequest.open("GET", "report1.php?q="+query, true);
  httprequest.send();
}
function hide()
{
	document.getElementById("filter").style.display = "none";
}
</script>
</body>
</html>

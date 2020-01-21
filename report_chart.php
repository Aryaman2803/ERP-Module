<html>
   <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Report</title>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
   </head>
   <body>
      <div class="container">
        <h2>Publications indexed in Scopus and Above</h2>
        <canvas id="myChart"></canvas>
      </div>
	  <?php
    require('connection.php');
    session_start();
    $sap = $_SESSION['sapid'];
    $tab = $_GET['tab'];
    $_SESSION['tab'] = $tab;
    $count = 0;
    $indexed=array("SCI","Scopus","eSCI","UGC Approved","Other");
    foreach($indexed as $index)
    {
    $query = "SELECT * FROM data WHERE sap_id = $sap AND indexed = '".$index."'";
    $result = mysqli_query($db,$query);
    if(!$result)
    {
    	die("unable to connect");
    }
    $ind["$index"]=mysqli_num_rows($result);
    }
?>
 <script language = "JavaScript">
 	var SCI = parseInt("<?php echo $ind['SCI']; ?>",10);
			var SCOPUS = parseInt("<?php echo $ind['Scopus']; ?>",10);
			var eSCI = parseInt("<?php echo $ind['eSCI']; ?>",10);
			var UGC = parseInt("<?php echo $ind['UGC Approved']; ?>",10);
			var other = parseInt("<?php echo $ind['Other']; ?>",10);
			var data =[SCI,SCOPUS,eSCI,UGC,other];
			var labels = ["SCI","SCOPUS","eSCI","UGC","other"];
			var datas = [
                  ['Firefox',   SCI],
                  ['IE',       26.8],
                  ['Safari',    8.5],
                  ['Opera',     6.2],
                  ['Others',   0.7]
               ];
    var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: labels,
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",

      ],
      data: data
    }]
  },
  options:{
    hover: {
      onHover: function(e,a) {
       /* $("#canvas1").css("cursor", e[0] ? "pointer" : "default");

         without jquery it can be like this:*/
          var el = document.getElementById("myChart");
          el.style.cursor = a[0] ? "pointer" : "default";

      }
    },
    plugins:{
      datalabels:{
        labels: {
                    value: {
                        color: 'red',
                        font:{size: '20'}
                    }
                }
      }
    },
	  onClick: function(evt){
      var activePoint = myChart.getElementsAtEvent(evt);
      var selectedIndex = activePoint[0]._index;
      var label = this.data.labels[selectedIndex];
      var value = this.data.datasets[0].data[selectedIndex];
      window.open("report.php?index="+label,"_blank");
    }
  }
});
      </script>
   </body>

</html>

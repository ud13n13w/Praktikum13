<?php

	include('koneksi.php');

	$query 	= "SELECT * FROM tbl_covid19";
	$result	= mysqli_query($koneksi, $query);

	if( mysqli_num_rows($result) > 0 ){

		while( $row = mysqli_fetch_assoc($result) ){

			$country[] 			= $row['country'];
			$total_cases[]		= $row['total_cases'];
			$new_cases[]		= $row['new_cases'];
			$total_deaths[]		= $row['total_deaths'];
			$new_deaths[]		= $row['new_deaths'];
			$total_recovered[] 	= $row['total_recovered'];
			$active_cases[] 	= $row['active_cases'];

		}

	}else{
		echo "<script> alert('Tidak ada data pada Tabel '); </script>";
	}

	//print_r($country);
	//print_r($total_cases);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>

	<div style="width: 100%;">
		<canvas id="chart_line"></canvas>
	</div>

	<script>

		var ctx  = document.getElementById("chart_line").getContext("2d");
		
		var data = {

					labels : <?php echo json_encode($country); ?>,

					datasets : [

								{
									label 	: "Total Cases",
									data 	: <?php echo json_encode($total_cases); ?>,
									fill	: false,
									lineTension 	: 0.4,
									backgroundColor : "rgba(255, 25, 25, 1)",
									borderColor 	: "rgba(255, 25, 25, 1)"
								},

								{
									label 	: "New Cases",
									data 	: <?php echo json_encode($new_cases); ?>,
									fill	: false,
									lineTension 	: 0.4,
									backgroundColor : "rgba(255, 140, 25, 1)",
									borderColor 	: "rgba(255, 140, 25, 1)"
								},

								{
									label 	: "Total Deaths",
									data 	: <?php echo json_encode($total_deaths); ?>,
									fill	: false,
									lineTension 	: 0.4,
									backgroundColor : "rgba(255, 255, 25, 1)",
									borderColor 	: "rgba(255, 255, 25, 1)"
								},

								{
									label 	: "New Deaths",
									data 	: <?php echo json_encode($new_deaths); ?>,
									fill	: false,
									lineTension 	: 0.4,
									backgroundColor : "rgba(140, 255, 25, 1)",
									borderColor 	: "rgba(140, 255, 25, 1)"
								},
								{
									label 	: "Total Recovered",
									data 	: <?php echo json_encode($total_recovered); ?>,
									fill	: false,
									lineTension 	: 0.4,
									backgroundColor : "rgba(25, 255, 25, 1)",
									borderColor 	: "rgba(25, 255, 25, 1)"
								},
								{
									label 	: "Active Cases",
									data 	: <?php echo json_encode($active_cases); ?>,
									fill	: false,
									lineTension 	: 0.4,
									backgroundColor : "rgba(25, 255, 140, 1)",
									borderColor 	: "rgba(25, 255, 140, 1)"
								}
					]

		};

		var myLineChart = new Chart(ctx, {
		    type: 'line',
		    data: data,
		    options: {
	    	            scales: {
	    	            			yAxes: [{
		    	            			ticks: {
		    	                      		min: 0,
		    	                  		}
	    	              			}],
	    	            			xAxes: [{
	    	                        	gridLines: {
	    	                            	color: "rgba(0, 0, 0, 0)",
	    	                        	}
    	                    		}]
	    	            }
    	            }
		});

	</script>

</body>
</html>
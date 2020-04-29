<?php

	include('koneksi.php');

	$query 	= "SELECT * FROM tbl_covid19";
	$result	= mysqli_query($koneksi, $query);

	if( mysqli_num_rows($result) > 0 ){

		while( $row = mysqli_fetch_assoc($result) ){

			$country[] 		= $row['country'];
			$total_cases[]	= $row['total_cases'];

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

	<div id="canvas-holder" style="width:90%">
		<canvas id="chart-area"></canvas>
	</div>

	<script>
		
		var config = {
						type:'pie',
						data:{
								labels: <?php echo json_encode($country); ?> ,
								datasets:[
										{
											label:'Presentase Kasus Covid-19',
											data:<?php echo json_encode($total_cases); ?>,
											backgroundColor: [
												'rgba(255, 25, 25, 0.4)',
												'rgba(255, 140, 25, 0.4)',
												'rgba(255, 255, 25, 0.4)',
												'rgba(140, 255, 25, 0.4)',
												'rgba(25, 255, 25, 0.4)',
												'rgba(25, 255, 140, 0.4)',
												'rgba(25, 255, 255, 0.4)',
												'rgba(25, 140, 255, 0.4)',
												'rgba(25, 25, 255, 0.4)',
												'rgba(140, 25, 255, 0.4)',
												'rgba(255, 25, 255, 0.4)'
											],
											borderColor:[
												'rgba(255, 25, 25, 1)',
												'rgba(255, 140, 25, 1)',
												'rgba(255, 255, 25, 1)',
												'rgba(140, 255, 25, 1)',
												'rgba(25, 255, 25, 1)',
												'rgba(25, 255, 140, 1)',
												'rgba(25, 255, 255, 1)',
												'rgba(25, 140, 255, 1)',
												'rgba(25, 25, 255, 1)',
												'rgba(140, 25, 255, 1)',
												'rgba(255, 25, 255, 1)'
											],
										}
								]

						},
						options: {
							responsive:true
						}
		}

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function(){

			config.data.datasets.forEach(function(dataset){

				dataset.data = dataset.data.map(function(){
					return randomScalingFactor();
				});

			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function(){

			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for(var index = 0; index < config.data.labels.length; ++index){

				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function(){
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});

	</script>

</body>
</html>
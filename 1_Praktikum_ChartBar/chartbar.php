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

	<div style="width: 1200px;">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		
		var ctx = document.getElementById("myChart").getContext("2d");
		
		var myChart = new Chart(ctx, {
										type:'bar',
										data:{
												labels	: <?php echo json_encode($country); ?>,
												datasets: [
															{
																label			: 'Grafik Covid-19',
																data 			: <?php echo json_encode($total_cases); ?> ,
																backgroundColor	: 'rgba(64, 215, 215, 0.4)',
																borderColor		: 'rgb(0, 0, 0)',
																borderWidth		: 1
															}
												]
										},
										options: {
											scales:{

												yAxes: 	[
															{
																ticks: {
																	beginAtZero:true
																}
															}
												]

											}
										}
									 }

		);

	</script>

</body>
</html>
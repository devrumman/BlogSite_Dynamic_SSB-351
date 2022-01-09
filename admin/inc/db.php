
<?php 
	$connect = mysqli_connect("localhost", "root", "", "ssb_351_rumman");
 
	if ($connect) 
	{
		//echo "Conncted";
	}

	else{
		die("Databese Connection Faild. " . mysqli_error($connect));
	}
 ?>
 
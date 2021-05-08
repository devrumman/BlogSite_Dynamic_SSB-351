
<?php 
	$connect = mysqli_connect("localhost", "root", "", "ssb351");
 
	if ($connect) 
	{
		//echo "Conncted";
	}

	else{
		die("Databese Connection Faild. " . mysqli_error($connect));
	}
 ?>
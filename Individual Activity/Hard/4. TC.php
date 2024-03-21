<?php 
	$temperature = 25;
	$unit = "C";
	$fahrenheit = ($temperature * 9/5) + 32;
	$celsius = ($fahrenheit - 32) * 5/9;
	
	if ($unit == "C") {
		echo "$temperature C i equal to  $fahrenheit F";
	} else if ($unit == "F") {
		echo "$fahrenheit F i equal to  $celsius C";	
	} else {
		echo "Invalid unit";
	}
?>	
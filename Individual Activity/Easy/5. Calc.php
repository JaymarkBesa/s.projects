<?php 
	$operation = "+";
	$num1 = 5;
	$num2 = 3;
	
	if ($operation == "+") {
		$result = $num1 + $num2;		
	} else if ($operation == "-") {
		$result = $num1 - $num2;
	} else {
		echo "invalid operation";
		return;
	}
	
	echo "The result of $num1 $operation $num2 is $result";
?>
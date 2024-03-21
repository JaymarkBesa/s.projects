<?php 
	function generatePassword($length) {
		$chars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789";
		$password = "";
		
		for ($i = 0; $i < $length; $i++) {
			$password .= $chars[rand(0, strlen($chars) - 1)];
		}
		
		return $password;
	}

	$passwordLength = 8;
	$password = generatePassword($passwordLength);
	echo "Your generated password is: $password";
?>	
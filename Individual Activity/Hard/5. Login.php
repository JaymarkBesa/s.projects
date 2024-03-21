<?php 
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$USERNAME = $_POST['username'];
		$PASSWORD = $_POST['password'];
		
		if ($USERNAME == 'admin' && $PASSWORD == 'secret') {
			$_SESSION['logged_in'] = true;
			header("Location: welcome.php");	
		} else {
			echo "invalid username or password";
		}

	}
?>

<form method="post">
	<label for="username">Username:</label>
	<input type="text" id="username" name="username">
	<label for="password">Password:</label>
	<input type="password" id="password" name="password">
	<input type="submit" value="submit">
</form>

	

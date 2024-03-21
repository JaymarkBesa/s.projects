<?php 
	// Read a file
	$content = file_get_contents("myfile.txt");
	echo "File content: $content";

	//Write to a file
	$newContent = "This is new content";
	file_put_contents("myfile.txt", $newContent);
?>	
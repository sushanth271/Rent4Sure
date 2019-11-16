<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$source="/home/overlord1109/Downloads/test.jpg";
	$dest="/home/overlord1109/uploads";
	if(move_uploaded_file($source, $dest))
	{
		echo "SUCCESSFUL";
	}
	else
	{
		echo "UNSUCCESSFUL";
	}
?>
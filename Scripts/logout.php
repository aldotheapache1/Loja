<?php
	session_start();
	session_destroy();
	unset($_SESSION['login']);
	unset($_SESSION['senha']);

	$response = array("success" => true);
	echo json_encode($response);
	
?>
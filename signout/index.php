<?php
	
	require '../classes/_header.php';
	
	if (!$user->userConnected()){
		header("location:../");
	} else {
		$user->signout();
		header("location:../");
	}




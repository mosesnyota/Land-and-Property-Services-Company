<?php
	//Start session
	session_start();
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID_']) || (trim($_SESSION['SESS_MEMBER_ID_']) == '')) {
		header("location: index.php");
		exit();
	}
if ((time()-$_SESSION['lastactivity'])>=1600000){//logout user after 10 minutes of inactivity
	header("location: index.php");
		exit();
	}else{
	$_SESSION['lastactivity'] = time();
	
	}

?>
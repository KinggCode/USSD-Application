<?php

	 session_start() ;

	
	if (isset($_SESSION['sess1']) ){

		echo $_SESSION['sess1'];

		$_SESSION['sess1']++ ;

	

	}
	else{

		$_SESSION['sess1'] = 0 ;
		echo $_SESSION['sess1'];

	}

	
	

?>
<?php 
if(isset($_POST["PAGE"])){
		require_once("../include/connessione_mysqli.php");
		require_once("../resources/navigation_functions.php");
		$conn = openConn();
	
		$page = urldecode($_POST["PAGE"]);
		
		$dateFrom = $_POST["DATE_FROM"];
		$dateTo = $_POST["DATE_TO"];
		
		$stats = getPageVisitors($conn,$page,$dateFrom,$dateTo);
		
		
		
	
		//closeConn($conn);
		echo($stats);
}
?>
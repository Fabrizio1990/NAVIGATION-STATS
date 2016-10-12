<script type="text/javascript" src="js/navigation.js" ></script>

<?php 

 require_once("navigation_functions.php");
 require_once("include/connessione_mysqli.php");
 
 $conn = openConn();
 
 //if (session_status() == PHP_SESSION_NONE)session_start();
 
 if(!isset($_COOKIE["guest_id"])){
	 $unique_id = uniqid();
	 setcookie("guest_id", $unique_id, mktime(24,0,0));
	 $_COOKIE['guest_id'] = $unique_id;
	 //SE LE TABELLE NON ESISTONO LE CREO
	 initDb($conn);
	 // SE NUOVO UTENTE LO SALVO
	 saveNewUser($conn,$_COOKIE["guest_id"]);
	 
 }
 
 
 $previous_page = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"diretto";
 $current_page	= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 // NAVIGATION TRACKING
 saveNavigation($conn,$_COOKIE["guest_id"],$previous_page,$current_page);
 closeConn($conn);

 
 
 
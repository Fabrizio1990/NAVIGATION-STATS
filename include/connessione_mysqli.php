 
 <?php
    
   $local =true;

   if($local){
	 $SITE_URL = "http://localhost/Tecnoimmobili/SITE/";
     $CN_serverName  = "localhost";
     $CN_dbName = "test";
     $CN_user = "root";
     $CN_password	= "";    
   }else{
	 $SITE_ULR = "";
     $CN_serverName  = "";
     $CN_dbName = "";
     $CN_user = "";
     $CN_password	= "";  
   }
    
	
    
    function openConn(){

      global $CN_serverName, $CN_user, $CN_password, $CN_dbName;
      $conn = null;
      $conn = new mysqli($CN_serverName, $CN_user, $CN_password, $CN_dbName);
      if (mysqli_connect_error()) {
      die('Connect Error (' . mysqli_connect_errno() . ') '
              . mysqli_connect_error());
      }else{
        if (!$conn->set_charset("utf8")) {
          //printf("Error loading character set utf8: %s\n", $conn->error);
        } else {
          //printf("Current character set: %s\n", $conn->character_set_name());
        }
      }
      return $conn;
    }
    
    function closeConn($cn){
      mysqli_close($cn);
      
    }

    //echo("connected".$conn->host_info);
 ?>
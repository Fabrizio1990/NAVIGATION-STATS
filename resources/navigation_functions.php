<?php 
function saveNewUser($conn,$guest_id){
	 $query = "INSERT IGNORE INTO session_visitators (session_id) values('".$guest_id."')";
	 $conn->query($query) or die("error saving new guest");
 }
 
function saveNavigation($conn,$guest_id,$previous_page,$current_page){
	 $query = "INSERT IGNORE INTO session_pages_visited (session_id,prev_page,current_page) values('".$guest_id."','".$previous_page."','".$current_page."')";
	 $conn->query($query) or die("error saving statistic");
 }
 
function getPageVisitors($conn,$page,$date_start,$date_end =null){
	$start_day_time = " 00:00:01";
	$end_day_time = " 23:59:59";
	
	$query = "select count(distinct session_id) as CNT from session_pages_visited where current_page='".$page."' ";
	$query.= " AND date >='" . $date_start . $start_day_time . "' " ;
	$query.= " AND date <='" . ($date_end==null?$date_start:$date_end) . $end_day_time . "' " ;
	//echo($query);
	$result = $conn->query($query) or die(/*mysqli_error($conn)*/"ERRORE STATS");
	$res	= mysqli_fetch_row($result);
	
	return $res[0];
}
 
function initDb($conn){
	$query = "CREATE TABLE IF NOT EXISTS `session_pages_visited` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `session_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
	  `prev_page` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
	  `current_page` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
	  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `SESSION_ID_INDEX` (`session_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

	$query .= "CREATE TABLE IF NOT EXISTS `session_visitators` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `session_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
	  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `session_id_UNIQUE` (`session_id`),
	  KEY `session_id_INDEX` (`session_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	
	if (!$conn->multi_query($query)) {
		echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
	}

	do {
		if ($res = $conn->store_result()) {
			//var_dump($res->fetch_all(MYSQLI_ASSOC));
			$res->free();
		}
	} while ($conn->more_results() && $conn->next_result());
}


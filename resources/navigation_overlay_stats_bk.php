<link href="css/navigation_overlay_stats.css" rel="stylesheet" type="text/css" media="screen" />
<?php 
if(isset($_GET["PAGE"])){
	
	require_once("../include/connessione_mysqli.php");
	require_once("../resources/navigation_functions.php");
	$conn = openConn();
	
	$page = urldecode($_GET["PAGE"]);
	$visit_today = getPageVisitors($conn,$page,date("Y-m-d"));
	
	?>
	
		<div id="NAV_STATS_CONTAINER">
			<div id="NAV_FILTERS_CONTAINER">
				<table>
					<tr>
						<td> Dal </td>
						<td> <input type="date" name="date_from" id="date_from" value="<?php echo date("Y-m-d") ?>" /> </td>
					</tr>
					<tr>
						<td> Al </td>
						<td> <input type="date" name="date_to" id="date_to" value="<?php echo date("Y-m-d") ?>" /> </td>
					</tr>
				</table>
			</div>
			<!--<div class="NAV_SEPARATOR"></div>-->
			<div id="NAV_VISIT_CONTAINER">
				<table width="100%">
					<tr>
						<td><p class="NAV_P_VISIT" id="UNIQUE_VISIT_TODAY"><b>Visite odierne univoche: </b><br><?php echo $visit_today ?></p></td>
						<td><p class="NAV_P_VISIT" id="UNIQUE_VISIT_WEEK"><b>Visite settimanali univoche: </b><br><?php echo $visit_today ?></p></td>
						<td><p class="NAV_P_VISIT" id="UNIQUE_VISIT_MONTH"><b>Visite mensili univoche: </b><br><?php echo $visit_today ?></p></td>
						<td><p class="NAV_P_VISIT" id="UNIQUE_VISIT_YEAR"><b>Visite univoche nel range selezionato: </b><br><?php echo $visit_today ?></p></td>
					</tr>
				</table>
			</div>
		</div>
<?php 
	closeConn($conn);
}
?>


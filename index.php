<!DOCTYPE html>
<html lang="it">
<head>
<title>Index test tracciamento</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<script>
	/*var curr = new Date; // get current date
	var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
	var last = first + 6; // last day is the first day + 6

	var firstday = new Date(curr.setDate(first)).toUTCString();
	var lastday = new Date(curr.setDate(last)).toUTCString();*/
	
	/*console.log(firsday);
	console.log(lastday);*/

</script>
<body>
	<h1>index</h1>
	<?php echo date('r', mktime(24,0,0)), ' ',  date('r'); ?>
	<?php echo "<br>".date("Y-m-d") ?>
	<a href="pagina1.php">vai a pagina 1</a>
	
	
	<?php include("resources/navigation_stat.php"); ?>
</body>
</html>

<link href="css/navigation_overlay_stats.css" rel="stylesheet" type="text/css" media="screen" />

	
		<div id="NAV_STATS_CONTAINER">
			<div id="NAV_FILTERS_CONTAINER">
				<table>
					<tr>
						<td> Dal </td>
						<td> <input type="date" name="NAV_DATE_FROM" id="NAV_DATE_FROM" value="<?php echo date("Y-m-d") ?>" /> </td>
					</tr>
					<tr>
						<td> Al </td>
						<td> <input type="date" name="NAV_DATE_TO" id="NAV_DATE_TO" value="<?php echo date("Y-m-d") ?>" /> </td>
					</tr>
				</table>
			</div>
			<div id="NAV_VISIT_CONTAINER">
				<table width="100%">
					<tr>
						<td><p class="NAV_P_VISIT" ><b>Visite odierne univoche: </b><br><span id="UNIQUE_VISIT_TODAY">0</span></p></td>
						<td><p class="NAV_P_VISIT" ><b>Visite settimanali univoche: </b><br><span id="UNIQUE_VISIT_WEEK">0</span></p></td>
						<td><p class="NAV_P_VISIT" ><b>Visite mensili univoche: </b><br><span id="UNIQUE_VISIT_MONTH">0</span></p></td>
						<td><p class="NAV_P_VISIT" ><b>Visite univoche nel range selezionato </b><br><span id="UNIQUE_VISIT_CUSTOM">0</span></p></td>
					</tr>
				</table>
			</div>
		</div>



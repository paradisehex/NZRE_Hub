<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="line">Select Filter</div>
		<p>
			<?php
				
				$Names = array();
				$result = selectFrom("TagTable", null, null);
				while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					array_push($Names,$row['Name']);
				}
				
				natcasesort ($Names);
			?>
			<form action="../" method="get" autocomplete="off">
				<select name="Tag">
					<option value="0">All Tags</option>
					<?php
						foreach($Names as $Name){
							$Tag = mysqli_fetch_array(selectFrom("TagTable", array("Name"), array($Name)));
							echo "<option value=\"".$Tag['ID']."\">".$Name."</option>";
						}
					?>
				</select>
				<select name="Location">
					<option value="0">New Zealand</option>
					<option value="1">Northland</option>
					<option value="2">Auckland</option>
					<option value="3">Waikato</option>
					<option value="4">Bay of Plenty</option>
					<option value="5">Gisborne</option>
					<option value="6">Hawke's Bay</option>
					<option value="7">Taranaki</option>
					<option value="8">Manawatu-Wanganui</option>
					<option value="9">Wellington</option>
					<option value="10">Nelson-Tasman</option>
					<option value="11">Marlborough</option>
					<option value="12">West Coast</option>
					<option value="13">Canterbury</option>
					<option value="14">Otago</option>
					<option value="15">Southland</option>
				</select>
				<br>
				<input class="button" type="submit" value="View" >
			</form>
		</p>
	</body>
</html>

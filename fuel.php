<?php
	require_once 'security.php';
	require_once "db.php";
		
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$sql = "UPDATE key_values SET v = ? WHERE k = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ss", $param_value, $param_key);
			$param_value = $_POST['current'];
			$param_key = 'current';
			mysqli_stmt_execute($stmt);
			
			$param_value = $_POST['capacity'];
			$param_key = 'capacity';
			mysqli_stmt_execute($stmt);
			
			$param_value = $_POST['buffer'];
			$param_key = 'buffer';
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_close($stmt);
		}
	}
		
	
	$rows = [];
	$sql = "SELECT id, refueling_date, odometer, refueled FROM refueling WHERE deleted = 0 ORDER BY refueling_date DESC";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$rows[] = $row;
			}
		} else{
			#echo "<p class='lead'><em>Keine Daten gefunden</em></p>";
		}
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
	
	$sql = "SELECT k, v FROM key_values WHERE k = 'current'";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			$current = mysqli_fetch_array($result)['v'];
		}else{
			#echo 'insert';
		}
	}else{
		echo 'failed ' . $sql;
	}

	$sql = "SELECT k, v FROM key_values WHERE k = 'capacity'";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			$capacity = mysqli_fetch_array($result)['v'];
		}else{
			#echo 'insert';
		}
	}else{
		echo 'failed ' . $sql;
	}
	
	$sql = "SELECT k, v FROM key_values WHERE k = 'buffer'";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			$buffer = mysqli_fetch_array($result)['v'];
		}else{
			#echo 'insert';
		}
	}else{
		echo 'failed ' . $sql;
	}

	mysqli_close($link);
	
	
	//calculation
	$consumption_sum = 0.0;
	for ($i = 0; $i < count($rows) - 1; $i++) {
		$difference = $rows[$i]['odometer'] - $rows[$i+1]['odometer'];
		$consumption = round(100 * $rows[$i]['refueled'] / ($difference), 3);
		$rows[$i]['consumption'] = number_format($consumption, 3, ',', '.');
		$consumption_sum += $consumption;
	}
	$avg_consumption = NAN;
	if( count($rows) > 1){
		$avg_consumption = round($consumption_sum / (count($rows) - 1), 3);
	}
	if( count($rows) > 0){
		$rows[count($rows) - 1]['consumption'] = '-';
	}
	$refuel_at = NAN;
	$refuel_in = NAN;
	if( !is_nan($avg_consumption)){
		$refuel_at = $rows[0]['odometer'] + $capacity / $avg_consumption * 100 - $buffer;
		$refuel_in = $refuel_at - $current;
	}
	
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="container overview">
	<table class="table table-striped"> <!--table-bordered-->
		<tbody>
			<tr>
				<td class="label-col">Aktuell</td>
				<td class="value-col">
					<?php 
						echo '<input type="number" name="current" value="' . $current . '">';
					?>					
				</td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">tanken bei</td>
				<td class="value-col">
				<?php 
					echo number_format($refuel_at, 0, ',', '.');
				?>
				</td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">tanken in</td>
				<td class="value-col">
				<?php 
					echo number_format($refuel_in, 0, ',', '.');
				?>
				</td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">Tankinhalt</td>
				<td class="value-col">
					<?php 
						echo '<input step=".1" name="capacity" type="number" value="' . $capacity . '">';
					?>	
				</td>
				<td class="unti-col">l</td>
			</tr>
			<tr>
				<td class="label-col">Puffer</td>
				<td class="value-col">
					<?php 
						echo '<input type="number" name="buffer" value="' . $buffer . '">';
					?>	
				</td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">Verbrauch</td>
				<td class="value-col">
				<?php
					echo number_format($avg_consumption, 3, ',', '.');;
				?>
				</td>
				<td class="unti-col">l/100km</td>
			</tr>
		</tbody>
	 </table>
	<input id="refresh-button" class="btn btn-primary" type="submit" value="Refresh" />
</div>
</form>

<div class="container history">
	<table class="table table-striped"> <!--table-bordered-->
		<thead>
			<tr>
				<th>Datum</th>
				<th>km-Stand</th>
				<th>getankt</th>
				<th>Verbrauch</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach( $rows as $row ){
				echo "<tr>";
					echo "<td>";
					echo "<a class='edit-button' href='entry_editor.php?id=". $row['id'] ."' title='bearbeiten'><span class='glyphicon glyphicon-edit'></span></a>";
					echo date_format(date_create($row['refueling_date']), "d.m.Y") . "</td>";
					echo "<td>" . number_format($row['odometer'], 1, ',', '.') . "</td>";
					echo "<td>" . number_format($row['refueled'], 1, ',', '.') . "</td>";
					echo "<td>" . $row['consumption'] . "</td>";
				echo "</tr>";
			}
		?>		
		</tbody>
	 </table>
</div>
<div class="entry-button-container">
	<a id="add-button" href="entry_editor.php" class="btn btn-primary">Neuer Eintrag</a>
</div>
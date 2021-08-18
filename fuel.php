<?php
#require_once 'security.php';
?>
<!--<div class="container">
	<div class="row">
		<span class="label-col">Aktuell:</span>
		<span class="value-col">
			<input name="aktuell" id="aktuell">
		</span>
		<span class="unit-col">km</span>
	</div>

	<div class="row">
		<span class="label-col">tanken bei:</span>
		<span class="value-col" style="font-weight: bold">10.568</span>
		<span class="unit-col">km</span>
	</div>
	
	<div class="row">
		<span class="label-col">tanken in:</span>
		<span class="value-col">17</span>
		<span class="unit-col">km</span>
	</div>
	
	<div class="row">
		<span class="label-col">Tankinhalt:</span>
		<span class="value-col"><input name="tank_inhalt" id="tank_inhalt"></span>
		<span class="unit-col">l</span>
	</div>
	
	<div class="row">
		<span class="label-col">Puffer:</span>
		<span class="value-col"><input name="puffer" id="puffer"></span>
		<span class="unit-col">km</span>
	</div>
	
	<div class="row">
		<span class="label-col">Verbrauch</span>
		<span class="value-col">2,587</span>
		<span class="unit-col">l/100km</span>
	</div>
</div>-->

<div class="container overview">
	<table class="table table-striped"> <!--table-bordered-->
		<tbody>
			<tr>
				<td class="label-col">Aktuell</td>
				<td class="value-col"><input type="number"></td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">tanken bei</td>
				<td class="value-col">45668</td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">tanken in</td>
				<td class="value-col">88</td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">Tankinhalt</td>
				<td class="value-col"><input type="number"></td>
				<td class="unti-col">l</td>
			</tr>
			<tr>
				<td class="label-col">Puffer</td>
				<td class="value-col"><input type="number"></td>
				<td class="unti-col">km</td>
			</tr>
			<tr>
				<td class="label-col">Verbrauch</td>
				<td class="value-col">2,458</td>
				<td class="unti-col">l/100km</td>
			</tr>
		</tbody>
	 </table>
</div>


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
			<tr>
				<!--<a href='buchung_delete.php?id=". $row['id'] ."' title='Buchung löschen'><span class='glyphicon glyphicon-trash'></span></a>-->
				<td><span class="glyphicon glyphicon-trash"></span>01.01.2012</td>
				<td>12.585</td>
				<td>4,04</td>
				<td>2,547</td>
			</tr>
			<tr>
				<td><span class="glyphicon glyphicon-trash"></span>01.01.2012</td>
				<td>12.585</td>
				<td>4,04</td>
				<td>2,547</td>
			</tr>
			<tr>
				<td><span class="glyphicon glyphicon-trash"></span>01.01.2012</td>
				<td>12.585</td>
				<td>4,04</td>
				<td>2,547</td>
			</tr>
		</tbody>
	 </table>
	 <div class="entry-button-container">
		<a href="entry_create.php" class="btn btn-primary">Neuer Eintrag</a>
	 </div>
</div>
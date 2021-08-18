<?php
require_once 'security.php';
?>
<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>Buchungen</h2>
				</div>
				<?php
				require_once "db.php";
				
				$sql = "SELECT b.id, qk.name quellkonto, zk.name zielkonto, b.datum, b.betrag, b.beschreibung, b.eingabedatum FROM buchung b LEFT JOIN konto qk ON qk.id = b.quellkonto LEFT JOIN konto zk ON zk.id = b.zielkonto ORDER BY b.eingabedatum DESC";
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						echo "<table class='table table-bordered table-striped'>";
							echo "<thead>";
								echo "<tr>";
									echo "<th>#</th>";
									echo "<th>Quellkonto</th>";
									echo "<th>Zielkonto</th>";
									echo "<th>Datum</th>";
									echo "<th>Betrag</th>";
									echo "<th>Beschreibung</th>";
									echo "<th>Eingabe</th>";
									echo "<th>Action</th>";
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while($row = mysqli_fetch_array($result)){
								echo "<tr>";
									echo "<td>" . $row['id'] . "</td>";
									echo "<td>" . $row['quellkonto'] . "</td>";
									echo "<td>" . $row['zielkonto'] . "</td>";
									echo "<td>" . $row['datum'] . "</td>";
									echo "<td class='text-right'>" . number_format($row['betrag'], 2) . " €</td>";
									echo "<td>" . $row['beschreibung'] . "</td>";
									echo "<td>" . $row['eingabedatum'] . "</td>";
									echo "<td>";
										//echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
										//echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
										echo "<a href='buchung_delete.php?id=". $row['id'] ."' title='Buchung löschen'><span class='glyphicon glyphicon-trash'></span></a>";
									echo "</td>";
								echo "</tr>";
							}
							echo "</tbody>";                            
						echo "</table>";
						mysqli_free_result($result);
					} else{
						echo "<p class='lead'><em>Keine Daten gefunden</em></p>";
					}
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}

				mysqli_close($link);
				?>
				<a href="buchung_create.php" class="btn btn-primary">Neue Buchung</a>
			</div>
		</div>        
	</div>
</div>
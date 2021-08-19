
<?php
/*
CREATE TABLE `fuel`.`refueling` ( `id` INT NOT NULL AUTO_INCREMENT, `refueling_date` DATE NOT NULL , `odometer` FLOAT NOT NULL , `refueled` FLOAT NOT NULL , `deleted` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`));
CREATE TABLE `fuel`.`key_values` ( `k` VARCHAR(255) NOT NULL , `v` VARCHAR(512) NOT NULL , PRIMARY KEY (`k`));
INSERT INTO `key_values`(`k`, `v`) VALUES ('current','0.0');
INSERT INTO `key_values`(`k`, `v`) VALUES ('capacity','6.0');
INSERT INTO `key_values`(`k`, `v`) VALUES ('buffer','50');
*/
	include 'config.php';
	$link = new mysqli($servername, $username, $password, $dbname);
	
	if ($link->connect_error) {
	  die("Connection failed: " . $link->connect_error);
	}
?>
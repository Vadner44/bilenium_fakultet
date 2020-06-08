<?php
session_start();
error_reporting(0);
@ini_set('display_errors', 0);
require 'header.php'; 
require 'config.php'; 
require_once 'user.class.php';

/**
 * Tylko dla zalogowanych użytkowników
 */
if (!user::isLogged()) {
    echo '<p class="error">Przykro nam, ale ta strona jest dostępna tylko dla zalogowanych użytkowników.</p>';
}

else {
	

// Widok dla użytkownika zalogowanego
	$id = $_GET['id'];
	$user = user::getData('', '');
	$profile = user::getDataById ($id);
	
	echo '<br /><a href="ra.php">Powrót</a><br /><br />';	
	echo '<h1>Raport godzin pracy</h1>';
if ($_POST['send'] == 1) {
	$id = $_GET['id'];
	$dzien = $_POST['dzien'];
	$godziny = $_POST['godziny'];
	$id_projektu = $_POST['id_projektu'];
	mysql_query("INSERT INTO raporty (dzien, godziny, id, id_projektu) VALUES ('$dzien','$godziny','$id','$id_projektu');");
	echo '<git>Raport dodano poprawnie</git>';
	}
	
?>

<center>
<form method="post" action="">
<label for="dzien">DATA:</label>
 <input maxlength="10" type="DATE" name="dzien" id="dzien" />

 <label for="godziny">Ilość godzin:</label>
 <input  type="number" step="1"  name="godziny" id="godziny" />
 
 <label for="id_projektu">Projekt:</label>
<select name="id_projektu" id="id_projektu">
  <option value="1">Projekt_A</option>
  <option value="2">Projekt_B</option>
  <option value="3">Projekt_C</option>

</select>
 
<br>
 <input type="hidden" name="send" value="1" />
 <br><input type="submit" value="ZATWIERDŹ" />
</form>
</center>

<?php
}
require 'footer.php'; 
?>
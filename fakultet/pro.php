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
	
 echo '<br/><a href="rapy.php?id='.$user['id'].'">Powrót</a> <br /><br />';
		echo '<h1>Ilość godzin w danym projekcie</h1>';
	echo '<h2>Tylko zaakceptowane raporty</h2>';



	$projekt = mysql_query("SELECT SUM(godziny) AS godzinki, projekty.nazwa FROM raporty INNER JOIN projekty on raporty.id_projektu=projekty.id_projektu WHERE id = '$id' AND status='ZAAKCEPTOWANY' GROUP BY projekty.id_projektu");
	echo '<table><tr><th>Projekt</th><th>Ilość godzin</th></tr>';
	while($row = mysql_fetch_array($projekt)) 
	{
	echo "<tr><td>{$row['nazwa']}</td><td>{$row['godzinki']}</td></tr>";
	}
	echo '</table>';
	}	
	

	
?>

<?php
require 'footer.php'; 
?>






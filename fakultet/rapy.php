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
	echo '<br /><a href="ra.php">Powrót</a> <h2><a href="pro.php?id='.$user['id'].'">Podział na projekty</a></h2>';	
	echo '<h1>Lista raportów</h1>';
	
	
	$raport = mysql_query("SELECT * FROM raporty INNER JOIN projekty on raporty.id_projektu=projekty.id_projektu WHERE id = '$id' ");


	echo '<table><tr><th>Data</th><th>Ilość godzin</th><th>Projekt</th><th>STATUS</th></tr>';
	while($row = mysql_fetch_array($raport)) 
	{
	echo "<tr><td>{$row['dzien']}</td><td>{$row['godziny']}</td><td>{$row['nazwa']}</td><td>{$row['status']}</td></tr>";
	}
	echo '</table>';
	}

	
?>

<?php
require 'footer.php'; 
?>






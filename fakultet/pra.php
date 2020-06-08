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
	
    echo '<br /><a href =profile.php?id=2>Powrót</a> <br /><br />';
	echo '<h1>Ilość godzin poszczególnych pracowników</h1>';
	echo '<h2>Tylko zaakceptowane raporty</h2>';



	$projekt = mysql_query("SELECT SUM(godziny) AS godzinki, users.imie, users.nazwisko, users.id FROM raporty INNER JOIN users on raporty.id=users.id WHERE status='ZAAKCEPTOWANY' GROUP BY raporty.id");
	echo '<table><tr><th>Imie</th><th>Nazwisko</th><th>Ilość godzin</th><th>Szczegóły</th></tr>';
	while($row = mysql_fetch_array($projekt)) 
	{

	echo '<tr><td>'.$row['imie'].'</td><td>'.$row['nazwisko'].'</td><td>'.$row['godzinki'].'</td><td><a href="pros.php?id=' .$row['id'].'"> Profil</a></td></tr>';
	}
	echo '</table>';
	}	
	

	
?>

<?php
require 'footer.php'; 
?>






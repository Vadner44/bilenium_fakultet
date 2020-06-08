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
    $id = $_GET['id'];

	$profile = user::getDataById ($id);
	

	echo '<br /><a href =profile.php?id=2>Powrót</a><br /><br />';
	echo '<h1>Panel Przełożonego</h1>';
	$raporty = mysql_query("SELECT * FROM raporty INNER JOIN projekty on raporty.id_projektu=projekty.id_projektu INNER JOIN users on raporty.id=users.id WHERE status='-' ORDER BY id_raportu");


	echo '<b>Raporty do akceptacji:<br /><br />';
	echo '<table><tr><th>ID raportu</th><th>Osoba</th><th>Data</th><th>Ilość godzin</th><th>Projekt</th><th>STATUS</th></tr>';
	while($row = mysql_fetch_array($raporty)) 
	{
    echo "<tr><td>{$row['id_raportu']}</td><td>{$row['login']}</td><td>{$row['dzien']}</td><td>{$row['godziny']}</td><td>{$row['nazwa']}</td><td>{$row['status']}</td></tr>";

	}
	echo '</table>';

	if ($_POST['send'] == 'ZAAKCEPTUJ') {
	$id_raportu = $_POST['id_raportu'];
	$status = $_POST['status'];
	mysql_query("UPDATE raporty SET status='ZAAKCEPTOWANY' WHERE id_raportu = '$id_raportu';");
	echo "<meta http-equiv='refresh' content='0'>";
	}
	else if ($_POST['send'] == 'ODRZUĆ') {
	$id_raportu = $_POST['id_raportu'];
	$status = $_POST['status'];
	mysql_query("UPDATE raporty SET status='ODRZUCONY' WHERE id_raportu = '$id_raportu';");
	echo "<meta http-equiv='refresh' content='0'>";
	}

?>
<center>
<BR>
<form method="post" action="">
 <label for="id_raportu">ID raportu:</label>
 <input maxlength="20" type="text" name="id_raportu" id="id_raportu" />
<br><br>
<input type="submit" name="send" value="ZAAKCEPTUJ" />
<input type="submit" name="send" value="ODRZUĆ" />
</form>
</center>
<?php
}
require 'footer.php'; 
?>

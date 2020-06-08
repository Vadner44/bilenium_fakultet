<?php
session_start();
error_reporting(0);
@ini_set('display_errors', 0);
require 'header.php'; 
require 'config.php'; 
require_once 'user.class.php';

	
    $id = $_GET['id'];

	$profile = user::getDataById ($id);
	

	echo '<br /><a href =profile.php?id=1>Powrót</a><br /><br />';
	echo '<h1>Panel Admina</h1>';
	$users = mysql_query("SELECT * FROM users ORDER BY id");


	echo '<b>Użytkownicy:<br />';
	echo '<table><tr><th>ID</th><th>LOGIN</th><th>IMIE</th><th>NAZWISKO</th><th>EMAIL</th></tr>';
	while($row = mysql_fetch_array($users)) 
	{
    echo "<tr><td>{$row['id']}</td><td>{$row['login']}</td><td>{$row['imie']}</td><td>{$row['nazwisko']}</td><td>{$row['email']}</td></tr>";

	}
	echo '</table>';

	if ($_POST['send'] == 1) {
	$id = $_POST['id'];
	mysql_query("DELETE FROM users WHERE id = '$id';");

	}

?>
<center>
<BR>
Usuń użytkownika
<form method="post" action="">
 <label for="id">ID:</label>
 <input maxlength="20" type="text" name="id" id="id" />
 
<br>
 <input type="hidden" name="send" value="1" />
 <br><input type="submit" value="USUŃ" />
</form>
</center>
<?php
require 'footer.php'; 
?>

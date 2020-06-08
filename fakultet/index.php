<?php
session_start();
require 'header.php';
require 'config.php';
require_once 'user.class.php';
?>


<?php
error_reporting(0);
@ini_set('display_errors', 0);
if (user::isLogged()) {
    // Widok dla użytkownika zalogowanego
    
    // Pobierz dane o użytkowniku i zapisz je do zmiennej $user
    $user = user::getData('', '');
    
    echo '<br><center>Jesteś zalogowany, witaj <b>'.$user['login'].'</b>!</center>';
    echo '<center>Możesz zobaczyć swój <a href="profile.php?id='.$user['id'].'">profil</a> albo się <a href="logout.php">wylogować</a>.</center>';

}

else {
    // Widok dla użytkownika niezalogowanego
    echo '<br><center>Nie jesteś zalogowany.<br /><a href="login.php">Zaloguj się</a></center>';
}



?>
<?php
require 'footer.php'; 
?>
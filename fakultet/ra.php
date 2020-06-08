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
 echo '<br /><a href="profile.php?id='.$user['id'].'">Powrót</a><br /><br />';	
 echo '<center><br/><a href="rap.php?id='.$user['id'].'">Dodaj raport</a></center>';
 echo '<center><br/><a href="rapy.php?id='.$user['id'].'">Lista raportów</a></center>';
}
	
?>

<?php

require 'footer.php'; 
?>
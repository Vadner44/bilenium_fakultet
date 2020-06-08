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
	
	if ($id == 1)
	{
	$profile = user::getDataById ($id);
	echo '<h1>Panel Admina</h1>';

    echo '<b>Nick:</b> '.$profile['login'].'<br />';
    echo '<b>E-mail:</b> '.$profile['email'].'<br /><br /><br />';

	
	echo '<a href = register.php>Dodaj użytkownika</a><br /><br />';
    echo '<a href = users.php>Lista użytkowników</a><br /><br />';

	
	}
	
		if ($id == 2)
	{
	$profile = user::getDataById ($id);
	echo '<h1>Panel Przełożonego</h1>';

    echo '<b>Nick:</b> '.$profile['login'].'<br />';
    echo '<b>E-mail:</b> '.$profile['email'].'<br /><br />';


    echo '<a href = rapsy.php>Lista raportów</a><br /><br />';
	echo '<a href = pra.php>Lista z godzinami pracowników</a><br />';
	}

	
	

    /**
     * Sprawdź czy użytkownik o podanym ID istnieje
     */
    $userExist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE id = '$id'"));

    // Użytkownik nie istnieje
    if ($userExist[0] == 0){
        die ('<p>Przykro nam, ale użytkownik o podanym identyfikatorze nie istnieje.</p>');
    }

    /**
     * Użytkownik istnieje, tak więc pokaż jego profil
     */
    
    // Zapisz dane użytkownika o podanym ID, do zmiennej $profile
	if  ($id != 1 & $id != 2){
    $profile = user::getDataById ($id);
    
    echo '<h1>Profil użytkownika '.$profile['login'].'</h1>';

    echo '<b>Nick:</b> '.$profile['login'].'<br />';
	echo '<b>Imie:</b> '.$profile['imie'].'<br />';
	echo '<b>Nazwisko:</b> '.$profile['nazwisko'].'<br />';
    echo '<b>E-mail:</b> '.$profile['email'].'<br /><br />';
	
    echo '<a href = ra.php>Zarządzanie raportami</a><br /><br />';

}

}

?>
<?php
require 'footer.php'; 
?>

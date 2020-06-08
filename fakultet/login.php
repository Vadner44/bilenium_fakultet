<?php
session_start();
error_reporting(0);
@ini_set('display_errors', 0);
require 'header.php'; 
require 'config.php';

/**
 * SKRYPT LOGOWANIA
 */
require_once 'user.class.php'; // Dołączamy rdzeń systemu użytkowników

// Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection
$login = htmlspecialchars(mysql_real_escape_string($_POST['login']));
$pass = mysql_real_escape_string($_POST['pass']);

if ($_POST['send'] == 1) {
    // Sprawdź, czy wszystkie pola zostały uzupełnione
    if (!$login or empty($login)) {
		
        echo ('<br><p class="error">Wypełnij pole z loginem!</p>');
		
    }

    if (!$pass or empty($pass)) {
		 
        echo ('<br><p class="error">Wypełnij pole z hasłem!</p>');
		
		
    }

    $pass = user::passSalter($pass); // Posól i zahashuj hasło
    
    // Sprawdź, czy użytkownik o podanym loginie i haśle isnieje w bazie danych
    $userExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login = '$login' AND pass = '$pass'"));

    if (!empty($login) and !empty($pass) and $userExists[0] == 0) {
        // Użytkownik nie istnieje w bazie
        echo '<br><p class="error">Użytkownik o podanym loginie i haśle nie istnieje.</p>';
    }

      if (!$userExists[0] == 0){
        // Użytkownik istnieje
        $user = user::getData($login, $pass); // Pobierz dane użytknika do tablicy i zapisz ją do zmiennej $user

        // Przypisz pobrane dane do sesji
        $_SESSION['login'] = $login;
        $_SESSION['pass'] = $pass;

        echo '<br><p class="success">Zostałeś zalogowany. Możesz przejść do zakładki <a href="profile.php?id='.$user['id'].'">panel</a>.</p>';
    }
}

else {
    /**
     * FORMULARZ LOGOWANIA
     */
?>
<center>
 <form method="post" action="">
  <label for="login">Login:</label>
  <input type="text" name="login" maxlength="32" id="login" />

  <label for="pass">Hasło:</label>
  <input type="password" name="pass" maxlength="32" id="pass" /><br />

  <input type="hidden" name="send" value="1" />
  <br><input type="submit" value="Zaloguj" />
 </form>
</center>
<?php
}

require 'footer.php'; 
?>

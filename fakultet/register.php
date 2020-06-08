<?php
require 'header.php';
require 'config.php';
require_once 'user.class.php';
error_reporting(0);
@ini_set('display_errors', 0);
echo '<br /><a href =profile.php?id=1>Powrót</a><br /><br />';
echo '<h1>Dodaj użytkownika</h1>';


if ($_POST['send'] == 1) {
    // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
    $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    $pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
    $pass_v = mysql_real_escape_string(htmlspecialchars($_POST['pass_v']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	$imie = mysql_real_escape_string(htmlspecialchars($_POST['imie']));
    $nazwisko = mysql_real_escape_string(htmlspecialchars($_POST['nazwisko']));


    /**
     * Sprawdź czy podany przez użytkownika email lub login już istnieje
     */
    $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login='$login' LIMIT 1"));
    $existsEmail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='$email' LIMIT 1"));

    $errors = ''; // Zmienna przechowująca listę błędów które wystąpiły


    // Sprawdź, czy nie wystąpiły błędy
    if (!$login || !$email || !$pass || !$pass_v) $errors .= '- Musisz wypełnić wszystkie pola<br />';
    if ($existsLogin[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
    if ($existsEmail[0] >= 1) $errors .= '- Ten e-mail jest już używany<br />';
    if ($pass != $pass_v)  $errors .= '- Hasła się nie zgadzają<br />';

    /**
     * Jeśli wystąpiły jakieś błędy, to je pokaż
     */
    if ($errors != '') {
        echo '<p class="error">Popraw następujące błędy:<br />'.$errors.'</p>';
    }

    /**
     * Jeśli nie ma żadnych błędów - kontynuuj rejestrację
     */
    else {

        // Posól i zasahuj hasło
        $pass = user::passSalter($pass);

        // Zapisz dane do bazy
        mysql_query("INSERT INTO users (login, email, pass, imie, nazwisko) VALUES('$login','$email','$pass', '$imie', '$nazwisko');") or die ('<p class="error">Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.</p>');

        echo '<p class="success">Konto '.$login.' dodane.</p>';
    }
}
?>
<center>
<form method="post" action="">
 <label for="login">Login:</label>
 <input maxlength="32" type="text" name="login" id="login" />

 <label for="pass">Hasło:</label>
 <input maxlength="32" type="password" name="pass" id="pass" />

 <label for="pass_again">Hasło (ponownie):</label>
 <input maxlength="32" type="password" name="pass_v" id="pass_again" />

 <label for="imie">Imie:</label>
 <input maxlength="32" type="text" name="imie" id="imie" />
 
 <label for="nazwisko">Nazwisko:</label>
 <input maxlength="32" type="text" name="nazwisko" id="nazwisko" /> 
 
 <label for="email">Email:</label>
 <input type="text" name="email" maxlength="50" id="email" />


 <input type="hidden" name="send" value="1" />
 <br><br><input type="submit" value="Dodaj" />
</form>
</center>
<?php
require 'footer.php'; 
?>


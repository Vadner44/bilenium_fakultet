<?php
require 'header.php';
require 'config.php';
require_once 'user.class.php';
error_reporting(0);
@ini_set('display_errors', 0);





if ($_POST['send'] == 1) {
	

	
	$imie = mysql_real_escape_string(htmlspecialchars($_POST['imie']));
    $naz = mysql_real_escape_string(htmlspecialchars($_POST['naz']));
    $pesel = mysql_real_escape_string(htmlspecialchars($_POST['pesel']));
    $email2 = mysql_real_escape_string(htmlspecialchars($_POST['email2']));
    $adres = mysql_real_escape_string(htmlspecialchars($_POST['adres']));
	
    $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE pesel='$pesel' LIMIT 1"));
    $existsEmail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email2='$email2' LIMIT 1"));

    $errors = ''; 
	

    if (!$imie || !$email2 || !$naz || !$pesel || !$adres ) $errors .= '- Musisz wypełnić wszystkie pola<br />';
	if (strlen($pesel) != 11) $errors .= '- Błedna dlugość peselu.<br />';
    if ($existsPesel[0] >= 1) $errors .= '- Istnieje karta o poadanym peselu<br />';
    if ($existsEmail2[0] >= 1) $errors .= '- Ten e-mail jest już używany<br />';


    
   if ($errors != '') {
        echo '<p class="error">Założenie karty nie powiodło się, popraw następujące błędy:<br />'.$errors.'</p>';
    }

    else {

        
        echo '<p class="success">'.$imie.', złożyłeś wniosek o kartę.';
    }
}

?>

 <br><br><center><form method="post" action="">
  <label for="imie">Imię:</label>
  <input type="text" name="imie" maxlength="32" id="imie" />

  <label for="naz">Nazwisko:</label>
  <input type="text" name="naz" maxlength="32" id="naz" /><br />
  
  <label for="pesel">Pesel:</label>
  <input type="text" name="pesel" maxlength="11" id="pesel" />
   
  <label for="email2">E-mail:</label>
  <input type="text" name="email2" maxlength="32" id="email2" />
  
  <label for="adres">Adres:</label>
  <input type="text" name="adres" maxlength="64" id="adres" />

  <input type="hidden" name="send" value="1" />
  <br><input type="submit" value="Złóż wniosek" />
 </form></center>

<?php
require 'footer.php'; 
?>

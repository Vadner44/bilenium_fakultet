<?php
error_reporting(0);
@ini_set('display_errors', 0);

class user {

    public static $user = array();
    
    /**
     * Zwraca tablicę ze wszystkimi danymi o użytkowniku.
     * Indeksy tablicy odpowiadają nazwom pól w bazie danych (login, pass etc...)
     * @param string $login
     * @param string $pass
     * @return array
     */
    public function getData ($login, $pass) {
        if ($login == '') $login = $_SESSION['login'];
        if ($pass == '') $pass = $_SESSION['pass'];

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE login='$login' AND pass='$pass' LIMIT 1;"));
        return self::$user;
    }

    public function getDataById ($id) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1;"));
        return $user;
    }

    /**
     * Jeśli użytkownik jest zalogowany - zwraca true, w przeciwnym wypadku - false
     */
    public function isLogged () {
     if (empty($_SESSION['login']) || empty($_SESSION['pass'])) {
      return false;
     }

     else {
      return true;
     }
    }

    /**
     * "Soli" hasło przed jego zahashowaniem funkcją md5()
     */
    public function passSalter ($pass) {
        $pass = '$@@#$#@$'.$pass.'q2#$3$%##@';
        return md5($pass);
    }

}

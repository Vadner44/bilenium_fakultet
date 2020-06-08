<?php
session_start();
error_reporting(0);
@ini_set('display_errors', 0);
require 'header.php';

session_destroy();
$_SESSION = array ();
echo '<br><p class="success">Zostałeś wylogowany!</p>';


?>
<?php
require 'footer.php'; 
?>
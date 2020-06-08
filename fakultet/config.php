<?php

$cfg['db_server'] = 'sql111.byethost.com'; 
$cfg['db_user'] = 'b7_25804685'; 
$cfg['db_pass'] = 'dege44'; 
$cfg['db_name'] = 'b7_25804685_dg';


$conn = @mysql_connect ($cfg['db_server'], $cfg['db_user'], $cfg['db_pass']);
$select = @mysql_select_db ($cfg['db_name'], $conn);

if (!$conn) {
    die ('<p class="error">Nie udało się połączyć z bazą danych.</p>');
}

if (!$select) {
    die ('<p class="error">Nie udało się wybrać bazy danych.</p>');
}
       
?>

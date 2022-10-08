<?php
define('DSN', 'mysql:host=localhost;dbname=ngoding_cuy');
define('DBUSER', 'root');
define('DBPASS', '');

$db = new PDO(DSN, DBUSER, DBPASS);
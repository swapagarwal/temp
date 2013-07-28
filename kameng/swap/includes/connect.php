<?php

require_once("constants.php");

mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("db_connect failed! <br />" . mysql_error());
mysql_select_db(DB_NAME) or die("db_select failed! <br />" . mysql_error());

?>

<?php

require_once( "./lib/robokassa.php" );


$robokassa = new Robokassa("login", "password");
$form = $robokassa->getForm(100, 1, "test");

header("Location: {$form}");

?>
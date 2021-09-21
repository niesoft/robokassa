<?php

require_once( dirname(__DIR__) . "/lib/robokassa.php" );

$robokassa = new Robokassa("login", "password");
$form = $robokassa->getForm(100, 1, "test");

header("Location: {$form}");

?>
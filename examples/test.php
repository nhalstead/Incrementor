<?php

require_once ("vendor/autoload.php");

use nhalstead\Incrementor\Incrementor;

// Using the Get Method you can get a collection of the output.
$generated = Incrementor::get('TEST_{0000^}', 10);

var_dump($generated);

?>
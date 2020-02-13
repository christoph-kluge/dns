<?php

use Sikei\Dns\Lookup;

require_once 'vendor/autoload.php';

echo (string)(new Lookup())->txt('example.org');

//example.org.    4502    IN      TXT     "v=spf1 -all"
//example.org.    4502    IN      TXT     "2b3dee88837848bbae05e3532f427b10"

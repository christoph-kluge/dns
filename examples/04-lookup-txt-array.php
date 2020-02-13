<?php

use Sikei\Dns\Lookup;

require_once 'vendor/autoload.php';

print_r((new Lookup())->txt('example.org')->toArray());

//Array
//(
//    [0] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => TXT
//            [txt] => v=spf1 -all
//        )
//
//    [1] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => TXT
//            [txt] => 2b3dee88837848bbae05e3532f427b10
//        )
//
//)

<?php

use Sikei\Dns\Lookup;

require_once 'vendor/autoload.php';

print_r((new Lookup())->all('example.org')->toArray());

//Array
//(
//    [0] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => A
//            [ip] => 93.184.216.34
//        )
//
//    [1] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => NS
//            [target] => b.iana-servers.net
//        )
//
//    [2] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => NS
//            [target] => a.iana-servers.net
//        )
//
//    [3] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => SOA
//            [mname] => ns.icann.org
//            [rname] => noc.dns.icann.org
//            [serial] => 2019121336
//            [refresh] => 7200
//            [retry] => 3600
//            [expire] => 1209600
//            [min-ttl] => 3600
//        )
//
//    [4] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => MX
//            [pri] => 0
//            [target] =>
//        )
//
//    [5] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => TXT
//            [txt] => v=spf1 -all
//        )
//
//    [6] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => TXT
//            [txt] => 2b3dee88837848bbae05e3532f427b10
//        )
//
//    [7] => Array
//        (
//            [host] => example.org
//            [ttl] => 4502
//            [class] => IN
//            [type] => AAAA
//            [ipv6] => 2606:2800:220:1:248:1893:25c8:1946
//        )
//
//)

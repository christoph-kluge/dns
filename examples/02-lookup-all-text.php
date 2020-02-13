<?php

use Sikei\Dns\Lookup;

require_once 'vendor/autoload.php';

echo (string)(new Lookup())->all('example.org');

//example.org.    4502    IN      A       93.184.216.34
//example.org.    4502    IN      NS      b.iana-servers.net.
//example.org.    4502    IN      NS      a.iana-servers.net.
//example.org.    4502    IN      SOA     ns.icann.org.   noc.dns.icann.org.      2019121336      7200    3600    1209600 3600
//example.org.    4502    IN      MX      0       .
//example.org.    4502    IN      TXT     "v=spf1 -all"
//example.org.    4502    IN      TXT     "2b3dee88837848bbae05e3532f427b10"
//example.org.    4502    IN      AAAA    2606:2800:220:1:248:1893:25c8:1946

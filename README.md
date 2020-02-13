# Object Oriented DNS Wrapper

This library aims to give you an object oriented wrapper around the php's dns network tools.

As of now this library gives you an abstraction of:

* `dns_get_record()` is used to lookup all records or by a specific type
* `gethostbyaddr()` is used to perform a PTR lookup for a specific name

## Install

To install via Composer, use the command below. It will automatically detect the latest version and bind it with ^.

```
composer require christoph-kluge/dns
```

## Lookup(-Service)

The lookup service will always return a Collection except for PTR lookups. The collection implements a `__toString()`
magic inter function in order to cast the collection to a string. Additionally you can also use the `toArray()` member
function which will give you the plain array representation as if you had used `dns_get_record()`.

As of now the API consists of the following member functions:

* `(new Lookup)->a('example.org')`
* `(new Lookup)->aaaa('example.org')`
* `(new Lookup)->cname('www,example.org')`
* `(new Lookup)->mx('example.org')`
* `(new Lookup)->txt('example.org')`
* `(new Lookup)->soa('example.org')`
* `(new Lookup)->srv('example.org')`
* `(new Lookup)->all('example.org')`
* `(new Lookup)->any('example.org')`

Here is an example if you display all records as text.

```php
echo (string) (new Lookup())->all('example.org');
```

```
example.org.    4502    IN      A       93.184.216.34
example.org.    4502    IN      NS      b.iana-servers.net.
example.org.    4502    IN      NS      a.iana-servers.net.
example.org.    4502    IN      SOA     ns.icann.org.   noc.dns.icann.org.      2019121336      7200    3600    1209600 3600
example.org.    4502    IN      MX      0       .
example.org.    4502    IN      TXT     "v=spf1 -all"
example.org.    4502    IN      TXT     "2b3dee88837848bbae05e3532f427b10"
example.org.    4502    IN      AAAA    2606:2800:220:1:248:1893:25c8:1946
```

Here is an shorter example if you only need the `TXT` records. 

```php
echo (string) (new Lookup())->txt('example.org');
```

```
example.org.    4502    IN      TXT     "v=spf1 -all"
example.org.    4502    IN      TXT     "2b3dee88837848bbae05e3532f427b10"
```

And here is an example if you want to display all records as array.

```php
print_r( (new Lookup())->all('example.org')->toArray() );
```

```
Array
(
    [0] => Array
        (
            [host] => example.org
            [ttl] => 4502
            [class] => IN
            [type] => A
            [ip] => 93.184.216.34
        )

    ....

``` 

## Other open source libraries worth to look at around DNS and networking

* https://github.com/DaveRandom/LibDNS
* https://github.com/Badcow/DNS/tree/master/lib/Rdata
* https://github.com/remotelyliving/php-dns/tree/master/src/Entities

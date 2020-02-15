<?php namespace Sikei\Dns;

use Sikei\Dns\Records\A;
use Sikei\Dns\Records\AAAA;
use Sikei\Dns\Records\CNAME;
use Sikei\Dns\Records\MX;
use Sikei\Dns\Records\NS;
use Sikei\Dns\Records\TXT;

class Factory
{
    public function a(string $name, string $ipv4, array $options = []): A
    {
        return new A($name, $ipv4, $options);
    }

    public function aaaa(string $name, string $ipv6, array $options = []): AAAA
    {
        return new AAAA($name, $ipv6, $options);
    }

    public function cname(string $name, string $target, array $options = []): CNAME
    {
        return new CNAME($name, $target, $options);
    }

    public function mx(string $name, string $server, int $priority = 0, array $options = []): MX
    {
        return new MX($name, $server, $priority, $options);
    }

    public function ns(string $name, string $server, array $options = []): NS
    {
        return new NS($name, $server, $options);
    }

    public function txt(string $name, string $content, array $options = []): TXT
    {
        return new TXT($name, $content, $options);
    }

    public function soa(string $name, string $mname, string $rname, string $serial = "1", int $refresh = 7200, int $retry = 3600, int $expire = 1209600, int $minTtl = 3600, array $options = []): Record
    {
        return new Record(RecordType::SOA, $name, "", array_merge($options, [
            'mname' => $mname,
            'rname' => $rname,
            'serial' => $serial,
            'refresh' => $refresh,
            'retry' => $retry,
            'expire' => $expire,
            'min-ttl' => $minTtl,
        ]));
    }

    public function srv(string $service, string $proto, string $name, string $target, int $port, int $priority = 10, $weight = 100, array $options = []): Record
    {
        return new Record(RecordType::SRV, $name, $target, array_merge($options, [
            'serivce' => $service,
            'protocol' => $proto,
            'port' => $port,
            'pri' => $priority,
            'weight' => $weight,
        ]));
    }

}

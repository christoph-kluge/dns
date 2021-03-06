<?php namespace Sikei\Dns;

use Sikei\Dns\Records\A;
use Sikei\Dns\Records\AAAA;
use Sikei\Dns\Records\CNAME;
use Sikei\Dns\Records\MX;
use Sikei\Dns\Records\NS;
use Sikei\Dns\Records\TXT;

class Lookup
{

    public function a(string $host): Collection
    {
        return $this->parse($host, DNS_A);
    }

    public function aaaa(string $host): Collection
    {
        return $this->parse($host, DNS_AAAA);
    }

    public function cname(string $host): Collection
    {
        return $this->parse($host, DNS_CNAME);
    }

    public function mx(string $host): Collection
    {
        return $this->parse($host, DNS_MX);
    }

    public function ns(string $host): Collection
    {
        return $this->parse($host, DNS_NS);
    }

    public function soa(string $host): Collection
    {
        return $this->parse($host, DNS_SOA);
    }

    public function srv(string $host): Collection
    {
        return $this->parse($host, DNS_SRV);
    }

    public function txt(string $host): Collection
    {
        return $this->parse($host, DNS_TXT);
    }

    public function ptr(string $ip): string
    {
        return gethostbyaddr($ip);
    }

    /**
     * This "might" not return all entries.
     *
     * https://www.php.net/manual/en/function.dns-get-record.php
     * Quote: Because of eccentricities in the performance of libresolv between platforms, DNS_ANY will not always
     * return every record, the slower DNS_ALL will collect all records more reliably.
     *
     * @param string $host
     * @return Collection
     */
    public function any(string $host): Collection
    {
        // this is a quick operation but might not get all records
        return $this->parse($host, DNS_ANY);
    }

    /**
     * This will perform a slow dns lookup compared to any().
     *
     * https://www.php.net/manual/en/function.dns-get-record.php
     * Quote: Because of eccentricities in the performance of libresolv between platforms, DNS_ANY will not always
     * return every record, the slower DNS_ALL will collect all records more reliably.
     *
     * @param string $host
     * @return Collection
     */
    public function all(string $host): Collection
    {
        // this is a slow operation but gets all records
        return $this->parse($host, DNS_ALL);
    }

    private function parse(string $host, int $type = DNS_ANY): Collection
    {
        $collection = new Collection();
        foreach (dns_get_record($host, $type, $authns, $addtl) as $item) {
            switch ($item['type']) {
                case RecordType::A:
                    $collection->add(new A($item['host'], $item['ip'], $item));
                    continue 2;
                case RecordType::AAAA:
                    $collection->add(new AAAA($item['host'], $item['ipv6'], $item));
                    continue 2;
                case RecordType::TXT:
                    $collection->add(new TXT($item['host'], $item['txt'], $item));
                    continue 2;
                case RecordType::CNAME:
                    $collection->add(new CNAME($item['host'], $item['target'], $item));
                    continue 2;
                case RecordType::NS:
                    $collection->add(new NS($item['host'], $item['target'], $item));
                    continue 2;
                case RecordType::MX:
                    $collection->add(new MX($item['host'], $item['target'], $item['pri'], $item));
                    continue 2;
            }

            $collection->add(
                new Record($item['type'], $item['host'], '', $item, $authns, $addtl)
            );
        }

        return $collection;
    }

}

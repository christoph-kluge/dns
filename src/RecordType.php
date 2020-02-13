<?php namespace Sikei\Dns;

use Exception;

class RecordType
{
    const A = 'A';
    const AAAA = 'AAAA';
    const CNAME = 'CNAME';
    const CAA = 'CAA';
    const MX = 'MX';
    const NS = 'NS';
    const SRV = 'SRV';
    const SOA = 'SOA';
    const TXT = 'TXT';

    private $map = [
        DNS_A => self::A,
        DNS_CNAME => self::CNAME,
        DNS_CAA => self::CAA,
        DNS_MX => self::MX,
        DNS_NS => self::NS,
        DNS_SOA => self::SOA,
        DNS_TXT => self::TXT,
        DNS_AAAA => self::AAAA,
        DNS_SRV => self::SRV,

        DNS_PTR => '',
        DNS_HINFO => '',
        DNS_NAPTR => 'NAPTR',
        DNS_A6 => '',
    ];

    public function string(int $php): string
    {
        if (array_key_exists($php, $this->map)) {
            return $this->map[$php];
        }

        throw new Exception("Cannot find mapping for $php");
    }

    public function php(string $string): int
    {
        if (in_array($string, $this->map)) {
            return array_search($string, $this->map);
        }

        throw new Exception("Cannot find mapping for $string");
    }

}

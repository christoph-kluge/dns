<?php namespace Sikei\Dns;

class Record
{
    private $type;
    private $host;
    private $content;
    private $authns;
    private $addtl;
    private $options;

    public function __construct(string $type, string $name, string $content = "", array $options = [], ?array $authns = [], ?array $addtl = [])
    {
        $this->type = $type;
        $this->host = $name;
        $this->content = $content;

        $this->authns = $authns;
        $this->addtl = $addtl;

        $this->options = new RecordOptions($options);
    }

    public function options(): RecordOptions
    {
        return $this->options;
    }

    public function toArray(): array
    {
        $array = [
            'host' => $this->host,
            'ttl' => $this->options->getTtl(),
            'class' => $this->options->getClass(),
            'type' => $this->type,
        ];

        switch ($this->type) {
            case RecordType::A:
                return array_merge($array, [
                    'ip' => $this->content,
                ]);
            case RecordType::AAAA:
                return array_merge($array, [
                    'ipv6' => $this->content,
                ]);
            case RecordType::CNAME:
            case RecordType::NS:
                return array_merge($array, [
                    'target' => $this->content,
                ]);
            case RecordType::MX:
                return array_merge($array, [
                    'pri' => $this->options->getPriority(),
                    'target' => $this->content,
                ]);
            case RecordType::TXT:
                return array_merge($array, [
                    'txt' => $this->content,
                ]);
            case RecordType::SRV:
                return array_merge($array, [
                    'serivce' => $this->options->getService(),
                    'protocol' => $this->options->getProtocol(),
                    'port' => $this->options->getPort(),
                    'pri' => $this->options->getPriority(),
                    'weight' => $this->options->getWeight(),
                ]);
            case RecordType::SOA:
                return array_merge($array, [
                    'mname' => $this->options->getMname(),
                    'rname' => $this->options->getRname(),
                    'serial' => $this->options->getSerial(),
                    'refresh' => $this->options->getRefresh(),
                    'retry' => $this->options->getRetry(),
                    'expire' => $this->options->getExpire(),
                    'min-ttl' => $this->options->getMinTtl(),
                ]);
        }

        return [
            'host' => $this->host,
            'ttl' => $this->options->getTtl(),
            'class' => $this->options->getClass(),
            'type' => $this->type,
            'content' => $this->content,
        ];
    }

    public function __toString(): string
    {
        // SRV
        // # _service._proto.name.  TTL   class SRV priority weight port target.
        // _sip._tcp.example.com.   86400 IN    SRV 10       60     5060 bigbox.example.com.
        // _sip._tcp.example.com.   86400 IN    SRV 10       20     5060 smallbox1.example.com.
        // _sip._tcp.example.com.   86400 IN    SRV 10       20     5060 smallbox2.example.com.
        // _sip._tcp.example.com.   86400 IN    SRV 20       0      5060 backupbox.example.com.

        switch ($this->type) {
            case RecordType::MX:
                return $this->spaceToTab(sprintf('%s. %s %s %s %s %s.',
                    $this->host, $this->options->getTtl(),
                    $this->options->getClass(),
                    $this->type, $this->options->getPriority(), $this->content
                ));
            case RecordType::TXT:
                return $this->spaceToTab(sprintf('%s. %s %s %s "%s"',
                    $this->host, $this->options->getTtl(),
                    $this->options()->getClass(),
                    $this->type, $this->content
                ));
            case RecordType::SRV:
                return $this->spaceToTab(sprintf('%s.%s.%s. %s %s %s %s %s %s %s',
                    $this->options()->getService(), $this->options->getProtocol(), $this->host, $this->options->getTtl(),
                    $this->options()->getClass(),
                    $this->type, $this->options->getPriority(), $this->options->getWeight(),
                    $this->options->getPort(), $this->content
                ));
            case RecordType::SOA:
                return $this->spaceToTab(sprintf('%s. %s %s %s %s. %s. %s %s %s %s %s',
                    $this->host, $this->options->getTtl(),
                    $this->options()->getClass(),
                    $this->type, $this->options->getMname(), $this->options->getRname(), $this->options->getSerial(),
                    $this->options->getRefresh(), $this->options->getRetry(), $this->options->getExpire(), $this->options->getMinTtl()
                ));

            case RecordType::CNAME:
            case RecordType::NS:
                return $this->spaceToTab(sprintf('%s. %s %s %s %s.',
                    $this->host, $this->options->getTtl(),
                    $this->options()->getClass(),
                    $this->type, $this->content
                ));

            default:
            case RecordType::A:
            case RecordType::AAAA:
                return $this->spaceToTab(sprintf('%s. %s %s %s %s',
                    $this->host, $this->options->getTtl(),
                    $this->options()->getClass(),
                    $this->type, $this->content
                ));
        }
    }

    private function spaceToTab(string $string): string
    {
        return str_replace(' ', "\t", $string);
    }

}

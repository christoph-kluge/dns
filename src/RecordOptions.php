<?php namespace Sikei\Dns;

class RecordOptions
{
    private $class = 'IN';
    private $ttl = 3600;

    private $service = '_service';
    private $protocol = '_tcp';
    private $priority = 10;
    private $weight = 1;
    private $port = 65535;

    private $mname = "";
    private $rname = "";
    private $serial = "1";
    private $refresh = 7200;
    private $retry = 3600;
    private $expire = 1209600;
    private $minTtl = 3600;

    public function __construct(array $options = [])
    {
        $this->options($options);
    }

    public function options(array $options = []): RecordOptions
    {
        // Generic options
        if (array_key_exists('class', $options)) {
            $this->setClass($options['class']);
        }
        if (array_key_exists('ttl', $options)) {
            $this->setTTL(intval($options['ttl']));
        }

        if (array_key_exists('pri', $options)) {
            $this->setPriority($options['pri']);
        }

        // SRV relevant options
        if (array_key_exists('weight', $options)) {
            $this->setWeight($options['weight']);
        }
        if (array_key_exists('port', $options)) {
            $this->setPort($options['port']);
        }

        // SOA relevant options
        if (array_key_exists('mname', $options)) {
            $this->setMname($options['mname']);
        }
        if (array_key_exists('rname', $options)) {
            $this->setRname($options['rname']);
        }
        if (array_key_exists('serial', $options)) {
            $this->setSerial(strval($options['serial']));
        }
        if (array_key_exists('refresh', $options)) {
            $this->setRefresh(intval($options['refresh']));
        }
        if (array_key_exists('retry', $options)) {
            $this->setRetry(intval($options['retry']));
        }
        if (array_key_exists('expire', $options)) {
            $this->setExpire(intval($options['expire']));
        }
        if (array_key_exists('minimum-ttl', $options)) {
            $this->setMinTtl(intval($options['minimum-ttl']));
        }

        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): RecordOptions
    {
        $this->class = $class;
        return $this;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function setTtl(int $ttl): RecordOptions
    {
        $this->ttl = $ttl;
        return $this;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function setService(string $service): RecordOptions
    {
        $this->service = $service;
        return $this;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function setProtocol(string $protocol): RecordOptions
    {
        $this->protocol = $protocol;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): RecordOptions
    {
        $this->priority = $priority;
        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): RecordOptions
    {
        $this->weight = $weight;
        return $this;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): RecordOptions
    {
        $this->port = $port;
        return $this;
    }

    public function getMname(): string
    {
        return $this->mname;
    }

    public function setMname(string $mname): RecordOptions
    {
        $this->mname = $mname;
        return $this;
    }

    public function getRname(): string
    {
        return $this->rname;
    }

    public function setRname(string $rname)
    {
        $this->rname = $rname;
        return $this;
    }

    public function getSerial(): string
    {
        return $this->serial;
    }

    public function setSerial(string $serial)
    {
        $this->serial = $serial;
        return $this;
    }

    public function getRefresh(): int
    {
        return $this->refresh;
    }

    public function setRefresh(int $refresh)
    {
        $this->refresh = $refresh;
        return $this;
    }

    public function getRetry(): int
    {
        return $this->retry;
    }

    public function setRetry(int $retry)
    {
        $this->retry = $retry;
        return $this;
    }

    public function getExpire(): int
    {
        return $this->expire;
    }

    public function setExpire(int $expire)
    {
        $this->expire = $expire;
        return $this;
    }

    public function getMinTtl(): int
    {
        return $this->minTtl;
    }

    public function setMinTtl(int $minTtl)
    {
        $this->minTtl = $minTtl;
        return $this;
    }

}

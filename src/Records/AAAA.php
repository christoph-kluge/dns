<?php namespace Sikei\Dns\Records;

use Sikei\Dns\Formatter;
use Sikei\Dns\RecordInterface;
use Sikei\Dns\RecordOptions;
use Sikei\Dns\RecordType;

class AAAA implements RecordInterface
{
    private $host;
    private $address;
    private $options;

    public function __construct(string $host, string $address, array $options = [])
    {
        $this->host = $host;
        $this->address = $address;
        $this->options = new RecordOptions($options);
    }

    public function host(): string
    {
        return $this->host;
    }

    public function type(): string
    {
        return RecordType::AAAA;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function class(): string
    {
        return $this->options->getClass();
    }

    public function ttl(): int
    {
        return $this->options->getTtl();
    }

    public function options(): RecordOptions
    {
        return $this->options;
    }

    public function toArray(): array
    {
        return [
            'host' => $this->host(),
            'ttl' => $this->ttl(),
            'class' => $this->class(),
            'type' => $this->type(),
            'ipv6' => $this->address(),
        ];
    }

    public function __toString(): string
    {
        return Formatter::format(sprintf('%s. %s %s %s %s',
            $this->host(), $this->ttl(), $this->class(), $this->type(),
            $this->address()
        ));
    }

}

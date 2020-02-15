<?php namespace Sikei\Dns\Records;

use Sikei\Dns\Formatter;
use Sikei\Dns\RecordInterface;
use Sikei\Dns\RecordOptions;
use Sikei\Dns\RecordType;

class NS implements RecordInterface
{
    private $host;
    private $nameserver;
    private $options;

    public function __construct(string $host, string $nameserver, array $options = [])
    {
        $this->host = $host;
        $this->nameserver = $nameserver;
        $this->options = new RecordOptions($options);
    }

    public function host(): string
    {
        return $this->host;
    }

    public function type(): string
    {
        return RecordType::NS;
    }

    public function server(): string
    {
        return $this->nameserver;
    }

    public function class(): string
    {
        return 'IN';
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
            'target' => $this->server(),
        ];
    }

    public function __toString(): string
    {
        return Formatter::format(sprintf('%s. %s %s %s %s.',
            $this->host(), $this->ttl(), $this->class(), $this->type(),
            $this->server()
        ));
    }

}

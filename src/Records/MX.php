<?php namespace Sikei\Dns\Records;

use Sikei\Dns\Formatter;
use Sikei\Dns\RecordInterface;
use Sikei\Dns\RecordOptions;
use Sikei\Dns\RecordType;

class MX implements RecordInterface
{
    private $host;
    private $server;
    private $options;

    public function __construct(string $host, string $server, int $priority = 10, array $options = [])
    {
        $this->host = $host;
        $this->server = $server;
        $this->options = new RecordOptions(array_merge($options, ['pri' => $priority]));
    }

    public function host(): string
    {
        return $this->host;
    }

    public function type(): string
    {
        return RecordType::MX;
    }

    public function priority(): int
    {
        return $this->options->getPriority();
    }

    public function server(): string
    {
        return $this->server;
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
            'pri' => $this->priority(),
            'target' => $this->server(),
        ];
    }

    public function __toString(): string
    {
        return Formatter::format(sprintf('%s. %s %s %s %s %s.',
            $this->host(), $this->ttl(), $this->class(), $this->type(),
            $this->priority(), $this->server()
        ));
    }

}

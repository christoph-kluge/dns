<?php namespace Sikei\Dns\Records;

use Sikei\Dns\Formatter;
use Sikei\Dns\RecordInterface;
use Sikei\Dns\RecordOptions;
use Sikei\Dns\RecordType;

class CNAME implements RecordInterface
{
    private $host;
    private $canonicalName;
    private $options;

    public function __construct(string $host, string $canonicalName, array $options = [])
    {
        $this->host = $host;
        $this->canonicalName = $canonicalName;
        $this->options = new RecordOptions($options);
    }

    public function host(): string
    {
        return $this->host;
    }

    public function type(): string
    {
        return RecordType::CNAME;
    }

    /**
     * Alias for canonicalName()
     *
     * @return string
     */
    public function target(): string
    {
        return $this->canonicalName();
    }

    public function canonicalName(): string
    {
        return $this->canonicalName;
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
            'target' => $this->canonicalName(),
        ];
    }

    public function __toString(): string
    {
        return Formatter::format(sprintf('%s. %s %s %s %s.',
            $this->host(), $this->ttl(), $this->class(), $this->type(),
            $this->canonicalName()
        ));
    }

}

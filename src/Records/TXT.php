<?php namespace Sikei\Dns\Records;

use Sikei\Dns\Formatter;
use Sikei\Dns\RecordInterface;
use Sikei\Dns\RecordOptions;
use Sikei\Dns\RecordType;

class TXT implements RecordInterface
{
    private $host;
    private $txt;
    private $options;

    public function __construct(string $host, string $value, array $options = [])
    {
        $this->host = $host;
        $this->txt = $value;
        $this->options = new RecordOptions($options);
    }

    public function host(): string
    {
        return $this->host;
    }

    public function type(): string
    {
        return RecordType::TXT;
    }

    /**
     * Alias for txt()
     *
     * @return string
     */
    public function content(): string
    {
        return $this->txt();
    }

    /**
     * Alias for txt()
     *
     * @return string
     */
    public function value(): string
    {
        return $this->txt();
    }

    public function txt(): string
    {
        return $this->txt;
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
            'txt' => $this->txt(),
        ];
    }

    public function __toString(): string
    {
        return Formatter::format(sprintf('%s. %s %s %s "%s"',
            $this->host(), $this->ttl(), $this->class(), $this->type(),
            $this->txt()
        ));
    }

}

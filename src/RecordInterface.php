<?php namespace Sikei\Dns;

interface RecordInterface
{

    /**
     * @return string
     */
    public function host(): string;

    /**
     * Should be the ResourceRecord Type
     * Example: A, AAAA, CNAME, ...
     *
     * @return string
     */
    public function type(): string;

    /**
     * Internet class (this is always IN)
     *
     * @return string
     */
    public function class(): string;

    /**
     * TimeToLive
     *
     * @return int
     */
    public function ttl(): int;

    /**
     * Gives you additional options to this record.
     * This contain different values depending on the type.
     *
     * @return RecordOptions
     */
    public function options(): RecordOptions;

    /**
     * Gives the array representation for this entry
     * This should be compatible with the values from dns_get_records()
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * This should return the ZoneFile representation of this record
     *
     * @return string
     */
    public function __toString(): string;

}

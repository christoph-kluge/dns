<?php namespace Sikei\Dns;

class Collection
{
    /**
     * @var Record[]
     */
    private $items = [];

    public function add(Record $record): Collection
    {
        $this->items[] = $record;

        return $this;
    }

    /**
     * @return Record[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return array_map(function (Record $record) {
            return $record->toArray();
        }, $this->items);
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, array_map(function (Record $record) {
                return $record->__toString();
            }, $this->items)) . PHP_EOL;
    }

}

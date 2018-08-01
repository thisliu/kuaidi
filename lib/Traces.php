<?php

namespace Kuaidi;

class Traces implements \JsonSerializable, \IteratorAggregate, \Countable, \ArrayAccess
{
    const DATETIME = 'datetime';
    const DESCRIPTION = 'desc';
    const MEMO = 'memo';

    protected $data = [];

    public static function parse($traces, $dateTime, $description, $memo)
    {
        $instance = new static();
        foreach ($traces as $trace) {
            $instance->data[] = [
                static::DATETIME => $trace->$dateTime,
                static::DESCRIPTION => $trace->$description,
                static::MEMO => $trace->$memo
            ];
        }
        return $instance;
    }

    public function sort()
    {
        usort($this->data, function ($left, $right) {
            if ($left[static::DATETIME] == $right[static::DATETIME]) {
                return 0;
            }
            return $left[static::DATETIME] < $right[static::DATETIME] ? 1 : -1; // 倒序
        });
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function count()
    {
        return count($this->data);
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $item)
    {
        $this->data[$offset] = $item;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}

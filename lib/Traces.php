<?php

namespace Kuaidi;

class Traces implements \JsonSerializable, \IteratorAggregate, \Countable, \ArrayAccess
{
    const DATETIME = 'datetime';
    const DESCRIPTION = 'desc';
    const MEMO = 'memo';

    protected $data = [];

    /**
     * 解析路径
     *
     * @param mixed $traces
     * @param string $dateTime
     * @param string $description
     * @param string $memo
     * @return static
     */
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

    /**
     * 对数据以时间顺序进行排序
     *
     * @param bool $desc 是否倒序
     * @return static
     */
    public function sort($desc = true)
    {
        usort($this->data, function ($left, $right) use ($desc) {
            if ($left[static::DATETIME] == $right[static::DATETIME]) {
                return 0;
            }
            $oper = $desc ? 1 : -1;
            return $left[static::DATETIME] < $right[static::DATETIME] ? $oper : -$oper;
        });
        return $this;
    }

    public function jsonSerialize()
    {
        return $this->data;
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

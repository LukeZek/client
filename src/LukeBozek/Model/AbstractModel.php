<?php

namespace LukeBozek\ApiClient\Model;

abstract class AbstractModel
{
    protected $id;

    public static function make(array $fields)
    {
        $model = new static();

        foreach ($fields as $name => $value) {
            if (property_exists(static::class, $name)) {
                $model->{$name} = $value;
            }
        }

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}

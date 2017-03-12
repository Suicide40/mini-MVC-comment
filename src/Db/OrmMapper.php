<?php

namespace TestProject\Db;


class OrmMapper implements IOrmMapper
{
    /**
     * @inheritDoc
     */
    public function convertToObject($data)
    {
        $object = new \stdClass();
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    /**
     * @inheritDoc
     */
    public function convertToArray($object)
    {
        $array = json_decode(json_encode($object), true);

        return $array;
    }

}
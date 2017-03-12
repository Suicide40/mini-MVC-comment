<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 11.03.17
 * Time: 18:00
 */

namespace TestProject\Db;


interface IOrmMapper
{
    /**
     * Convert array to object
     *
     * @param array $data
     * @return mixed
     */
    public function convertToObject($data);

    /**
     * Convert Object to Array
     *
     * @param $object
     * @return array
     */
    public function convertToArray($object);
}
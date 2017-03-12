<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 11.03.17
 * Time: 18:04
 */

namespace TestProject\Db;


interface IOrmManager
{
    /**
     * Execute sql without parsing result
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function execute($sql, $params = []);

    /**
     * Execute sql and get single result
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetch($sql, $params = []);

    /**
     * Execute sql anf get all result
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetchAll($sql, $params = []);

    /**
     * Get last insert id
     *
     * @return mixed
     */
    public function getLastInsertId();
}
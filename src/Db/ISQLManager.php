<?php

namespace TestProject\Db;


interface ISQLManager
{
    /**
     * Run sql ang fetch all result
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchAll($sql, $params = []);

    /**
     * Run sql ang fetch single result
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetch($sql, $params = []);

    /**
     * Run sql
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function execute($sql, $params = []);

    /**
     * Get last insert id
     *
     * @return mixed
     */
    public function getLastInsertId();
}
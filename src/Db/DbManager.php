<?php

namespace TestProject\Db;


class DbManager implements ISQLManager
{
    /**
     * @var \PDO
     */
    private $connection = null;

    function __construct($dsn, $username, $password)
    {
        $this->connection = new \PDO($dsn, $username, $password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * @inheritDoc
     */
    public function execute($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute($params);

        if ($result === false) {
            $errors = print_r($this->connection->errorInfo(), true);
            throw new \Exception($errors);
        }

        return $result;
    }

    public function fetch($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            $errors = print_r($this->connection->errorInfo(), true);
            throw new \Exception($errors);
        }

        return $result;
    }

    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if ($result === false) {
            $errors = print_r($this->connection->errorInfo(), true);
            throw new \Exception($errors);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getLastInsertId()
    {
        return $this->connection->lastInsertId();
    }


}
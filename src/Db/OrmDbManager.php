<?php

namespace TestProject\Db;


class OrmDbManager implements IOrmManager
{
    /**
     * Sql manager
     *
     * @var ISQLManager
     */
    private $sqlManager = null;

    /**
     * ORM mapper
     *
     * @var IOrmMapper
     */
    private $ormMapper = null;

    public function __construct(ISQLManager $sqlManager, IOrmMapper $ormMapper)
    {
        $this->sqlManager = $sqlManager;
        $this->ormMapper = $ormMapper;
    }

    /**
     * @inheritDoc
     */
    public function execute($sql, $params = [])
    {
        return $this->sqlManager->execute($sql, $params);
    }

    /**
     * @inheritDoc
     */
    public function fetch($sql, $params = [])
    {
        $result = $this->sqlManager->fetch($sql, $params);
        $object = $this->ormMapper->convertToObject($result);
        return $object;
    }

    /**
     * @inheritDoc
     */
    public function fetchAll($sql, $params = [])
    {
        $result = $this->sqlManager->fetchAll($sql, $params);

        $objects = [];
        foreach ($result as $item) {
            $objects[] = $this->ormMapper->convertToObject($item);
        }
        return $objects;
    }

    /**
     * @inheritDoc
     */
    public function getLastInsertId()
    {
        return $this->sqlManager->getLastInsertId();
    }


}
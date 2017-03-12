<?php

namespace TestProject\Models;

use TestProject\Db\IOrmManager;

abstract class BaseModel
{
    /**
     * Orm manager
     *
     * @var IOrmManager
     */
    private $ormManager = null;

    /**
     * BaseModel constructor.
     * @param IOrmManager $ormManager
     */
    public function __construct(IOrmManager $ormManager)
    {
        $this->ormManager = $ormManager;
    }

    /**
     * Getter for ormManager
     *
     * @return IOrmManager
     */
    protected function getOrmManager()
    {
        return $this->ormManager;
    }
}
<?php

namespace Terrificminds\CareerPageBuilder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Application extends AbstractDb
{
    /**
     * table name
     */
    protected const MAIN_TABLE = 'application_form';
    /**
     * primary id
     */
    protected const ID_FIELD_NAME = 'application_id';

    /**
     * Construct function
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
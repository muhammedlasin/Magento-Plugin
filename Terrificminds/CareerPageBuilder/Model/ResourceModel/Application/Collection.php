<?php

namespace Terrificminds\CareerPageBuilder\Model\ResourceModel\Application;

use Terrificminds\CareerPageBuilder\Model\Application;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Application as ApplicationResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Construct function
     */
    protected function _construct()
    {
        $this->_init(
            Application::class,
            ApplicationResourceModel::class
        );
    }
}

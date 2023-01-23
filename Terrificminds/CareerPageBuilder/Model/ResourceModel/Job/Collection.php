<?php

namespace Terrificminds\CareerPageBuilder\Model\ResourceModel\Job;

use Terrificminds\CareerPageBuilder\Model\Job;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job as JobResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Construct function
     */
    protected function _construct()
    {
        $this->_init(
            Job::class,
            JobResourceModel::class
        );
    }
}

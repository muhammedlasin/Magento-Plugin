<?php

namespace Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory;

use Terrificminds\CareerPageBuilder\Model\JobCategory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory as JobCategoryResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Construct function
     */
    protected function _construct()
    {
        $this->_init(
            JobCategory::class,
            JobCategoryResourceModel::class
        );
    }
}
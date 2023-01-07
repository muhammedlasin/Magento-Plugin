<?php

namespace Terrificminds\CareerPageBuilder\Ui\DataProvider\CategoryForm;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection to collect data
 */
class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('category_id', 'job_category.category_id');
        parent::_initSelect();
    }
}

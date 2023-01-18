<?php

namespace Terrificminds\CareerPageBuilder\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory as JobCategoryCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;

class Career extends Template implements BlockInterface
{
    protected $_template = "widget/career.phtml";
    protected $jobCategoryCollectionFactory;
    protected $jobCollectionFactory;
 
    public function __construct(
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCollectionFactory $jobCollectionFactory,
        Template\Context $context, array $data = []
    ) {
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getCategoryCollection()
    {
        $collection = $this->jobCategoryCollectionFactory->create();
        $collection->setOrder('sort_order','ASC');
        $collection->addFieldToFilter('is_active', 1)->getData();
        return $collection;
    }

    public function getJobCollection($categoryId)
    {
        $collection = $this->jobCollectionFactory->create()->addFieldToFilter('category_id', $categoryId);
        $collection->setOrder('sort_order','ASC');
        $collection->addFieldToFilter('is_active', 1)->getData();
        return $collection;
    }
}
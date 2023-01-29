<?php

namespace Terrificminds\CareerPageBuilder\Ui\DataProvider\JobCategory;

use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;

class JobCategoryDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collection;

     /**
      * Constructor function
      *
      * @param CollectionFactory $collectionFactory
      * @param string $name
      * @param string $primaryFieldName
      * @param string $requestFieldName
      * @param array $meta
      * @param array $data
      */
    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collectionFactory->create()->addFieldToFilter('category_id', ['neq' => 1]);
    }
}

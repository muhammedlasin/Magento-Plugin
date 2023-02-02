<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model\JobCategory;

use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * To connect to db
     * @var array
     */
     
    protected $jobCategoryCollectionFactory;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor function
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $jobCategoryCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $jobCategoryCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $jobCategoryCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Getdata function
     *
     * @return array
     */
    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $category) {
                $this->loadedData[$category->getId()] = $category->getData();
        }
        return $this->loadedData;
    }
}

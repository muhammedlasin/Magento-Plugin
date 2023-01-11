<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model\Job;

use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory;

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
     * Undocumented function
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $jobCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $jobCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $jobCollectionFactory->create();
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

        foreach ($items as $job) {
            $this->loadedData[$job->getId()] = $job->getData();
        }
        return $this->loadedData;
    }
}
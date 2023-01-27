<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model\Application;

use Terrificminds\CareerPageBuilder\Model\ResourceModel\Application\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * To connect to db
     * @var array
     */
   
    protected $applicationCollectionFactory;

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
     * @param CollectionFactory $applicationCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $applicationCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $applicationCollectionFactory->create();
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

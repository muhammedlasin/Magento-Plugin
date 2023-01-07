<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model;

use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * To connect to db
     * @var array
     */
     
    protected $popupCollectionFactory;

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
     * @param CollectionFactory $popupCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $popupCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $popupCollectionFactory->create();
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

        foreach ($items as $popup) {
            $this->loadedData[$popup->getId()] = $popup->getData();
        }
        return $this->loadedData;
    }
}
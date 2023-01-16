<?php

namespace Terrificminds\CareerPageBuilder\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;
class DisplayCategory extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

      /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

 
        
        $collection = $this->collectionFactory->create();
        if(isset($dataSource['data']['items'])) {
            foreach($dataSource['data']['items'] as & $item) {
                if($item) {
                    $s = $collection->addFieldToFilter('category_id', $item['category_id'])->getData();

                    $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
                    $logger = new \Zend_Log();
                    $logger->addWriter($writer);
                    $logger->info("/////////////////-----logger initiated-----//////////////////////");
                    $logger->info("testing   " . print_r($s, true));
                    // $logger->info("20   " . print_r($s, true));
                    
                    // $item['category_id'] = $item['category_name'];
                       
                }
            }
        }

        return $dataSource;
    }
}
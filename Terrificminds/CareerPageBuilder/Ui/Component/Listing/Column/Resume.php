<?php

namespace Terrificminds\CareerPageBuilder\Ui\Component\Listing\Column;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Resume extends Column
{
  /**
   *
   * @var StoreManagerInterface
   */
    protected $storeManagerInterface;

    /**
     * Constructor function
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManagerInterface
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManagerInterface,
        array $components = [],
        array $data = []
    ) {
        $this->storeManagerInterface = $storeManagerInterface;
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
        $url = $this->storeManagerInterface->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');

            foreach ($dataSource["data"]["items"] as & $item) {
                if (!empty($item[$fieldName])) {
                    $modifiedName = str_replace(' ', '_', $item[$fieldName]);
                    $completeUrl = $url . 'uploads/' . $modifiedName;
                    $item[$fieldName] = "<a href='$completeUrl'>$item[$fieldName]</a>";
                }
            }
        }
        return $dataSource;
    }
}

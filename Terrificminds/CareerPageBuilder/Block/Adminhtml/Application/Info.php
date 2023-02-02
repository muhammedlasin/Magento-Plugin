<?php

namespace Terrificminds\CareerPageBuilder\Block\Adminhtml\Application;

use Magento\Backend\Block\Template;
use Magento\Customer\Model\Session;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Response\RedirectInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Application\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

/**
 * Application form block.
 */
class Info extends Template
{
      /**
       * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\Application\CollectionFactory
       */
    protected $CollectionFactory;
       /**
        * @var \Magento\Framework\App\RequestInterface
        */
    protected $request;

        /**
         * @var \Magento\Store\Model\StoreManagerInterface
         */
    protected $storeManagerInterface;
    
     /**
      * Construct
      *
      * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\Application $CollectionFactory
      * @param \Magento\Framework\App\RequestInterface $request
      * @param StoreManagerInterface $storeManagerInterface
      * @param \Magento\Backend\Block\Template\Context $context
      * @param array $data
      */
    public function __construct(
        CollectionFactory $CollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        StoreManagerInterface $storeManagerInterface,
        Context $context,
        array $data = [],
    ) {
        $this->CollectionFactory = $CollectionFactory;
        $this->request = $request;
        $this->storeManagerInterface = $storeManagerInterface;
        parent::__construct($context, $data);
    }
   
      /**
       * Get job application
       *
       * @return array
       */
    public function getJobApplication()
    {
        $applicationId = $this->request->getParam('id');
        $collection = $this->CollectionFactory->create();
        $applicationCollection = $collection->addFieldToFilter('application_id', $applicationId)->getData();
        return $applicationCollection;
    }

      /**
       * Get resume link
       *
       * @return string
       */
    public function getResume()
    {
        $applicationId = $this->request->getParam('id');
        $collection = $this->CollectionFactory->create();
        $applications = $collection->addFieldToFilter('application_id', $applicationId)->getData();
        $modifiedName = str_replace(' ', '_', $applications[0]['resume']);
        $url = $this->storeManagerInterface->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        $completeUrl = $url . 'uploads/' . $modifiedName;
        $fileName = $applications[0]['resume'];
        $resume = "<a href='$completeUrl'>$fileName</a>";
        return $resume;
    }
}

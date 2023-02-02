<?php

namespace Terrificminds\CareerPageBuilder\Block\Adminhtml\Application;

use Magento\Backend\Block\Template;
use Magento\Customer\Model\Session;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
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
     * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory
     */
    protected $jobCategoryCollectionFactory;
      /**
       * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory
       */
    protected $CollectionFactory;
       /**
        * @var \Magento\Framework\App\RequestInterface
        */
    protected $request;

      /**
       * @var \Magento\Customer\Model\Session
       */
    protected $session;

      /**
       * @var \Magento\Customer\Api\CustomerRepositoryInterface
       */
    protected $_customerRepositoryInterface;

    protected $storeManagerInterface;
    
     /**
      * Construct
      *
      * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory $jobCategoryCollectionFactory
      * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job $jobCollectionFactory
      * @param \Magento\Framework\App\RequestInterface $request
      * @param \Magento\Framework\View\Element\Context $context
      * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
      * @param Session $session
      * @param array $data
      */
    public function __construct(
        CollectionFactory $CollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        StoreManagerInterface $storeManagerInterface,
        Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        Session $session,
        array $data = [],
    ) {
        $this->CollectionFactory = $CollectionFactory;
        $this->request = $request;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->session = $session;
        $this->storeManagerInterface = $storeManagerInterface;
        parent::__construct($context, $data);
    }
   
      /**
       * Get job designation
       *
       * @return string
       */
    public function getJobApplication()
    {
        $applicationId = $this->request->getParam('id');
        $collection = $this->CollectionFactory->create();
        $applicationCollection = $collection->addFieldToFilter('application_id', $applicationId)->getData();
        return $applicationCollection;
    }

    public function getResume(){
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

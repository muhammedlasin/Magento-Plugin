<?php

namespace Terrificminds\CareerPageBuilder\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Response\RedirectInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory as JobCategoryCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;

/**
 * Application form block.
 */
class Form extends Template
{
    /**
     * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory
     */
    protected $jobCategoryCollectionFactory;
      /**
       * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory
       */
    protected $jobCollectionFactory;
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
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCollectionFactory $jobCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        Template\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        Session $session,
        array $data = []
    ) {
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->request = $request;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->session = $session;
        parent::__construct($context, $data);
    }
   
      /**
       * Get job designation
       *
       * @return string
       */
    public function getJobName()
    {

        $jobId = $this->request->getParam('jobId');
        $collection = $this->jobCollectionFactory->create();
        $jobCollection = $collection->addFieldToFilter('job_id', $jobId)->getData();
        return $jobCollection[0]['job_designation'];
    }

     /**
      * Get submit url
      *
      * @return string
      */
    public function getSubmitUrl()
    {
        $jobId = $this->request->getParam('jobId');
        $page = $this->request->getParam('page');
        $url = 'save?jobId=' . $jobId . '&page=' . $page;
        return $url;
    }

     /**
      * Get user status
      *
      * @return bool
      */
    public function getuserStatus()
    {
        return $this->session->isLoggedIn() ? true : false;
    }

     /**
      * Get customer data
      *
      * @return \Magento\Customer\Api\Data\CustomerInterface
      */

    public function getCustomerData()
    {
        $customerId = $this->session->getId();
        $customer = $this->_customerRepositoryInterface->getById($customerId);
        return $customer;
    }
}

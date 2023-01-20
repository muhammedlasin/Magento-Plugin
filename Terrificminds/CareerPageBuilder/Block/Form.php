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

class Form extends Template
{
    protected $jobCategoryCollectionFactory;
    protected $jobCollectionFactory;
    protected $request;
    protected $customer;
    protected $customerRepositoryInterface;
    protected $session;
    public function __construct(
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCollectionFactory $jobCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        Customer $customer,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        Session $session,
        Template\Context $context, array $data = []
    ) {
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->request = $request;
        $this->customer = $customer;
        $this->session = $session;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        parent::__construct($context, $data);
    }
   
    public function getJobName(){

        $jobId = $this->request->getParam('jobId');
        $collection = $this->jobCollectionFactory->create();
        $jobCollection = $collection->addFieldToFilter('job_id', $jobId)->getData();
        return $jobCollection[0]['job_designation'];
    
    }

    public function getCurrentUser()
    {
        
        $currentSession = $this->session;
        
        $currentCustomer = $this->customerRepositoryInterface->getById($currentSession->getId());
        
        $customerName = $currentSession->getName();
        
        return $customerName;
    }
 
 
}
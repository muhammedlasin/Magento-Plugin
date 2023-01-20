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


 
    public function __construct(
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCollectionFactory $jobCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        Template\Context $context, array $data = []
    ) {
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->request = $request;
        parent::__construct($context, $data);
    }
   
    public function getJobName(){

        $jobId = $this->request->getParam('jobId');
        $collection = $this->jobCollectionFactory->create();
        $jobCollection = $collection->addFieldToFilter('job_id', $jobId)->getData();
        return $jobCollection[0]['job_designation'];
    
    }
}
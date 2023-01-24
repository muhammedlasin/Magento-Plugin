<?php

namespace Terrificminds\CareerPageBuilder\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Backend\Block\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory as JobCategoryCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;

/**
 * Job Details page block.
 */
class JobDetails extends Template
{
    protected $jobCategoryCollectionFactory;
    protected $jobCollectionFactory;
    protected $request;
    protected $contentProcessor;

    public function __construct(
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCollectionFactory $jobCollectionFactory,
        \Magento\Cms\Model\Template\FilterProvider $contentProcessor,
        \Magento\Framework\App\RequestInterface $request,
        Context $context,
        array $data = []
    ) {
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->contentProcessor = $contentProcessor;
        $this->request = $request;
        parent::__construct($context, $data);
    }
 
    public function getJobCollection()
    {
        $collection = $this->jobCollectionFactory->create();
        $jobId = $this->request->getParam('jobId');
        $jobCollection = $collection->addFieldToFilter('job_id', $jobId)->getData();
        return $jobCollection;
    }

    public function getButtonUrl()
    {
        
        $jobCollection = $this->getJobCollection();
        $jobId = $this->request->getParam('jobId');
        $buttonAction = $jobCollection[0]['button_action'];
        $domain = $jobCollection[0]['button_url'];
        $url = $buttonAction ? "form?jobId=$jobId" : "https://$domain";
        return $url;
    }

    public function processContent($content)
    {
                return $this->contentProcessor->getPageFilter()->filter($content);
    }
}

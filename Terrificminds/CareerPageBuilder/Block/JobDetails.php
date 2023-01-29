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
      * @var  \Magento\Cms\Model\Template\FilterProvider
      */
    protected $contentProcessor;

    /**
     * Construct
     *
     * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory $jobCategoryCollectionFactory
     * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job $jobCollectionFactory
     * @param \Magento\Cms\Model\Template\FilterProvider $contentProcessor
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\View\Element\Context $context
     * @param array $data
     */
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
 
      /**
       * Get filtered job collection
       *
       * @return array
       */
    public function getJobCollection()
    {
        $collection = $this->jobCollectionFactory->create();
        $jobId = $this->request->getParam('jobId');
        $jobCollection = $collection->addFieldToFilter('job_id', $jobId)->getData();
        return $jobCollection;
    }

     /**
      * Get button url
      *
      * @return string
      */
    public function getButtonUrl()
    {
        
        $jobCollection = $this->getJobCollection();
        $jobId = $this->request->getParam('jobId');
        $page = $this->request->getParam('page');
        $buttonAction = $jobCollection[0]['button_action'];
        $domain = $jobCollection[0]['button_url'];
        $url = $buttonAction ? "form?jobId=$jobId&page=$page" : "https://$domain";
        return $url;
    }

 /**
  * Get button url
  *
  * @param string $content
  * @return string
  */
    public function processContent($content)
    {
                return $this->contentProcessor->getPageFilter()->filter($content);
    }
}

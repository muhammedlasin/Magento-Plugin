<?php

namespace Terrificminds\CareerPageBuilder\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory as JobCategoryCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\Config;

/**
 * Career Page Builder widget.
 */

class Career extends Template implements BlockInterface
{
     /**
      * @var string
      */
    protected $_template = "widget/career.phtml";

    /**
     * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\Collection
     */
    protected $jobCategoryCollectionFactory;

      /**
       * @var \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\Collection
       */
    protected $jobCollectionFactory;

      /**
       * @var \Magento\Framework\UrlInterface
       */
    protected $urlInterface;
       /**
        * @var Config
        */
    protected $config;

    /**
     * Construct
     *
     * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory $jobCategoryCollectionFactory
     * @param \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job $jobCollectionFactory
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param Config $config
     * @param array $data
     */
 
    public function __construct(
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCollectionFactory $jobCollectionFactory,
        Template\Context $context,
        \Magento\Framework\UrlInterface $urlInterface,
        Config $config,
        array $data = [],
    ) {
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->urlInterface = $urlInterface;
        $this->config = $config;
        parent::__construct($context, $data);
    }

      /**
       * Get filtered category collection
       *
       * @return \Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\Collection
       */
    public function getCategoryCollection()
    {
        $collection = $this->jobCategoryCollectionFactory->create();
        $collection->setOrder('sort_order', 'ASC');
        $collection->addFieldToFilter('is_active', 1)->getData();
        return $collection;
    }

       /**
        * Get filtered job collection
        *
        * @param int $categoryId
        * @return \Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\Collection
        */
    public function getJobCollection($categoryId)
    {
        $collection = $this->jobCollectionFactory->create()->addFieldToFilter('category_id', $categoryId);
        $collection->setOrder('sort_order', 'ASC');
        $collection->addFieldToFilter('is_active', 1)->getData();
        return $collection;
    }

      /**
       * Get url
       *
       * @param int $jobId
       * @return string
       */
    public function buildUrl($jobId)
    {

        $currentUrl = $this->urlInterface->getCurrentUrl();
        $baseUrl = $this->urlInterface->getBaseUrl();
        $url = str_replace($baseUrl, "", $currentUrl);
        $completeUrl = $baseUrl . 'maincareerspage/index/index?jobId=' . $jobId . '&page=' . $url;
        return $completeUrl;
    }

     /**
      * Get Configuration
      *
      * @return string
      */
    public function config()
    {
        return $this->config->getConfigValue('enable') ? "block" : "none";
    }


     /**
      * Check Title
      *
      * @return string
      */
      public function checkTitle()
      {
          return $this->getData('title') ? "block" : "none";
      }
}

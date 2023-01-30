<?php

namespace Terrificminds\CareerPageBuilder\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\ForwardFactory;
use Terrificminds\CareerPageBuilder\Model\Config;

/**
 * Index class to create a page,get config value
 */
class Form implements HttpGetActionInterface
{
      /**
       * @var ForwardFactory
       */
    protected $forwardFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
  /**
   * @var \Magento\Framework\UrlInterface
   */
    protected $urlInterface;

     /**
      * @var  \Magento\Framework\App\RequestInterface
      */
    protected $request;
    
      /**
       * @var Config
       */
    protected $config;

    /**
     * Construct
     *
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $forwardFactory
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param \Magento\Framework\App\RequestInterface $request
     * @param Config $config
     */
    public function __construct(
        PageFactory $resultPageFactory,
        ForwardFactory $forwardFactory,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\App\RequestInterface $request,
        Config $config
    ) {
        $this->forwardFactory = $forwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->urlInterface = $urlInterface;
        $this->request = $request;
        $this->config = $config;
    }

    /**
     * Load the page defined in view/frontend/layout/careersmainpage_index_form.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if ($this->config->getConfigValue('enable')) {
            $resultPageFactory = $this->resultPageFactory->create();
            $baseUrl = $this->urlInterface->getBaseUrl();
            $jobId = $this->request->getParam('jobId');
            $page = $this->request->getParam('page');
            $jobDescriptionUrl = $baseUrl . '/maincareerspage/index/index?jobId=' . $jobId . '&page=' . $page;
            $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
            $breadcrumbs->addCrumb('career', [
                'label' => __('Careers'),
                'title' => __('Careers'),
                'link' => $baseUrl . $page
            ]);
            $breadcrumbs->addCrumb('descripton', [
                'label' => __('Job Description'),
                'title' => __('Job Description'),
                'link' => $jobDescriptionUrl
            ]);
            $breadcrumbs->addCrumb('form', [
                'label' => __('Form'),
                'title' => __('Form')
            ]);
            return $resultPageFactory;
        } else {
            $forward = $this->forwardFactory->create();
            return $forward->forward('defaultNoRoute');
        }
    }
}

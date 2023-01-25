<?php

namespace Terrificminds\CareerPageBuilder\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\ForwardFactory;

/**
 * Index class to create a page,get config value
 */
class Index implements HttpGetActionInterface
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
         * @var \Magento\Framework\App\RequestInterface $request
         */
    protected $request;

    /**
     * Construct
     *
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $forwardFactory
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        PageFactory $resultPageFactory,
        ForwardFactory $forwardFactory,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->forwardFactory = $forwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->urlInterface = $urlInterface;
        $this->request = $request;
    }

    /**
     * Load the page defined in view/frontend/layout/careersmainpage_index_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPageFactory = $this->resultPageFactory->create();
        $baseUrl = $this->urlInterface->getBaseUrl();
        $page = $this->request->getParam('page');

        $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home', [
            'label' => __('Careers'),
            'title' => __('Careers'),
            'link' => $baseUrl . $page
                ]);
        $breadcrumbs->addCrumb('custom_module', [
            'label' => __('Job Description'),
            'title' => __('Job Description'),
                ]);
        return $resultPageFactory;
    }
}

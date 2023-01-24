<?php

namespace Terrificminds\CareerPageBuilder\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\ForwardFactory;

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

    protected $urlInterface;

    protected $request;

    protected $career;

    /**
     * Undocumented function
     *
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $forwardFactory
     */

    protected $redirect;

    public function __construct(
        PageFactory $resultPageFactory,
        ForwardFactory $forwardFactory,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\App\RequestInterface $request,
        \Terrificminds\CareerPageBuilder\Block\Widget\Career $career
    ) {
        $this->forwardFactory = $forwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->redirect=$redirect;
        $this->urlInterface = $urlInterface;
        $this->request = $request;
        $this->career = $career;
    }

   
    public function execute()
    {
        $resultPageFactory = $this->resultPageFactory->create();

        $baseUrl = $this->urlInterface->getBaseUrl();
        $jobId = $this->request->getParam('jobId');
        $url = $baseUrl.'/maincareerspage/index/index?jobId='.$jobId;

        $careerUrl = $this->career->buildUrl();

        $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('h', [
			'label' => __('Career'),
			'title' => __('Career'),
            'link' => $careerUrl
				]
		);
        $breadcrumbs->addCrumb('home', [
			'label' => __('Job Description'),
			'title' => __('Job Description'),
			'link' => $url
				]
		);
		$breadcrumbs->addCrumb('custom_module', [
			'label' => __('Form'),
			'title' => __('Form')
				]
		);
        return $resultPageFactory;
    }
}

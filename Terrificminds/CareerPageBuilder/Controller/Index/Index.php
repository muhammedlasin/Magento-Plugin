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

    protected $redirect;

    protected $urlInterface;

    /**
     * Undocumented function
     *
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        ForwardFactory $forwardFactory,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\UrlInterface $urlInterface
    ) {
        $this->forwardFactory = $forwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->redirect = $redirect;
        $this->urlInterface = $urlInterface;

    }

   
    public function execute()
    {
        $resultPageFactory = $this->resultPageFactory->create();

        $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home', [
			'label' => __('Careers'),
			'title' => __('Careers'),
			'link' =>  $this->redirect->getRefererUrl()
				]
		);
		$breadcrumbs->addCrumb('custom_module', [
			'label' => __('Job Description'),
			'title' => __('Job Description'),
				]
		);
        return $resultPageFactory;
    }
}

<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Application;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Terrificminds\CareerPageBuilder\Api\ApplicationRepositoryInterface;

/**
 * Application grid controller class
 */
class View extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $applicationRepository;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ApplicationRepositoryInterface $applicationRepository
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * Load the page defined in view/adminhtml/layout/careersmainpage_application_index.xml
     *
     * @return Page
     */
    public function execute()
    {   $id = $this->getRequest()->getParam('id');
        if ($id) {
            $applications = $this->applicationRepository->getById($id);
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Application Number : '. $applications->getApplicationId()));

        return $resultPage;
    }
}

<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Application;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Terrificminds\CareerPageBuilder\Api\ApplicationRepositoryInterface;

/**
 * Delete Applications class.
 */
class Delete extends Action implements HttpGetActionInterface
{
    /**
     * @var ApplicationRepositoryInterface
     */
    protected ApplicationRepositoryInterface $applicationRepository;

     /**
      * Construct
      *
      * @param \Magento\Backend\App\Action\Context $context
      * @param \Terrificminds\CareerPageBuilder\Api\ApplicationRepositoryInterface $applicationRepository
      */
    public function __construct(
        Context $context,
        ApplicationRepositoryInterface $applicationRepository
    ) {
        parent::__construct($context);
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * phpcs:disable PSR2.Methods.MethodDeclaration.Underscore
     *
     * {@inheritdoc}
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Terrificminds_CareerPageBuilder::application_delete');
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $id = $this->getRequest()->getParam('id');

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $application = $this->applicationRepository->getById($id);
                $this->applicationRepository->delete($application);
                $this->messageManager->addSuccessMessage(__('Job Application deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Application does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}

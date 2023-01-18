<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Job;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Terrificminds\CareerPageBuilder\Api\JobRepositoryInterface;

class Delete extends Action implements HttpGetActionInterface
{
    /**
     * @var JobRepositoryInterface
     */
    protected JobRepositoryInterface $jobRepository;

    public function __construct(
        Context $context,
        JobRepositoryInterface $jobRepository
    ) {
        parent::__construct($context);
        $this->jobRepository = $jobRepository;
    }

    /**
     * phpcs:disable PSR2.Methods.MethodDeclaration.Underscore
     *
     * {@inheritdoc}
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Terrificminds_CareerPageBuilder::job_delete');
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
                $job = $this->jobRepository->getById($id);
                $this->jobRepository->delete($job);
                $this->messageManager->addSuccessMessage(__('Job deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Job does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}

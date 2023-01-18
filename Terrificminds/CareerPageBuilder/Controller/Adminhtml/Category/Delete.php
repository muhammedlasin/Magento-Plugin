<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Terrificminds\CareerPageBuilder\Api\JobCategoryRepositoryInterface;
use Terrificminds\CareerPageBuilder\Api\JobRepositoryInterface;

class Delete extends Action implements HttpGetActionInterface
{
   
    protected JobCategoryRepositoryInterface $jobCategoryRepository;
    protected JobRepositoryInterface $jobRepository;

    public function __construct(
        Context $context,
        JobCategoryRepositoryInterface $jobCategoryRepository,
        JobRepositoryInterface $jobRepository
    ) {
        parent::__construct($context);
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->jobRepository = $jobRepository;
    }

    /**
     * phpcs:disable PSR2.Methods.MethodDeclaration.Underscore
     *
     * {@inheritdoc}
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Terrificminds_CareerPageBuilder::category_delete');
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
                $categories = $this->jobCategoryRepository->getById($id);
                $jobs = $this->jobRepository->getJobByCategory($id);
                $this->jobRepository->delete($jobs);
                $this->jobCategoryRepository->delete($categories);
                $this->messageManager->addSuccessMessage(__('Job Category deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Job Category does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}

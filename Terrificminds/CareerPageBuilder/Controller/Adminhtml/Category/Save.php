<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Terrificminds\CareerPageBuilder\Api\JobCategoryRepositoryInterface;
use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var Session
     */
    protected Session $adminSession;

    /**
     * @var JobCategoryRepositoryInterface
     */
    protected JobCategoryRepositoryInterface $jobCategoryRepository;

    /**
     * @var JobCategoryInterface
     */
    protected JobCategoryInterface $jobCategoryInterface;

       /**
        * Construct
        *
        * @param \Magento\Backend\App\Action\Context $context
        * @param \Magento\Backend\Model\Session $adminSession
        * @param \Terrificminds\CareerPageBuilder\Api\JobCategoryRepositoryInterface $jobCategoryRepository
        * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $jobCategoryInterface
        */
    public function __construct(
        Context $context,
        Session $adminSession,
        JobCategoryRepositoryInterface $jobCategoryRepository,
        JobCategoryInterface $jobCategoryInterface
    ) {
        parent::__construct($context);
        $this->adminSession = $adminSession;
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->jobCategoryInterface = $jobCategoryInterface;
    }

    /**
     * Save Resource data action
     *
     * @return Redirect
     *
     * phpcs:disable Generic.Files.LineLength.TooLong
     * phpcs:disable Magento2.Files.LineLength.MaxExceeded
     */
    public function execute(): Redirect
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $category_id = $this->getRequest()->getParam('id');
       
            if ($category_id) {
                $this->jobCategoryRepository->getById($category_id);
            }
                $categories = $this->jobCategoryInterface->setData($data);
            try {
                $this->jobCategoryRepository->save($categories);
                $this->messageManager->addSuccessMessage(__('The job category has been saved.'));
                $this->adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->jobCategoryInterface->getCategoryId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException | \RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

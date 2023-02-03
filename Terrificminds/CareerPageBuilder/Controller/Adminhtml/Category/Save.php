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
     * Save Category data action
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
            $categoryId = $this->getRequest()->getParam('id');
       
            if ($categoryId) {
                $this->jobCategoryRepository->getById($categoryId);
            }
            try {
                $categories = $this->jobCategoryInterface->setData($data);
                $this->jobCategoryRepository->save($categories);
                $this->messageManager->addSuccessMessage(__('The job category has been saved.'));
            } catch (\Magento\Framework\Exception\LocalizedException | \RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}

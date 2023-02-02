<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Job;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Terrificminds\CareerPageBuilder\Api\JobRepositoryInterface;
use Terrificminds\CareerPageBuilder\Api\Data\JobInterface;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var Session
     */
    protected Session $adminSession;

    /**
     * @var JobRepositoryInterface
     */
    protected JobRepositoryInterface $jobRepository;

    /**
     * @var JobInterface
     */
    protected JobInterface $jobInterface;

     /**
      * @param Context $context
      * @param Session $adminSession
      * @param JobRepositoryInterface $jobRepository
      * @param  JobInterface $jobInterface
      */
    public function __construct(
        Context $context,
        Session $adminSession,
        JobRepositoryInterface $jobRepository,
        JobInterface $jobInterface
    ) {
        parent::__construct($context);
        $this->adminSession = $adminSession;
        $this->jobRepository = $jobRepository;
        $this->jobInterface = $jobInterface;
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
            $jobId = $this->getRequest()->getParam('id');
            if ($jobId) {
                $this->jobRepository->getById($jobId);
            }
            $jobs = $this->jobInterface->setData($data);

            try {
                $this->jobRepository->save($jobs);
                $this->messageManager->addSuccessMessage(__('The job data has been saved.'));
                $this->adminSession->setFormData(false);
                // if ($this->getRequest()->getParam('back')) {
                //     if ($this->getRequest()->getParam('back') == 'add') {
                //         return $resultRedirect->setPath('*/*/add');
                //     } else {
                //         return $resultRedirect->setPath('*/*/edit', ['id' => $this->jobInterface->getId(), '_current' => true]);
                //     }
                // }
                // return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException | \RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            }

            // $this->_getSession()->setFormData($data);
            // return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

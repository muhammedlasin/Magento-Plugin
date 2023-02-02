<?php

namespace Terrificminds\CareerPageBuilder\Controller\Index;

use Terrificminds\CareerPageBuilder\Api\ApplicationRepositoryInterface;
use Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class to save form
 */
class Save implements HttpPostActionInterface
{
   /**
    * @var \Magento\Framework\Message\ManagerInterface
    */
    protected $messageManager;
    /**
     * @var ApplicationRepositoryInterface
     */
    protected $applicationRepository;
    /**
     * @var ApplicationInterface
     */
    protected $applicationInterface;
    /**
     * @var RedirectInterface;
     */
    protected $redirect;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlinterface;
      /**
       * @var \Magento\Framework\App\RequestInterface
       */

    protected $requestInterface;

      /**
       * @var \Magento\Framework\Controller\ResultFactory
       */
    protected $resultFactory;

     /**
      * @var \Terrificminds\CareerPageBuilder\Model\Email
      */
    protected $email;

     /**
      * @var \Terrificminds\CareerPageBuilder\Model\ApplicationManagement
      */
    protected $applicationManagement;

    /**
     * Construct function
     *
     * @param RedirectInterface $redirect
     * @param ApplicationRepositoryInterface $applicationRepository
     * @param ApplicationInterface $applicationInterface
     * @param ManagerInterface $messageManager
     * @param \Magento\Framework\App\RequestInterface $requestInterface
     * @param \Magento\Framework\UrlInterface $urlinterface
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     * @param \Terrificminds\CareerPageBuilder\Model\Email $email
     * @param \Terrificminds\CareerPageBuilder\Model\ApplicationManagement $applicationManagement
     */
    public function __construct(
        RedirectInterface $redirect,
        ApplicationRepositoryInterface $applicationRepository,
        ApplicationInterface $applicationInterface,
        ManagerInterface $messageManager,
        \Magento\Framework\App\RequestInterface $requestInterface,
        \Magento\Framework\UrlInterface $urlinterface,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Terrificminds\CareerPageBuilder\Model\Email $email,
        \Terrificminds\CareerPageBuilder\Model\ApplicationManagement $applicationManagement
    ) {
        $this->messageManager       = $messageManager;
        $this->redirect = $redirect;
        $this->applicationRepository = $applicationRepository;
        $this->applicationInterface = $applicationInterface;
        $this->urlinterface = $urlinterface;
        $this->requestInterface = $requestInterface;
        $this->resultFactory = $resultFactory;
        $this->email = $email;
        $this->applicationManagement = $applicationManagement;
    }
    
    /**
     * Execute function
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $params = $this->requestInterface->getParams();
        $uploadedFile = $this->applicationManagement->uploadFile();

        if (!$uploadedFile) {
            return $result->setUrl($this->redirect->getRefererUrl());
        }
        $applications = $this->applicationInterface->setData($params);
        $applications = $this->applicationInterface->setResume($uploadedFile);

        try {
            if ($uploadedFile) {
                $jobId = $this->requestInterface->getParam('jobId');
                $page = $this->requestInterface->getParam('page');
                $baseUrl = $this->urlinterface->getBaseUrl();
                $url = $baseUrl . '/maincareerspage/index/index?jobId=' . $jobId . '&page=' . $page;
                $this->applicationRepository->save($applications);
                $this->email->sendEmail($params);
                $this->messageManager->addSuccessMessage(__("The application has been sent successfully."));
                return $result->setUrl($url);
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong"));
            return $result->setUrl($this->redirect->getRefererUrl());
        }
    }
}

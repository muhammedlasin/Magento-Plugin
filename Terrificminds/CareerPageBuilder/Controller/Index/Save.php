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
     * @var \Magento\Framework\Filesystem $filesystem
     */
    protected $filesystem;

    /**
     * @var \Magento\MediaStorage\Model\File\Uploader
     */
    protected $fileUploader;
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
      * @var \Magento\Framework\Filesystem\Directory\WriteInterface
      */
    protected $mediaDirectory;
    /**
     * @var Request
     */
    protected $request;
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

    protected $email;

    /**
     * Construct function
     *
     * @param RedirectInterface $redirect
     * @param ApplicationRepositoryInterface $applicationRepository
     * @param ApplicationInterface $applicationInterface
     * @param ManagerInterface $messageManager
     * @param Filesystem $filesystem
     * @param UploaderFactory $fileUploader
     * @param \Magento\Framework\App\RequestInterface $requestInterface
     * @param \Magento\Framework\UrlInterface $urlinterface
     * @param Request $request
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     */
    public function __construct(
        RedirectInterface $redirect,
        ApplicationRepositoryInterface $applicationRepository,
        ApplicationInterface $applicationInterface,
        ManagerInterface $messageManager,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        \Magento\Framework\App\RequestInterface $requestInterface,
        \Magento\Framework\UrlInterface $urlinterface,
        Request $request,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Terrificminds\CareerPageBuilder\Model\Email $email
    ) {
        $this->messageManager       = $messageManager;
        $this->filesystem           = $filesystem;
        $this->fileUploader         = $fileUploader;
        $this->redirect = $redirect;
        $this->request = $request;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->applicationRepository = $applicationRepository;
        $this->applicationInterface = $applicationInterface;
        $this->urlinterface = $urlinterface;
        $this->requestInterface = $requestInterface;
        $this->resultFactory = $resultFactory;
        $this->email=$email;
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
        $uploadedFile = $this->uploadFile();

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
        }
    }

      /**
       * Upload file function
       *
       * @return string
       */
    public function uploadFile()
    {
        // this folder will be created inside "pub/media" folder
        $yourFolderName = 'uploads/';

        // "resume" is the HTML input file name
        $yourInputFileName = 'resume';

        try {
            $file = $this->request->getFiles($yourInputFileName);
            $fileName = ($file && array_key_exists('name', $file)) ? $file['name'] : null;

            if ($file && $fileName) {
                $target = $this->mediaDirectory->getAbsolutePath($yourFolderName);

            /* @var $uploader \Magento\MediaStorage\Model\File\Uploader */
                $uploader = $this->fileUploader->create(['fileId' => $yourInputFileName]);

                $extension = ["pdf", "doc", "txt", "png", "docx", "jpg"];

            // set allowed file extensions
                $uploader->setAllowedExtensions($extension);

            // allow folder creation
                $uploader->setAllowCreateFolders(true);

            // rename file name if already exists
                $uploader->setAllowRenameFiles(true);

                $files = $this->request->getFiles()->toArray();

                $destFile = $target . '/' . $files['resume']['name'];

                $filename = $uploader->getNewFileName($destFile);

            // upload file in the specified folder
                $result = $uploader->save($target, $filename);

                if ($result['file']) {
                    return $filename;
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
         return false;
    }
}

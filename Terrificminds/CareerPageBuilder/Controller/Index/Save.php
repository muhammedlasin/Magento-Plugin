<?php

namespace Terrificminds\CareerPageBuilder\Controller\Index;

use Terrificminds\CareerPageBuilder\Api\ApplicationRepositoryInterface;
use Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\HTTP\PhpEnvironment\Request;



class Save extends Action
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
     * @var \Magento\MediaStorage\Model\File\UploaderFactory $fileUploader
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

    protected $data;
    
    protected $mediaDirectory;
    /**
    * @var Request
    */
    protected $request;

    /**
     * Construct function
     *
     * @param Context $context
     * @param ApplicationRepositoryInterface $applicationRepository
     * @param ApplicationInterface $applicationInterface
     * @param Request $request
     */
    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        Context  $context,
        ApplicationRepositoryInterface $applicationRepository,
        ApplicationInterface $applicationInterface,
        ManagerInterface $messageManager,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        Request $request
    ) {
        $this->messageManager       = $messageManager;
        $this->filesystem           = $filesystem;
        $this->fileUploader         = $fileUploader;
        $this->redirect = $redirect;
        $this->request = $request;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->applicationRepository = $applicationRepository;
        $this->applicationInterface = $applicationInterface;
        parent::__construct($context);
    }
    
    /**
     * Execute function
     *
     * @return 
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->_request->getParams();
        $uploadedFile = $this->uploadFile();

        if(!$uploadedFile){
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }
        $applications = $this->applicationInterface->setData($params);
        $applications = $this->applicationInterface->setResume($uploadedFile);

        try {
            if ($uploadedFile) {
                $this->applicationRepository->save($applications);
                $this->messageManager->addSuccessMessage(__("Application has sent successfully."));
                return $resultRedirect->setUrl('*/*/');
            }

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong"));
        }

        
       
    }

    public function uploadFile()
    {
        // this folder will be created inside "pub/media" folder
        $yourFolderName = 'uploads/';

        // "resume" is the HTML input file name
        $yourInputFileName = 'resume';

        try{
        $file = $this->getRequest()->getFiles($yourInputFileName);
        $fileName = ($file && array_key_exists('name', $file)) ? $file['name'] : null;

        if ($file && $fileName) {
        $target = $this->mediaDirectory->getAbsolutePath($yourFolderName); 

        /* @var $uploader \Magento\MediaStorage\Model\File\Uploader */
        $uploader = $this->fileUploader->create(['fileId' => $yourInputFileName]);

        $extension = ['pdf'];

        // set allowed file extensions
        $uploader->setAllowedExtensions($extension);

        // allow folder creation
        $uploader->setAllowCreateFolders(true);

        // rename file name if already exists 
        $uploader->setAllowRenameFiles(true); 

        $files = $this->request->getFiles()->toArray();

        $destFile = $target.'/'.$files['resume']['name'];

        $filename = $uploader->getNewFileName($destFile);

        // upload file in the specified folder
        $result = $uploader->save($target, $filename);

        if ($result['file']) {
        $this->messageManager->addSuccess(__('File has been successfully uploaded.')); 
        return $filename;
        }
        }
        } catch (\Exception $e) {
        $this->messageManager->addError($e->getMessage());
        }
         return false;
    }
      
}
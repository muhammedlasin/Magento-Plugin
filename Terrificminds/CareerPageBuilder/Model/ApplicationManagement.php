<?php

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class to upload file
 */
class ApplicationManagement
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
      * @var \Magento\Framework\Filesystem\Directory\WriteInterface
      */
    protected $mediaDirectory;
    /**
     * @var Request
     */
    protected $request;

    /**
     * Construct function
     *
     * @param ManagerInterface $messageManager
     * @param Filesystem $filesystem
     * @param UploaderFactory $fileUploader
     * @param Request $request
     */
    public function __construct(
        ManagerInterface $messageManager,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        Request $request,
    ) {
        $this->messageManager       = $messageManager;
        $this->filesystem           = $filesystem;
        $this->fileUploader         = $fileUploader;
        $this->request = $request;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
    }
      /**
       * Upload file function
       *
       * @return string
       */
    public function uploadFile()
    {
        // this folder will be created inside "pub/media" folder
        $FolderName = 'uploads/';

        // "resume" is the HTML input file name
        $InputFileName = 'resume';

        try {
            $file = $this->request->getFiles($InputFileName);
            $fileName = ($file && array_key_exists('name', $file)) ? $file['name'] : null;

            if ($file && $fileName) {
                $target = $this->mediaDirectory->getAbsolutePath($FolderName);

            /* @var $uploader \Magento\MediaStorage\Model\File\Uploader */
                $uploader = $this->fileUploader->create(['fileId' => $InputFileName]);

                $extension = ["pdf", "doc", "docx"];

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

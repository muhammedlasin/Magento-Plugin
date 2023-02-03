<?php

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Job;
 
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
 
class Add extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Add new jobs function
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Add Jobs'));
        return $resultPage;
    }
}

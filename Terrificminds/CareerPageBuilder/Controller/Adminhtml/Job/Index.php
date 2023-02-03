<?php

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Job;
 
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
 
class Index extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Job Grid controller
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Jobs'));
        return $resultPage;
    }
}

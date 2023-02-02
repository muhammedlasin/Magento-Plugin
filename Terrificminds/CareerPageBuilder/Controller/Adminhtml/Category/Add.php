<?php

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Category;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
 
class Add extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Add categories form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Add Categories'));
        return $resultPage;
    }
}

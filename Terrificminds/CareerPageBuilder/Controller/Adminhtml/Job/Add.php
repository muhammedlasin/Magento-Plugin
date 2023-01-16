<?php
namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Job;
 
use Magento\Framework\Controller\ResultFactory;
 
class Add extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Add Jobs'));
        return $resultPage;
    }
}
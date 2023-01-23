<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;
use Terrificminds\CareerPageBuilder\Api\JobRepositoryInterface;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var Filter
     */
    protected Filter $filter;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    protected JobRepositoryInterface $jobRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        JobRepositoryInterface $jobRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->jobRepository = $jobRepository;
        parent::__construct($context);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            $jobs = $this->jobRepository->getJobByCategory($item['category_id']);
            foreach ($jobs as $job) {
                $job['category_id'] = 1;
                $this->jobRepository->save($job);
            }
            $item->delete();
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 categories(s) have been deleted.', $collectionSize));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}

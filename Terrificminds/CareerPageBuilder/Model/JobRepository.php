<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Terrificminds\CareerPageBuilder\Api\Data\JobInterface;
use Terrificminds\CareerPageBuilder\Api\JobRepositoryInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\Collection;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Job as JobResourceModel;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class JobRepository implements JobRepositoryInterface
{
    /**
     * @var JobCollectionFactory
     */
    private JobCollectionFactory $jobCollectionFactory;

    /**
     * @var JobResourceModel
     */
    private JobResourceModel $jobResourceModel;

    public function __construct(
        JobCollectionFactory $jobCollectionFactory,
        JobResourceModel $jobResourceModel
    ) {
        
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->jobResourceModel = $jobResourceModel;
    }

 

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getById($id): JobInterface
    {
        $job = $this->jobCollectionFactory->create()->addFieldToFilter('job_id', $id)->getFirstItem();
        if (! $job->getId()) {
            throw new NoSuchEntityException(__('Unable to find record with ID "%1"', $id));
        }
        return $job;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(JobInterface $jobs): JobInterface
    {
        try {
            if ($jobs->hasDataChanges()) {
                // Clear out updated_at field so the MySQL default value (CURRENT_TIMESTAMP) is used.
                $jobs->setData('updated_at', null);
            }
            $this->jobResourceModel->save($jobs);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $jobs;
    }

       /**
        * @inheritDoc
        * @throws CouldNotDeleteException
        */
    
    public function delete(JobInterface $jobs)
    {
        try {
            $this->jobResourceModel->delete($jobs);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    public function getJobByCategory($categoryId)
    {


        $job = $this->jobCollectionFactory->create()->addFieldToFilter('category_id', $categoryId)->getItems();
        return $job;
    }

    public function updateJobCategory($categoryId)
    {

        $job = $this->jobCollectionFactory->create()->addFieldToFilter('category_id', $categoryId)->getFirstItem();
        $job[0]['category_id'] = 0;
    }
}

<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;
use Terrificminds\CareerPageBuilder\Api\JobCategoryRepositoryInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory as JobCategoryCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\Collection;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory as JobCategoryResourceModel;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class JobCategoryRepository implements JobCategoryRepositoryInterface
{
 

    /**
     * @var JobCategoryCollectionFactory
     */
    private JobCategoryCollectionFactory $jobCategoryCollectionFactory;

    /**
     * @var JobCategoryResourceModel
     */
    private JobCategoryResourceModel $jobCategoryResourceResourceModel;

    public function __construct(
       
        JobCategoryCollectionFactory $jobCategoryCollectionFactory,
        JobCategoryResourceModel $jobCategoryResourceResourceModel
    ) {
        
        $this->jobCategoryCollectionFactory = $jobCategoryCollectionFactory;
        $this->jobCategoryResourceResourceModel = $jobCategoryResourceResourceModel;
    }

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getById($id): JobCategoryInterface
    {
        $job_category = $this->jobCategoryCollectionFactory->create()->addFieldToFilter('category_id', $id)->getFirstItem();
        if (! $job_category->getId()) {
            throw new NoSuchEntityException(__('Unable to find record with ID "%1"', $id));
        }
        return $job_category;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(JobCategoryInterface $categories): JobCategoryInterface
    {
        try {
            if ($categories->hasDataChanges()) {
                // Clear out updated_at field so the MySQL default value (CURRENT_TIMESTAMP) is used.
                $categories->setData('updated_at', null);
            }
            $this->jobCategoryResourceResourceModel->save($categories);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $categories;
    }

      /**
     * @inheritDoc
     * @throws CouldNotDeleteException
     */
    
    public function delete(JobCategoryInterface $categories)
    {
        try {
            $this->jobCategoryResourceResourceModel->delete($categories);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }
  
 

   
}

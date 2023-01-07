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
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory as ResourcesCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\Collection;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory as ProductResourcesResourceModel;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class JobCategoryRepository implements JobCategoryRepositoryInterface
{
 

    /**
     * @var ResourcesCollectionFactory
     */
    private ResourcesCollectionFactory $resourcesCollectionFactory;

    /**
     * @var ProductResourcesResourceModel
     */
    private ProductResourcesResourceModel $productResourceResourceModel;

    public function __construct(
       
        ResourcesCollectionFactory $resourcesCollectionFactory,
        ProductResourcesResourceModel $productResourceResourceModel
    ) {
        
        $this->resourcesCollectionFactory = $resourcesCollectionFactory;
        $this->productResourceResourceModel = $productResourceResourceModel;
    }

 

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(JobCategoryInterface $resources): JobCategoryInterface
    {
        try {
            if ($resources->hasDataChanges()) {
                // Clear out updated_at field so the MySQL default value (CURRENT_TIMESTAMP) is used.
                $resources->setData('updated_at', null);
            }
            $this->productResourceResourceModel->save($resources);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $resources;
    }

   
  
 

   
}

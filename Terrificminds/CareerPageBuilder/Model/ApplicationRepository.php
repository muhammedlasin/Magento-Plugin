<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface;
use Terrificminds\CareerPageBuilder\Api\ApplicationRepositoryInterface;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Application\CollectionFactory as ApplicationCollectionFactory;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\Collection;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\Application as ApplicationResourceModel;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ApplicationRepository implements ApplicationRepositoryInterface
{
 

    /**
     * @var ApplicationCollectionFactory
     */
    private ApplicationCollectionFactory $applicationCollectionFactory;

    /**
     * @var ApplicationResourceModel
     */
    private ApplicationResourceModel $applicationResourceModel;

    public function __construct(
       
        ApplicationCollectionFactory $applicationCollectionFactory,
        ApplicationResourceModel $applicationResourceModel
    ) {
        
        $this->applicationCollectionFactory = $applicationCollectionFactory;
        $this->applicationResourceModel = $applicationResourceModel;
    }

 

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getById($id): ApplicationInterface
    {
        $application = $this->applicationCollectionFactory->create()->addFieldToFilter('application_id', $id)->getFirstItem();
        if (! $application->getId()) {
            throw new NoSuchEntityException(__('Unable to find Pacvac Resource record with ID "%1"', $id));
        }
        return $application;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(ApplicationInterface $form): ApplicationInterface
    {
        try {
            if ($form->hasDataChanges()) {
                // Clear out updated_at field so the MySQL default value (CURRENT_TIMESTAMP) is used.
                $form->setData('updated_at', null);
            }
            $this->applicationResourceModel->save($form);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $form;
    }

       /**
     * @inheritDoc
     * @throws CouldNotDeleteException
     */
    
    public function delete(ApplicationInterface $jobs)
    {
        try {
            $this->applicationResourceModel->delete($jobs);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }
   
}

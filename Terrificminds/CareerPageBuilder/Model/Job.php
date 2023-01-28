<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Terrificminds\CareerPageBuilder\Api\Data\JobInterface;

class Job extends AbstractExtensibleModel implements JobInterface
{
 /**
  * DB table column keys
  */
    private const ID = "job_id";
    private const JOB_DESIGNATION = "job_designation";
    private const SMALL_DESCRIPTION = "small_job_description";
    private const DETAILED_DESCRIPTION = "detailed_job_description";
    private const STATUS = "is_active";
    private const CATEGORY = "category_id";
    private const ACTION = "button_action";
    private const URL = "button_url";
    private const SORT_ORDER = "sort_order";
    private const CREATED_AT = "created_at";
    private const UPDATED_AT = "updated_at";

     /**
      * Construct function
      */
    protected function _construct()
    {

        $this->_init(ResourceModel\Job::class);
    }

/**
 * @inheritDoc
 */
    public function getJobId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setJobId(int $id): JobInterface
    {
        return $this->setData(self::ID);
    }
    
    /**
     * @inheritDoc
     */
    public function getJobDesignation(): string
    {
        return $this->getData(self::JOB_DESIGNATION);
    }

    /**
     * @inheritDoc
     */
    public function setJobDesignation(string $job): JobInterface
    {
        return $this->setData(self::JOB_DESIGNATION);
    }

        /**
         * @inheritDoc
         */
    public function getSmallJobDescription(): string
    {
        return $this->getData(self::SMALL_DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setSmallJobDescription(string $small): JobInterface
    {
        return $this->setData(self::SMALL_DESCRIPTION);
    }

        /**
         * @inheritDoc
         */
    public function getDetailedJobDescription(): string
    {
        return $this->getData(self::DETAILED_DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDetailedJobDescription(string $detailed): JobInterface
    {
        return $this->setData(self::DETAILED_DESCRIPTION);
    }

        /**
         * @inheritDoc
         */
    public function getIsActive()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(int $active): JobInterface
    {
        return $this->setData(self::STATUS);
    }

        /**
         * @inheritDoc
         */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId(int $category): JobInterface
    {
        return $this->setData(self::CATEGORY);
    }

        /**
         * @inheritDoc
         */
    public function getButtonAction(): string
    {
        return $this->getData(self::ACTION);
    }

    /**
     * @inheritDoc
     */
    public function setButtonAction(string $action): JobInterface
    {
        return $this->setData(self::ACTION);
    }

     /**
      * @inheritDoc
      */
    public function getButtonUrl(): string
    {
        return $this->getData(self::URL);
    }

    /**
     * @inheritDoc
     */

    public function setButtonUrl(string $url): JobInterface
    {
        return $this->setData(self::URL);
    }
 /**
  * @inheritDoc
  */
    public function getSortOrder(): int
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * @inheritDoc
     */
    public function setSortOrder(int $order): JobInterface
    {
        return $this->setData(self::SORT_ORDER);
    }
    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): int
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(int $updatedAt)
    {
        return $this->setData(self::UPDATED_AT);
    }
}

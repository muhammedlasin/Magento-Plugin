<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface JobInterface extends ExtensibleDataInterface
{
    /**
     * Get Id
     *
     * @return 
     */
    public function getJobId();

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setJobId(int $id): JobInterface;

    /**
     * Get Job Designation
     *
     * @return string
     */
    public function getJobDesignation(): string;

    /**
     * Set Job Designation
     *
     * @param string $job
     *
     * @return $this
     */
    public function setJobDesignation(string $job): JobInterface;

        /**
     * Get Small Job Description
     *
     * @return string
     */
    public function getSmallJobDescription(): string;

    /**
     * Set Small Job Description
     *
     * @param string $small
     *
     * @return $this
     */
    public function setSmallJobDescription(string $small): JobInterface;

         /**
     * Get Small Job Description
     *
     * @return string
     */
    public function getDetailedJobDescription(): string;

    /**
     * Set Detailed Job Description
     *
     * @param string $detailed
     *
     * @return $this
     */
    public function setDetailedJobDescription(string $detailed): JobInterface;

         /**
     * Get Status
     *
     * @return int
     */
    public function getIsActive(): int;

    /**
     * Set Status
     *
     * @param int $active
     *
     * @return $this
     */
    public function setIsActive(int $active): JobInterface;

         /**
     * Get Category Id
     *
     * 
     */
    public function getCategoryId();

    /**
     * Set Category Id
     *
     * @param int $category
     *
     * @return $this
     */
    public function setCategoryId(int $category): JobInterface;

         /**
     * Get Button Action
     *
     * @return string
     */
    public function getButtonAction(): string;

    /**
     * Set Button Action
     *
     * @param string $action
     *
     * @return $this
     */
    public function setButtonAction(string $action): JobInterface;


         /**
     * Get Button Url
     *
     * @return string
     */
    public function getButtonUrl(): string;

    /**
     * Set Button Url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setButtonUrl(string $url): JobInterface;


         /**
     * Get Order
     *
     * @return int
     */
    public function getSortOrder(): int;

    /**
     * Set Order
     *
     * @param int $order
     *
     * @return $this
     */
    public function setSortOrder(int $order): JobInterface;
   
    /**
     * Get created at timestamp
     *
     * @return int
     */
    public function getCreatedAt(): int;

    /**
     * Set created at timestamp
     *
     * @param int $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(int $createdAt);

    /**
     * Get Updated at timestamp
     *
     * @return int
     */
    public function getUpdatedAt(): int;

    /**
     * Set Updated at timestamp
     *
     * @param int $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(int $updatedAt);
}

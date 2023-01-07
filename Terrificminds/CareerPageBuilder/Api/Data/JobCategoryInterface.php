<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface JobCategoryInterface extends ExtensibleDataInterface
{
    /**
     * Get Id
     *
     * @return int
     */
    public function getCategoryId(): int;

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setCategoryId(int $id): JobCategoryInterface;

    /**
     * Get Category
     *
     * @return string
     */
    public function getCategoryName(): string;

    /**
     * Set Category
     *
     * @param string $category
     *
     * @return $this
     */
    public function setCategoryName(string $category): JobCategoryInterface;

   
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

<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api;

use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;

/**
 * Job Category CRUD interface.
 * @api
 * @since 100.0.2
 */
interface JobCategoryRepositoryInterface
{
     /**
      * Get Category block.
      *
      * @param int $id
      * @return \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface
      */
    public function getById($id): JobCategoryInterface;

    /**
     * Save block.
     *
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $categories
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface
     */
    public function save(JobCategoryInterface $categories): JobCategoryInterface;

    /**
     * Delete block.
     *
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $categories
     * @return void
     */
    public function delete(JobCategoryInterface $categories);
}

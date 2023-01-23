<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api;

use Terrificminds\CareerPageBuilder\Api\Data\JobInterface;

/**
 * Job CRUD interface.
 * @api
 * @since 100.0.2
 */
interface JobRepositoryInterface
{
       /**
        * Get Job block.
        *
        * @param int $id
        * @return \Terrificminds\CareerPageBuilder\Api\Data\JobInterface
        */
    public function getById($id): JobInterface;

    /**
     * Save block.
     *
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobInterface $jobs
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobInterface
     */
    public function save(JobInterface $jobs): JobInterface;

    /**
     * Delete block.
     *
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobInterface $jobs
     * @return void
     */

    public function delete(JobInterface $jobs);

     /**
      * Get Job by category block.
      *
      * @param int $categoryId
      * @return \Terrificminds\CareerPageBuilder\Api\Data\JobInterface
      */
    public function getJobByCategory($categoryId);
}

<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Terrificminds\CareerPageBuilder\Api\Data\JobInterface;


interface JobRepositoryInterface
{
       /**
     * @param $id
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobInterface
     */
    public function getById($id): JobInterface;


    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobInterface $jobs
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobInterface
     */
    public function save(JobInterface $jobs): JobInterface;

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobInterface $jobs
     * @return void
     */

    public function delete(JobInterface $jobs);


  public function getJobByCategory($categoryId);

  public function updateJobCategory($categoryId);
 
}

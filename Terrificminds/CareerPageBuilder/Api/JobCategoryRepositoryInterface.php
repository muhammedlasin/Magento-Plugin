<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;


interface JobCategoryRepositoryInterface
{
    

     /**
     * @param $id
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface
     */
    public function getById($id): JobCategoryInterface;

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $categories
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface
     */
    public function save(JobCategoryInterface $categories): JobCategoryInterface;

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $categories
     * @return void
     */

    public function delete(JobCategoryInterface $categories);
 
}

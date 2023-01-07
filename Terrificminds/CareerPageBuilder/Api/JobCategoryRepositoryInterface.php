<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;


interface JobCategoryRepositoryInterface
{
    

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $resources
     * @return \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface
     */
    public function save(JobCategoryInterface $resources): JobCategoryInterface;

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface $resources
     * @return void
     */


 
}

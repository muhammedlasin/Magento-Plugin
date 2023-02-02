<?php

namespace Terrificminds\CareerPageBuilder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Terrificminds\CareerPageBuilder\Api\JobCategoryRepositoryInterface;
use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;

class AddCategory implements DataPatchInterface, PatchVersionInterface
{
       /**
        * @var JobCategoryRepositoryInterface
        */
    protected $jobCategoryRepository;
   /**
    * @var JobCategoryInterface
    */
    protected $jobCategoryInterface;

     /**
      * Constructor function
      *
      * @param  JobCategoryRepositoryInterface $jobCategoryRepository
      * @param  JobCategoryInterface $jobCategoryInterface
      */
    public function __construct(
        JobCategoryRepositoryInterface $jobCategoryRepository,
        JobCategoryInterface $jobCategoryInterface
    ) {
         $this->jobCategoryRepository = $jobCategoryRepository;
         $this->jobCategoryInterface = $jobCategoryInterface;
    }

/**
 * @inheritdoc
 *
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
    public function apply()
    {
        $categoryData = [];
        $categoryData['category_name'] = "Unassigned";
        $categoryData['is_active'] = 1;
        $category = $this->jobCategoryInterface->setData($categoryData);
        $this->jobCategoryRepository->save($category);
        return $this;
    }
/**
 * @inheritdoc
 */
    public static function getDependencies()
    {
         return [];
    }

/**
 * @inheritdoc
 */
    public static function getVersion()
    {
         return '2.0.0';
    }

/**
 * @inheritdoc
 */
    public function getAliases()
    {
         return [];
    }
}

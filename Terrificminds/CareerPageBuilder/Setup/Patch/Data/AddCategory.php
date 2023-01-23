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
    private $categoryRepository;

    /**
     * @var JobCategoryInterface
     */
    private $categoryInterface;

    /**
     * @param JobCategoryRepositoryInterface $categoryRepository
     * @param JobCategoryInterface $categoryInterface
     */
    public function __construct(
        JobCategoryRepositoryInterface $categoryRepository,
        JobCategoryInterface $categoryInterface
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $categoryData = [
            'category_name' => 'Unassigned',
            'is_active' => 1,
        ];

        $category = $this->categoryInterface->create();
        $category->setData($categoryData);
        $this->categoryRepository->save($category);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '2.0.1';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}

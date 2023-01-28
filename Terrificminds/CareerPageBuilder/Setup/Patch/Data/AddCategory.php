<?php

namespace Terrificminds\CareerPageBuilder\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddCategory implements DataPatchInterface, PatchVersionInterface
{    
       /**
     * @var JobCategory
     */
    private $category;
    public function __construct(
        \Terrificminds\CareerPageBuilder\Model\JobCategory $category
    ) {
         $this->category = $category;
    }


/**

 * {@inheritdoc}

 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)

 */

    public function apply()
    {

         $categoryData = [];

           $categoryData['category_name'] = "Unassigned";

         $categoryData['is_active'] = 1;


           $this->category->addData($categoryData);

         $this->category->getResource()->save($this->category);
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
         return '2.0.0';
    }

/**

 * {@inheritdoc}
 */

    public function getAliases()
    {
         return [];
    }
}

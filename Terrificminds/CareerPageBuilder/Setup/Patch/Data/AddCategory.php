<?php

namespace Terrificminds\CareerPageBuilder\Setup\Patch\Data;

     use Magento\Framework\Setup\Patch\DataPatchInterface;

         use Magento\Framework\Setup\Patch\PatchVersionInterface;

     use Magento\Framework\Module\Setup\Migration;

use Magento\Framework\Setup\ModuleDataSetupInterface;



class AddCategory implements DataPatchInterface, PatchVersionInterface

{
private $author;
public function __construct(

     \Terrificminds\CareerPageBuilder\Model\JobCategory $author

) {
     $this->author = $author;
}


/**

* {@inheritdoc}

* @SuppressWarnings(PHPMD.ExcessiveMethodLength)

*/

public function apply()

{

     $authorData = [];

       $authorData['category_name'] = "Unassigned";

         $authorData['is_active'] = 1;


       $this->author->addData($authorData);

     $this->author->getResource()->save($this->author);
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
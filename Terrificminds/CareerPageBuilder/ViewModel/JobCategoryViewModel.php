<?php
namespace Terrificminds\CareerPageBuilder\ViewModel;
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;
class JobCategoryViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
     /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
 
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }
 
    public function categoryName()
    {
        $collection = $this->collectionFactory->create();
        $name = '';

        foreach ($collection as $category) {
            $name = $category->getCategoryName();
        }

        return $name;
    }
}
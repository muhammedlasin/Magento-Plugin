<?php
namespace Terrificminds\CareerPageBuilder\Model\Source;
 
use Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
 
class Category implements OptionSourceInterface
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
 
    public function toOptionArray()
    {
        $options[] = [];
        $collection = $this->collectionFactory->create();
            
 
        foreach ($collection as $category) {
            $options[] = [
                'label' => $category->getCategoryName(),
                'value' => $category->getId(),
            ];
        }
 
        return $options;
    }
}


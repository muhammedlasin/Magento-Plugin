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
        $collection = $this->collectionFactory->create();
        foreach ($collection as $category) {
            $label = '';
            $value = 0;
            if ($category->getId() != 0) {
                $label = $category->getCategoryName();
                $value = $category->getId();
            }
            $options[] = [
                'label' => $label,
                'value' => $value,
            ];
        }
        return $options;
    }
}

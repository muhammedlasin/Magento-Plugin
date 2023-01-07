<?php
declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Terrificminds\CareerPageBuilder\Api\Data\JobCategoryInterface;


class JobCategory extends AbstractExtensibleModel implements JobCategoryInterface {

const CACHE_TAG = 'category_id';

 /**
     * DB table column keys
     */
    private const ID = "category_id";
    private const CATEGORY = "category_name";
    private const CREATED_AT = "created_at";
    private const UPDATED_AT = "updated_at";

protected function _construct()

{

$this->_init('Terrificminds\CareerPageBuilder\Model\ResourceModel\JobCategory');

}

/**
     * @inheritDoc
     */
    public function getCategoryId(): int
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId(int $id): JobCategoryInterface
    {
        return $this->setData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryName(): string
    {
        return $this->getData(self::CATEGORY);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryName(string $category): JobCategoryInterface
    {
        return $this->setData(self::CATEGORY);
    }

    

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): int
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(int $createdAt)
    {
        return $this->setData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): int
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(int $updatedAt)
    {
        return $this->setData(self::UPDATED_AT);
    }
}



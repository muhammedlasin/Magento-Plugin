<?php

namespace Terrificminds\CareerPageBuilder\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Terrificminds\CareerPageBuilder\Api\JobCategoryRepositoryInterface;

class DisplayCategory extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    protected JobCategoryRepositoryInterface $jobCategoryRepository;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        JobCategoryRepositoryInterface $jobCategoryRepository,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->jobCategoryRepository = $jobCategoryRepository;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item) {
                        $categories = $this->jobCategoryRepository->getById($item['category_id']);
                        $item['category_id'] = $categories->getCategoryName();
                }
            }
        }

        return $dataSource;
    }
}

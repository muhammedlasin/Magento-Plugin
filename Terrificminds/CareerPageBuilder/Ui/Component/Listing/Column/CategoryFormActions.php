<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class CategoryFormActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    private const URL_EDIT_PATH = 'maincareerspage/category/edit';
    private const URL_DELETE_PATH = 'maincareerspage/category/delete';

    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /**
     * Constructor function
     *
     * @param UrlInterface $urlBuilder
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

     /**
      * Prepare Data Source for category delete action.
      *
      * @param array $dataSource
      * @return array|array[]
      */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['category_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_EDIT_PATH,
                                [
                                    'id' => $item['category_id'],
                                ]
                            ),
                            'label' => __('Edit'),
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_DELETE_PATH,
                                [
                                    'id' => $item['category_id'],
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                             'title' => __('Delete %1', $item['category_name']),
                             'message' => __(
                                 'The jobs assigned to this category will be unassigned.
                                  Are you sure you want to delete the %1 category?',
                                 $item['category_name']
                             ),
                            ],
                        
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}

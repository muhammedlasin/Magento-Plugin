<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class ApplicationActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    private const URL_DELETE_PATH = 'maincareerspage/application/delete';
    private const URL_VIEW_PATH = 'maincareerspage/application/view';

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
     * Prepare Data Source for application delete action.
     *
     * @param array $dataSource
     * @return array|array[]
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['application_id'])) {
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_VIEW_PATH,
                                [
                                    'id' => $item['application_id'],
                                ]
                            ),
                            'label' => __('View'),
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_DELETE_PATH,
                                [
                                    'id' => $item['application_id'],
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                            'title' => __('Delete %1', $item['applicant_name']),
                            'message' => __('Are you sure you want to delete a %1 record?', $item['applicant_name']),
                            ],
                        
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}

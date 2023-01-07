<?php
namespace Terrificminds\CareerPageBuilder\Block\Adminhtml\Main\Edit\Button;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

class Save extends Generic implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info("/////////////////-----logger initiated-----//////////////////////");
        $logger->info("resulllt " . print_r('1', true));
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'jobcategory_form.jobcategory_form',
                                'actionName' => 'save',
                                'params' => [false],
                                $logger->info("resulllt " . print_r('2', true)),
                            ],
                        ],
                    ],
                ],
            ],

        ];
    }


}
<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model\Source;

use Magento\Framework\Phrase;

class ButtonAction implements \Magento\Framework\Data\OptionSourceInterface
{
    public const FORM = 1;

    public const URL = 0;

    /**
     * @return array|array[]
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::FORM,
                'label' => __('Form')
            ],
            [
                'value' => self::URL,
                'label' => __('URL')
            ]
        ];
    }
}

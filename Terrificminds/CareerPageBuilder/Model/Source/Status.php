<?php

declare(strict_types=1);

namespace Terrificminds\CareerPageBuilder\Model\Source;

use Magento\Framework\Phrase;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    public const ENABLED = 1;

    public const DISABLED = 0;

    /**
     * Get enabled/disabled value.
     *
     * @return array|array[]
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::ENABLED,
                'label' => __('Enabled')
            ],
            [
                'value' => self::DISABLED,
                'label' => __('Disabled')
            ]
        ];
    }
}

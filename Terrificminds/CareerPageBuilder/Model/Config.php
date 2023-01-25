<?php

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    protected const PATH = 'career/';
    
    /**
     * GetConfigValue function
     *
     * @param string $field
     * @return configuration value
     */
    public function getConfigValue($field)
    {
        return $this->scopeConfig->getValue(self::PATH . 'general/' . $field, ScopeInterface::SCOPE_STORE);
    }
}

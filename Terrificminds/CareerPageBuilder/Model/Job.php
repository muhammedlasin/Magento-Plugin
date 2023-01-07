<?php

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\Model\AbstractModel;

class JobCategory extends AbstractModel {

const CACHE_TAG = 'job_id';

protected function _construct()

{

$this->_init('Terrificminds\CareerPageBuilder\Model\ResourceModel\Job');

}

public function getIdentities()
{
return [self::CACHE_TAG . '_' . $this->getId()];
}

}
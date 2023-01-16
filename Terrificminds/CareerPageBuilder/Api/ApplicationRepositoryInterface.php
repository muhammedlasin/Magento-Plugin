<?php

namespace Terrificminds\CareerPageBuilder\Api;

use Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface;

interface ApplicationRepositoryInterface
{
    /**
     * @param int $id
     * @return \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface $form
     * @return \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface
     */
    public function save(ApplicationInterface $form);

    /**
     * @param \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface $form
     * @return void
     */
    public function delete(ApplicationInterface $form);

  
}
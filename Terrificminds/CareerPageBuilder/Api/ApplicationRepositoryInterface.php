<?php

namespace Terrificminds\CareerPageBuilder\Api;

use Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface;

/**
 * Application CRUD interface.
 * @api
 * @since 100.0.2
 */
interface ApplicationRepositoryInterface
{
    /**
     * Get Application block.
     *
     * @param int $id
     * @return \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * Save block.
     *
     * @param \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface $form
     * @return \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface
     */
    public function save(ApplicationInterface $form);

    /**
     * Delete block.
     *
     * @param \Terrificminds\CareerPageBuilder\Api\Data\ApplicationInterface $form
     * @return void
     */
    public function delete(ApplicationInterface $form);
}

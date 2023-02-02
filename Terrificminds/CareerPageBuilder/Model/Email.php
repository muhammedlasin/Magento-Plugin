<?php

namespace Terrificminds\CareerPageBuilder\Model;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;

class Email extends AbstractHelper
{
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;
   /**
    * @var \Magento\Store\Model\StoreManagerInterface
    */
    protected $storeManager;

       /**
        * @var \Magento\Framework\Translate\Inline\StateInterface
        */
    protected $inlineTranslation;

     /**
      * Constructor function
      *
      * @param Context $context
      * @param TransportBuilder $transportBuilder
      * @param StoreManagerInterface $storeManager
      * @param StateInterface $state
      */
    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface $state
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        parent::__construct($context);
    }

       /**
        * Send Email function
        *
        * @param array $params
        * @return bool
        */
    public function sendEmail($params)
    {
        $templateId = $this->scopeConfig->getValue('career/general/template', ScopeInterface::SCOPE_STORE);
        $fromEmail = $this->scopeConfig->getValue('trans_email/ident_general/email', ScopeInterface::SCOPE_STORE);
        $fromName = $this->scopeConfig->getValue('trans_email/ident_general/name', ScopeInterface::SCOPE_STORE);
        //admin
        $adminEmail = $this->scopeConfig->getValue('career/general/adminEmail', ScopeInterface::SCOPE_STORE);
        $adminName = $this->scopeConfig->getValue('career/general/adminName', ScopeInterface::SCOPE_STORE);
        try {
            $storeId = $this->storeManager->getStore()->getId();
            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars([
                    'name' => $params['applicant_name'],
                    'role' => $params['job_designation'],
                    'owner' => $fromName
                ])
                ->setFromByScope($from)
                ->addTo($params['email'], $params['applicant_name'])
                ->getTransport();
                $transport->sendMessage();
            if ($adminEmail) {
                $transportAdmin = $this->transportBuilder->setTemplateIdentifier('career_general_admin')
                    ->setTemplateOptions($templateOptions)
                    ->setTemplateVars([
                        'name' => $params['applicant_name'],
                        'role' => $params['job_designation'],
                        'adminName' => $adminName
                    ])
                    ->setFromByScope($from)
                    ->addTo($adminEmail, $adminName)
                    ->getTransport();
                $transportAdmin->sendMessage();
            }
            $this->inlineTranslation->resume();
            return true;
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
            return false;
        }
    }
}

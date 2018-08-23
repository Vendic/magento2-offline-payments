<?php
declare(strict_types=1);

/**
 * @author Tjitse (Vendic)
 * Created on 23-08-18 10:15
 */

namespace Vendic\OfflinePayments\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class Settings
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    public function getEnabledForStores(string $paymentMethodCode): array
    {
        $xmlConfigPath = "payment/{$paymentMethodCode}/store_views";
        $values = $this->getValue($xmlConfigPath);

        if ($values) {
            return explode(',', $values);
        }

        return [];

    }

    /**
     * @return string
     */
    public function getCurrentStoreCode()
    {
        return $this->storeManager->getStore()->getCode();
    }

    protected function getValue($xmlPath)
    {
        return $this->scopeConfig->getValue($xmlPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
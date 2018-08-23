<?php
declare(strict_types=1);

/**
 * @author Tjitse (Vendic)
 * Created on 23-08-18 09:31
 */

namespace Vendic\OfflinePayments\Model;

use Magento\Payment\Model\Method\AbstractMethod;
use Vendic\OfflinePayments\Model\Config\Settings;

abstract class Method extends AbstractMethod
{
    /**
     * @var Settings
     */
    protected $settings;

    public function __construct(
        Settings $settings,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context, $registry, $extensionFactory, $customAttributeFactory, $paymentData, $scopeConfig, $logger,
            $resource, $resourceCollection, $data
        );
        $this->settings = $settings;
    }

    public function isAvailable(\Magento\Quote\Api\Data\CartInterface $quote = null)
    {
        $storeCode = $this->settings->getCurrentStoreCode();
        $allowedStores = $this->settings->getEnabledForStores($this->_code);

        if (in_array($storeCode, $allowedStores)) {
            return parent::isAvailable($quote);
        }

        return false;
    }

}
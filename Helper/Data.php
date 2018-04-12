<?php
/**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */

namespace Mageants\Shippingtracker\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);
    }
    /**
     * Get config values
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function getConfig($config_path){
        return $this->scopeConfig->getValue($config_path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}    
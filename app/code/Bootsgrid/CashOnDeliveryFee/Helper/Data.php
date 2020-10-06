<?php
namespace Bootsgrid\CashOnDeliveryFee\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const CONFIG_SUCCESS_MESSAGE = 'Cash on Delivery is available';
    /**
     *
     */
    const CONFIG_ERROR_MESSAGE = 'Cash on Delivery is not available';
    protected $scopeConfig;
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeInterface
        ) 
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeInterface;
      
    }
    public function getCodlabel()
    {

      return $this->scopeConfig->getValue('payment/cashondelivery/label',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getEnableZipCode()
    {
      return $this->scopeConfig->getValue('payment/cashondelivery/enable_zipcode',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getAddressType()
    {
      return $this->scopeConfig->getValue('payment/cashondelivery/address_type',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getPostcodes()
    {
      return $this->scopeConfig->getValue('payment/cashondelivery/zipcode',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getSuccessMessage()
    {
        $text = 'Cash on Delivery is available';
        return  $text;
    }
    
    public function getErrorMessage()
    {
         $text = 'Cash on Delivery is not available';
        return  $text;
    }
    public function allowedShippingMethod()
    {
         return $this->scopeConfig->getValue('payment/cashondelivery/shipping_methods',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
     public function codFeetype()
    {
         return $this->scopeConfig->getValue('payment/cashondelivery/feetype',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function codCalculation()
    {
         return $this->scopeConfig->getValue('payment/cashondelivery/feecalc',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
     public function codFee()
    {
         return $this->scopeConfig->getValue('payment/cashondelivery/fee',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
  
<?php
/**
 * Copyright © 2016 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Bootsgrid\CashOnDeliveryFee\Plugin\Payment\Method\CashOnDelivery;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Backend\Model\Auth\Session as BackendSession;
use Magento\OfflinePayments\Model\Cashondelivery;
use Bootsgrid\CashOnDeliveryFee\Helper\Data as DataHelper;

class Available
{

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var BackendSession
     */
    protected $backendSession;

    protected $_checkoutSession;

    protected $_helper;


    /**
     * @param CustomerSession $customerSession
     * @param BackendSession $backendSession
     */
    public function __construct(
        CustomerSession $customerSession,
        BackendSession $backendSession,
        \Magento\Checkout\Model\Session $_checkoutSession,
        DataHelper $dataHelper

    ) {
        $this->customerSession = $customerSession;
        $this->backendSession = $backendSession;
        $this->_checkoutSession = $_checkoutSession;
         $this->dataHelper = $dataHelper;
    }

    /**
     *
     * @param Cashondelivery $subject
     * @param $result
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterIsAvailable(Cashondelivery $subject, $result)
    {
        // Do not remove payment method for admin
        if ($this->backendSession->isLoggedIn()) {
            return $result;
        }
        $shippingMethod = $this->_checkoutSession->getQuote()->getShippingAddress()->getShippingMethod();
        $allowshippingmethod = $this->dataHelper->allowedShippingMethod();
        
        // if($allowshippingmethod != '')
        // {
        //     $rate = explode(',', $allowshippingmethod );
        //     $shippingrate = in_array($shippingMethod, $rate) ? true : false;
        //     return $shippingrate; 

        // }
        // else
        // {
        //         return true;
        // }
        // $result = $proceed();

        $allowallcode =  $this->dataHelper->getEnableZipCode();
        if($allowallcode == 1  )
        {
            $postcodes = $this->dataHelper->getPostcodes();
            $addresstypes = $this->dataHelper->getAddressType();
            $postcode = array_map('trim', explode(',', $postcodes));

            $shippingAddresss = $this->_checkoutSession->getQuote()->getShippingAddress()->getPostcode();
            $billingAddress = $this->_checkoutSession->getQuote()->getBillingAddress()->getPostcode();
            $zipcode = (trim($addresstypes) == 'shipping') ?  $shippingAddresss : $billingAddress;

            $rate = explode(',', $allowshippingmethod );

            $res = (in_array($zipcode, $postcode) && in_array($shippingMethod, $rate))?  true : false;
            return $res;
             

        }
        else
        {
            return true;
        }
        return $result;
    }
}
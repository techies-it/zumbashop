<?php
// declare(strict_types = 1);
namespace Bootsgrid\CashOnDeliveryFee\Model\Total;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Phrase;
use Magento\OfflinePayments\Model\Cashondelivery;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Store\Model\ScopeInterface;
use Bootsgrid\CashOnDeliveryFee\Helper\Data as DataHelper;

class CashOnDeliveryFee extends AbstractTotal
{
    const CONFIG_PATH_FEE_AMOUNT = 'payment/cashondelivery/fee';

    const TOTAL_CODE = 'cash_on_delivery_fee';
    const BASE_TOTAL_CODE = 'base_cash_on_delivery_fee';

    const LABEL = 'Cash On Delivery Fee';
    const BASE_LABEL = 'Base Cash On Delivery Fee';

    /**
     * @var float
     */
     private $dataHelper;
    private $fee;
    private $baseCurrency;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        DataHelper $dataHelper    )
    {
        $this->dataHelper = $dataHelper;
       
        $currencyCode = $scopeConfig->getValue("currency/options/base", ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        $this->baseCurrency =  $currencyFactory->create()->load($currencyCode);
    }

    public function collect(
        Quote $quote,
        ShippingAssignmentInterface
        $shippingAssignment,
        Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        if (count($shippingAssignment->getItems()) == 0) {
            return $this;
        }

        $baseCashOnDeliveryFee = $this->getFee($quote);
        $currency = $quote->getStore()->getCurrentCurrency();
        $cashOnDeliveryFee = $this->baseCurrency->convert($baseCashOnDeliveryFee, $currency);

        $total->setData(static::TOTAL_CODE, $cashOnDeliveryFee);
        $total->setData(static::BASE_TOTAL_CODE, $baseCashOnDeliveryFee);

        $total->setTotalAmount(static::TOTAL_CODE, $cashOnDeliveryFee);
        $total->setBaseTotalAmount(static::TOTAL_CODE, $baseCashOnDeliveryFee);

        return $this;
    }

    public function fetch(Quote $quote, Total $total)
    {
        $base_value = $this->getFee($quote);
        if ($base_value) {
            $currency = $quote->getStore()->getCurrentCurrency();
            $value = $this->baseCurrency->convert($base_value, $currency);
        } else {
            $value = null;
        }
        return [
            'code' => static::TOTAL_CODE,
            'title' => static::LABEL,
            'base_value' => $base_value,
            'value' => $value
        ];
    }

    public function getLabel()
    {
        return __(static::LABEL);
    }
    

    private function getFee(Quote $quote)
    {
        if ($quote->getPayment()->getMethod() !== Cashondelivery::PAYMENT_METHOD_CASHONDELIVERY_CODE) {
            return (float)null;
        }
        $feeType =  $this->dataHelper->codFeetype();
        $codFee = $this->dataHelper->codFee();
        $this->fee = ($feeType == 0) ? ($codFee ): ($quote->getSubtotal() * ($codFee/100));
        return (float)$this->fee;
    }
    //  public function getTotal(\Magento\Quote\Model\Quote\Address\Total $total)
    // {
    //     $feeCalculation = $this->dataHelper->codCalculation();
    //     $codFee = $this->dataHelper->codFee();
    //     $subTotal = $total->getSubtotal();
    //     return $subTotal;
    // }
}

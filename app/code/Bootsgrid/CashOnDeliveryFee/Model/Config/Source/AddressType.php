<?php
/**
 * Used in creating options for Yes|No config value selection
 *
 */

namespace Bootsgrid\CashOnDeliveryFee\Model\Config\Source;

class AddressType implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
         return [
            ['value' => 'billing', 'label'=>'Billing Address'],
            ['value' => 'shipping', 'label'=>'Shipping Address']
         ];
    }
}

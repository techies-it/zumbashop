<?php
/**
 * Used in creating options for Yes|No config value selection
 *
 */

namespace Bootsgrid\CashOnDeliveryFee\Model\Config\Source;

class ShippingMethod implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
         return [
            ['value' => 0, 'label'=>'All Allowed Shipping Methods'],
            ['value' => 1, 'label'=>'Specific Shipping Methods']
         ];
    }
}

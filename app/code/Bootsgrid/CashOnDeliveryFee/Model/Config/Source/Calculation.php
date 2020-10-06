<?php
/**
 * Used in creating options for Yes|No config value selection
 *
 */

namespace Bootsgrid\CashOnDeliveryFee\Model\Config\Source;

class Calculation implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
         return [
            ['value' => 0, 'label'=>'Cart Subtotal Excluding Tax'],
            ['value' => 1, 'label'=>'Cart Subtotal Including Tax'],
         ];
    }
}

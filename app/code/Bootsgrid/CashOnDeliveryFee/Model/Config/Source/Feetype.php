<?php
/**
 * Used in creating options for Yes|No config value selection
 *
 */

namespace Bootsgrid\CashOnDeliveryFee\Model\Config\Source;

class Feetype implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
         return [
            ['value' => 0, 'label'=>'Fixed Amount'],
            ['value' => 1, 'label'=>'Percent'],
         ];
    }
}

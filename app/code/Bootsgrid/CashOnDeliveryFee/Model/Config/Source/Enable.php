<?php
/**
 * Used in creating options for Yes|No config value selection
 *
 */

namespace Bootsgrid\CashOnDeliveryFee\Model\Config\Source;

class Enable implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
         return [
            ['value' => 1, 'label'=>'Enable'],
            ['value' => 0, 'label'=>'Disable']
         ];
    }
}

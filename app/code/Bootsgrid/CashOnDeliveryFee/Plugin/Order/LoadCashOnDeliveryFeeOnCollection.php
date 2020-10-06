<?php
// declare(strict_types = 1);
namespace Bootsgrid\CashOnDeliveryFee\Plugin\Order;

use Bootsgrid\CashOnDeliveryFee\Model\Order\CashOnDeliveryFeeExtensionManagement;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\ResourceModel\Order\Collection as OrderCollection;

class LoadCashOnDeliveryFeeOnCollection
{
    /**
     * @var CashOnDeliveryFeeExtensionManagement
     */
    private $extensionManagement;

    public function __construct(CashOnDeliveryFeeExtensionManagement $extensionManagement)
    {
        $this->extensionManagement = $extensionManagement;
    }

    public function afterGetItems(OrderCollection $subject, array $orders)
    {
        return array_map(function (Order $order) {
            return $this->extensionManagement->setExtensionFromData($order);
        }, $orders);
    }
}

<?php
namespace Bootsgrid\CashOnDeliveryFee\Block\Cart;
class CustomBlock extends \Magento\Framework\View\Element\Template
{
    protected $_helper;
    protected $_registry;
    protected $_storeManager;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        array $data = [],
        \Bootsgrid\CashOnDeliveryFee\Helper\Data $helper
    ) {
        parent::__construct($context, $data);
        $this->_helper = $helper;
        $this->_storeManager=$storeManager;
         $this->_registry = $registry;
    }
    public function getCurCategory()
    {        
        return $this->_registry->registry('current_category');
    }
    public function getCurProduct()
    {        
        return $this->_registry->registry('current_product');
    }    
}

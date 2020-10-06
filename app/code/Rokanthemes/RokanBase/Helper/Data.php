<?php
/**
 * @Author: Harry - Hai Le
 * @Email: hailt1911@gmail.com
 * @File Name: Data.php
 * @File Path: 
 * @Date:   2015-04-07 19:26:42
 * @Last Modified by:   zero
 * @Last Modified time: 2015-07-28 08:35:17
 */
namespace Rokanthemes\RokanBase\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

	public function __construct(
		\Magento\Framework\App\Helper\Context $context
	) {
		parent::__construct($context);
	}
	public function getConfigData($path)
	{
		$value = $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		return $value;
	}
	public function getInstockLabel($product)
	{
		if($label = $product->getDeliveryLabel())
			return $label;
		if($label = $this->getConfigData('cataloginventory/options/delivery_label'))
			return $label;
		return __('In Stock');
	}
	public function showLableSalePrice($_product, $t = false) {
		if($_product->getTypeId() != 'simple'){
			return '';
		}
		$price = $_product->getPrice();
		$price_final = $_product->getPriceInfo()->getPrice('final_price')->getValue();
		$html = '';
		if($price && $price_final && $price_final < $price){
			$price = (float)$price;
			$price_final = (float)$price_final;
			$sale = $price - $price_final;
			$pec = ($sale / $price) * 100;
			$html = '<label>-'.round($pec).'%</label>';
			if($t){
				$html = round($pec).'%';
			}
		}
		return $html;
	}
}

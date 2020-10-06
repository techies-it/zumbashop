<?php
namespace Rokanthemes\Testimonials\Block\Adminhtml;

class Testimonials extends \Magento\Backend\Block\Widget\Grid\Container {
	
	protected function _construct() {

		$this->_controller = 'adminhtml_testimonials';
		$this->_blockGroup = 'Rokanthemes_Testimonials';
		$this->_headerText = __('Testimonials');
		$this->_addButtonLabel = __('Add New Testimonial');
		parent::_construct();
	}
}

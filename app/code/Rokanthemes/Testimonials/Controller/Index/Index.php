<?php
/**
 * ducdq@gmail.com
 */
namespace Rokanthemes\Testimonials\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }


    public function execute()
    {
        $pageFactory = $this->_resultPageFactory->create();
		
        return $pageFactory;
    }
}
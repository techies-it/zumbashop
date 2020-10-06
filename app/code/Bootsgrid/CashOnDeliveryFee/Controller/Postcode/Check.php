<?php
namespace Bootsgrid\CashOnDeliveryFee\Controller\Postcode;
use Bootsgrid\CashOnDeliveryFee\Helper\Data as DataHelper;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Check extends Action
{
    /**
     * @var ProductModel
     */
    protected $_productModel;
    /**
     * @var DataHelper
     */
    protected $_helper;
    /**
     * Check constructor.
     * @param Context $context
     * @param ProductFactory $productFactory
     * @param DataHelper $dataHelper
     */
    public function __construct(
        Context $context,
        ProductFactory $productFactory,
        DataHelper $dataHelper
    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;
        $this->dataHelper = $dataHelper;
    }
    /**
     *
     */
    public function execute()
    {
         $response = [];
         $value = $this->getRequest()->getParam('postcode');
         $postcodes = $this->dataHelper->getPostcodes();

         // $slashcode =range(...explode('/', '364001/364012'));

         // echo json_encode( $postcodes );

       $postcode = array_map('trim', explode(',', $postcodes));
        if (in_array($value, $postcode)) {
                $response['type'] = 'success';
                $response['message'] = __($this->dataHelper->getSuccessMessage(), $value);
            } else {
                $response['type'] = 'error';
                $response['message'] = __($this->dataHelper->getErrorMessage(), $value);
            }
             $this->getResponse()->setContent(json_encode($response));
    }
}
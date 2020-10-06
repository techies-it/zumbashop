<?php
// declare(strict_types = 1);
namespace Bootsgrid\CashOnDeliveryFee\Service\V1;

use Bootsgrid\CashOnDeliveryFee\Api\PaymentInformationManagementInterface;
use Bootsgrid\CashOnDeliveryFee\Plugin\CheckoutAgreements\Model\AgreementsValidator;
use Magento\Checkout\Api\PaymentInformationManagementInterface as MagentoPaymentInformationManagementInterface;
use Magento\Quote\Api\CartTotalRepositoryInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\PaymentInterface;
use Magento\Quote\Api\Data\TotalsInterface;

class PaymentInformationManagement implements PaymentInformationManagementInterface
{
    /**
     * @var MagentoPaymentInformationManagementInterface
     */
    private $paymentInformationManagement;
    /**
     * @var CartTotalRepositoryInterface
     */
    private $cartTotalRepository;
    /**
     * @var AgreementsValidator
     */
    private $agreementsValidatorSkipPlugin;

    public function __construct(
        MagentoPaymentInformationManagementInterface $paymentInformationManagement,
        CartTotalRepositoryInterface $cartTotalRepository,
        AgreementsValidator $agreementsValidatorSkipPlugin
    ) {
        $this->paymentInformationManagement = $paymentInformationManagement;
        $this->cartTotalRepository = $cartTotalRepository;
        $this->agreementsValidatorSkipPlugin = $agreementsValidatorSkipPlugin;
    }

    /**
     * @inheritdoc
     */
    public function savePaymentInformationAndGetTotals(
        $cartId,
        PaymentInterface $paymentMethod,
        AddressInterface $billingAddress = null
    ){
        // $this->agreementsValidatorSkipPlugin->setIsSkipValidation(true);

        $this->paymentInformationManagement->savePaymentInformation(
            $cartId,
            $paymentMethod,
            $billingAddress
        );

        return $this->cartTotalRepository->get($cartId);
    }
}
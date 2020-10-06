<?php
// declare(strict_types = 1);
namespace Bootsgrid\CashOnDeliveryFee\Service\V1;

use Bootsgrid\CashOnDeliveryFee\Api\GuestPaymentInformationManagementInterface;
use Bootsgrid\CashOnDeliveryFee\Plugin\CheckoutAgreements\Model\AgreementsValidator;
use Magento\Checkout\Api\GuestPaymentInformationManagementInterface as MagentoGuestPaymentManagementInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\PaymentInterface;
use Magento\Quote\Api\Data\TotalsInterface;
use Magento\Quote\Api\GuestCartTotalRepositoryInterface;

class GuestPaymentInformationManagement implements GuestPaymentInformationManagementInterface
{
    /**
     * @var MagentoGuestPaymentManagementInterface
     */
    private $guestPaymentInformationManagement;
    /**
     * @var GuestCartTotalRepositoryInterface
     */
    private $guestCartTotalRepository;
    /**
     * @var AgreementsValidator
     */
    private $agreementsValidatorSkipPlugin;

    public function __construct(
        MagentoGuestPaymentManagementInterface $guestPaymentInformationManagement,
        GuestCartTotalRepositoryInterface $guestCartTotalRepository,
        AgreementsValidator $agreementsValidatorSkipPlugin
    ) {
        $this->guestPaymentInformationManagement = $guestPaymentInformationManagement;
        $this->guestCartTotalRepository = $guestCartTotalRepository;
        $this->agreementsValidatorSkipPlugin = $agreementsValidatorSkipPlugin;
    }

    /**
     * @inheritdoc
     */
    public function savePaymentInformationAndGetTotals(
        $cartId,
        $email,
        PaymentInterface $paymentMethod,
        AddressInterface $billingAddress = null
    ){
        // $this->agreementsValidatorSkipPlugin->setIsSkipValidation(true);

        $this->guestPaymentInformationManagement->savePaymentInformation(
            $cartId,
            $email,
            $paymentMethod,
            $billingAddress
        );

        return $this->guestCartTotalRepository->get($cartId);
    }
}

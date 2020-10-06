<?php
namespace Bootsgrid\CashOnDeliveryFee\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class CodfeeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Bootsgrid\Extrafee\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Magecomp\Extrafee\Helper\Data $dataHelper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Bootsgrid\CashOnDeliveryFee\Helper\Data $dataHelper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger

    )
    {
        $this->dataHelper = $dataHelper;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $CodfeeConfig = [];
       
        $CodfeeConfig['cod_label'] = $this->dataHelper->getCodlabel();
        
        return $CodfeeConfig;
    }
}

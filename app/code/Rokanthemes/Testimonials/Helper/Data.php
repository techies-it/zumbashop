<?php
namespace Rokanthemes\Testimonials\Helper;

use Rokanthemes\Testimonials\Model\TestimonialsFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManager;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
   
    protected $_filesystem;
  
    protected $_testimonialFactory;
  
    protected $_storeManager;

    protected $_assetRepo;

    const BASE_MEDIA_PATH = 'rokanthemes/testimonials/images/';
	const ENABLE       ='testimonials_setting/group_testimonial_general/config_enable';
	const TITLE_PAGE    ='testimonials_setting/group_testimonial_general/title_page';
	const IMG_RESIZE_WIDTH    ='testimonials_setting/group_testimonial_general/img_width';
	const IMG_RESIZE_HEIGHT    ='testimonials_setting/group_testimonial_general/img_height';
    const XML_PATH_TOP_LINK = 'testimonials_setting/group_testimonial_general/config_toplink';
	const XML_PATH_FOOTER_LINK = 'testimonials_setting/group_testimonial_general/config_footerlink';
    const XML_PATH_SIDE_BAR = 'testimonials_setting/group_testimonial_general/config_sidabar';
    const XML_PATH_PAGING = 'testimonials_setting/group_testimonial_general/config_paging';
    const XML_PATH_AMOUNT_WORD = 'testimonials_setting/group_testimonial_general/config_amount_word';
    const XML_PATH_CAPTCHA = 'testimonials_setting/group_testimonial_configuration/config_captcha';
    const XML_PATH_PER_PAGE = 'testimonials_setting/group_testimonial_general/config_per_page';
    const XML_PATH_ALLOW_CUSTOMER_SUBMIT = 'testimonials_setting/group_testimonial_configuration/config_allow_customer_submit';
	const XML_PATH_ALLOW_GUEST_SUBMIT = 'testimonials_setting/group_testimonial_configuration/config_allow_guest_submit';
    const XML_PATH_MESSAGE_THANKYOU = 'testimonials_setting/group_testimonial_configuration/config_thank_you_message';
    const XML_PATH_APPROVE = 'testimonials_setting/group_testimonial_configuration/config_approve';
    const XML_PATH_SUBMIT_EMAIL = 'testimonials_setting/group_testimonial_email_configuration/config_send_email_after_approved';
    const XML_PATH_APPROVE_EMAIL = 'testimonials_setting/group_testimonial_email_configuration/config_send_email_after_post';
    
    public function __construct(
        Context $context,
        Filesystem $filesystem,
        TestimonialsFactory $testimonial,
        StoreManager $storeManager,
        \Magento\Framework\View\Asset\Repository $assetRepo
    )
    {
        $this->_storeManager = $storeManager;
        $this->_testimonialFactory = $testimonial;
        $this->_filesystem = $filesystem;
        $this->_assetRepo = $assetRepo;
        parent::__construct($context);
    }

   public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }
	  public function getImgRizeWidth()
    {
        return $this->scopeConfig->getValue(
            self::IMG_RESIZE_WIDTH,
            ScopeInterface::SCOPE_STORE
        );
    }
	 public function getImgRizeHeight()
    {
        return $this->scopeConfig->getValue(
            self::IMG_RESIZE_HEIGHT,
            ScopeInterface::SCOPE_STORE
        );
    }
	
   public function getTitlePage()
    {
        return $this->scopeConfig->getValue(
            self::TITLE_PAGE,
            ScopeInterface::SCOPE_STORE
        );
    }
    public function isEnabledInTopLink()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_LINK,
            ScopeInterface::SCOPE_STORE
        );
    }

	public function isEnabledInFooterLink()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_LINK,
            ScopeInterface::SCOPE_STORE
        );
    }
    public function isEnabledInSidebar()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SIDE_BAR,
            ScopeInterface::SCOPE_STORE
        );
    }

   
    public function isEnabledInPaging()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PAGING,
            ScopeInterface::SCOPE_STORE
        );
    }

   
    public function getAmountWord()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_AMOUNT_WORD,
            ScopeInterface::SCOPE_STORE
        );
    }

   
    public function getPerPage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PER_PAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    
    public function isAllowCustomerSubmit()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ALLOW_CUSTOMER_SUBMIT,
            ScopeInterface::SCOPE_STORE
        );
    }
    
	 public function isAllowGuestSubmit()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ALLOW_GUEST_SUBMIT,
            ScopeInterface::SCOPE_STORE
        );
    }
   
    public function getMessageThankYou()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MESSAGE_THANKYOU,
            ScopeInterface::SCOPE_STORE
        );
    }
    
   
    public function isCaptcha()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CAPTCHA,
            ScopeInterface::SCOPE_STORE
        );
    }

   
    public function isApprove() {
        return $this->scopeConfig->getValue(
            self::XML_PATH_APPROVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function isApproveEmail() {
        return $this->scopeConfig->getValue(
            self::XML_PATH_APPROVE_EMAIL,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function isSubmitEmail() {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SUBMIT_EMAIL,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function setStoreId($store)
    {
        $this->_storeId = $store;
        return $this;
    }
}
<?php
 /**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */
 
namespace Mageants\Shippingtracker\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
 
use Magento\Framework\App\Action\Context;
 
class TrackingDetails extends \Magento\Framework\App\Action\Action
{   
    /** @var \Magento\Framework\View\Result\LayoutFactor */
    protected $_shippingTracker;

    /** 
     *  @var   \Magento\Framework\App\Action\Context::url()
     */
    protected $_url;

    /** 
     *  @var   \Magento\Framework\App\Action\Context::request()
     */
    protected $_request;

    /** 
     *  @var   \Magento\Shipping\Helper\Data
     */
    protected $_helper;


    /** 
     *  @param    \Magento\Framework\App\Action\Context $context
     *  @param   \Mageants\Shippingtracker\Block\Shippingtracker $shippingtracker
     *  @param   \Magento\Shipping\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Mageants\Shippingtracker\Block\Shippingtracker $shippingtracker,
        \Magento\Shipping\Helper\Data $helper
    )
    {
        $this->_url = $context->getUrl();
        $this->_shippingTracker = $shippingtracker;
        $this->_request = $context->getRequest();
        $this->_helper  = $helper;
        parent::__construct($context);

    }
    /**
     * Shippingtracker Page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
      $trackingDetails = $this->_shippingTracker->getOrderdetails($this->_request->getPost('orderid'),$this->_request->getPost('email'));
      $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
      if(array_key_exists('tracking_error_message', $trackingDetails)){
        return $resultJson->setData($trackingDetails);
        
      }
      $details = array('status'=>$trackingDetails->getStatus(), 'id'=>$trackingDetails->getId(), 'tracking_count'=>$trackingDetails->getTracksCollection()->count(), 'email'=>$this->_request->getPost('email'), 'trackingurl'=>$this->_url->getUrl("sales/order/view/order_id/".$trackingDetails->getId().""), 'shippingurl'=>$this->_helper->getTrackingPopupUrlBySalesModel($trackingDetails));
      return  $resultJson->setData($details);
      
    }

}
<?php
/**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */

namespace Mageants\Shippingtracker\Block;
 
class Shippingtracker extends \Magento\Framework\View\Element\Template
{
   /** @var \Magento\Sales\Model\Order */    
   protected $orders;
   /** @var \Magento\Framework\Message\ManagerInterface */ 
   protected $_messageManager;

   /** 
    * @param \Magento\Framework\View\Element\Template\Context $context 
    * @param \Magento\Sales\Model\Order $order
    * @param \Magento\Framework\Message\ManagerInterface $messageManager
    */

   public function __construct(
	  \Magento\Framework\View\Element\Template\Context $context, 
    \Magento\Sales\Model\Order $order,
    \Magento\Framework\Message\ManagerInterface $messageManager,
	  array $data = []
	) {
	    $this->order = $order;
      $this->_messageManager = $messageManager;
	    parent::__construct($context, $data);        
	}

    /**
     * @return bool|\Magento\Sales\Model\ResourceModel\Order\Collection
    */

    public function getOrderdetails($orderId=null, $email=null) { 

    
    if($orderId && $email) {

    $orderdetails=$this->order->loadByIncrementId($orderId);

      if($email == $orderdetails->getCustomerEmail() && $orderdetails['entity_id']!='')
      {
        return $orderdetails;
      }
      else
      {
        return array("tracking_error_message"=>'Order # '.$orderId.' not found.');
      }

    }
  }


}
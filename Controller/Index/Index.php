<?php
 /**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */
 
namespace Mageants\Shippingtracker\Controller\Index;
 
use Magento\Framework\App\Action\Context;
 
class Index extends \Magento\Framework\App\Action\Action
{   
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;

    /**
    * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
    */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

    }
    /**
     * Shippingtracker Page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {

        if($this->_objectManager->create('Mageants\Shippingtracker\Helper\Data')->getConfig('shippingtracker_section/shippingtracker_general/shippingtracker_enable') == 0){
             return $this->_forward('index', 'noroute', 'cms');
        }

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }

}
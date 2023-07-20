<?php

namespace Nttdata\Practice\Controller\Product;

class Productlist extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    private \Nttdata\Practice\Helper\Data $helper;

    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Nttdata\Practice\Helper\Data              $helper)
    {
        $this->_pageFactory = $pageFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function execute()
    {
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set(__($this->helper->getTranslateStringAndTime()));
        return $pageFactory;
    }
}

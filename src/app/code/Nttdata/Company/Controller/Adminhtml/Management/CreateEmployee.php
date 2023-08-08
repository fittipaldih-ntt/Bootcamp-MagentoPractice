<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Magento\Framework\App\Action\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class CreateEmployee extends Action
{
    protected $resultPageFactory = false;

    public function __construct(
        Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Create new employee')));
        return $resultPage;
    }
}

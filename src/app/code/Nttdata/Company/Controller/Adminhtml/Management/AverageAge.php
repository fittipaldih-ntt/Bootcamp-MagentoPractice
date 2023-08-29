<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class AverageAge extends Action
{
    protected $employeesDataProvider;

    public function __construct(
        Context $context,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $averageAge = (int)$this->_getSession()->getData('averageAge');

        if ($averageAge > 0) {
            $this->messageManager->addSuccessMessage(__('Total employees average age: ' . $averageAge));
            $this->_getSession()->unsetData('averageAge');
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
}
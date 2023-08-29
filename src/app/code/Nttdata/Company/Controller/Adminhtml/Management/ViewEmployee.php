<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Nttdata\Company\Model\Employee;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class ViewEmployee extends Action
{
    protected $resultPageFactory;
    protected $employeeFactory;
    protected $logger;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Employee $employeeFactory,
        LoggerInterface $logger
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->employeeFactory = $employeeFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (!$id) {
            $this->messageManager->addErrorMessage(__('Unable to find a employee to view.'));
            return $this->_redirect('*/*/');
        }

        try {
            $model = $this->employeeFactory->load($id);
            if (!$model->getId()) {
                throw new \Exception(__('Employee with ID %1 does not exist.', $id));
            }
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('View employee')));
            return $resultPage;
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
          //$this->messageManager->addExceptionMessage($e, __('An error occurred.'));
            return $this->_redirect('*/*/');
        }
    }
}

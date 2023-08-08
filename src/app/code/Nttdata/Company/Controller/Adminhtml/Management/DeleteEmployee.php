<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Nttdata\Company\Model\Employee;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class DeleteEmployee extends Action
{
    protected $employee;
    
    public function __construct(Context $context, Employee $employee)
    {
        $this->employee = $employee;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (!$id) {
            $this->messageManager->addErrorMessage(__('Unable find a employee to delete.'));
            return $this->_redirect('*/*/');
        }
        try {
            $model = $this->employee->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('Employee has been deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Error occurred. Not delete the employee.'));
        }
        return $this->_redirect('*/*/');
    }
}
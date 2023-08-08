<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Nttdata\Company\Model\EmployeeFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Nttdata\Company\Model\ResourceModel\Employee\CollectionFactory;

class SaveEmployee extends Action
{
    protected $resultPageFactory;
    protected $employeeFactory;
    protected $formKeyValidator;
    protected $employeeCollectionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        EmployeeFactory $employeeFactory,
        CollectionFactory $employeeCollectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->employeeFactory = $employeeFactory;
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultPageFactory = $this->resultRedirectFactory->create();

        try {
            $isNewEmployee = empty($data['id']);

            if ($isNewEmployee) {
                unset($data['id']);
            }

            $model = $this->employeeFactory->create();
            $model->setData($data);
            $model->save();

            if (!$isNewEmployee) {
                $collection = $this->employeeCollectionFactory->create();
                $collection->addFieldToFilter('id', $data['id']);
            }

            $this->messageManager->addSuccessMessage(__("Employee Saved Successfully."));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __("Please try again."));
        }
        return $resultPageFactory->setPath('*/*/');
    }
}

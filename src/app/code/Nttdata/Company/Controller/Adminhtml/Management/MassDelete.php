<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Nttdata\Company\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
{
    protected $resultPageFactory;
    protected $employeesFactory;
    protected $filter;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Filter $filter,
        CollectionFactory $employeesFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->employeesFactory = $employeesFactory;
        $this->filter = $filter;
    }

    public function execute()
    {
        $collection = $this->employeesFactory->create();
        $selected = $this->getRequest()->getParam('selected');
        $excluded = $this->getRequest()->getParam('excluded');

        try {
            $this->deleteEmployees($collection, $selected, $excluded);
            $this->addSuccessMessage($selected, $excluded);
        } catch (LocalizedException $e) {
            $this->addErrorMessage($e->getMessage());
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }

    protected function deleteEmployees($collection, $selected, $excluded)
    {
        if (!empty($excluded) && $excluded == "false") {
            $collection->walk('delete');
        } elseif (!empty($selected)) {
            $collection->addFieldToFilter('id', ['in' => $selected]);
            $collection->walk('delete');
        } else {
            throw new LocalizedException(__('No employees selected.'));
        }
    }

    protected function addSuccessMessage($selected, $excluded)
    {
        if (!empty($excluded) && $excluded == "false") {
            $this->messageManager->addSuccessMessage(__('Employees deleted.'));
        } elseif (!empty($selected)) {
            $count = count($selected);
            $this->messageManager->addSuccessMessage(__('%1 employees deleted.'), $count);
        }
    }

    protected function addErrorMessage($message)
    {
        $this->messageManager->addErrorMessage($message);
    }
}

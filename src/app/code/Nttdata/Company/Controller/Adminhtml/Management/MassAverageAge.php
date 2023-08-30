<?php

namespace Nttdata\Company\Controller\Adminhtml\Management;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Exception\LocalizedException;
use Nttdata\Company\Model\ResourceModel\Employee\CollectionFactory;

class MassAverageAge extends Action
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
            $averageAge = $this->calculateAverageAge($collection, $selected, $excluded);
            $this->addSuccessMessage($averageAge);
        } catch (LocalizedException $e) {
            $this->addErrorMessage($e->getMessage());
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }

    protected function calculateAverageAge($collection, $selected, $excluded)
    {
        if (!empty($excluded) && $excluded == "false") {
            $employees = $collection->getItems();
        } elseif (!empty($selected)) {
            $collection->addFieldToFilter('id', ['in' => $selected]);
            $employees = $collection->getItems();
        } else {
            throw new LocalizedException(__('No employees selected.'));
        }

        $totalAge = 0;
        $totalCount = count($employees);

        foreach ($employees as $employee) {
            $totalAge += $employee->calculateAge();
        }

        return $totalCount > 0 ? $totalAge / $totalCount : 0;
    }

    protected function addSuccessMessage($averageAge)
    {
        $this->messageManager->addSuccessMessage(__('Selected employees average age: ') . (int)($averageAge));
    }

    protected function addErrorMessage($message)
    {
        $this->messageManager->addErrorMessage($message);
    }
}

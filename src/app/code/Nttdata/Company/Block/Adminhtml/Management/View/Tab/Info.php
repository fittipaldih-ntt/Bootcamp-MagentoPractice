<?php

namespace Nttdata\Company\Block\Adminhtml\Management\View\Tab;

use Nttdata\Company\Service\EmployeeData;
use \Magento\Backend\Block\Template\Context;
use \Magento\Backend\Block\Template;

class Info extends Template
{
    protected $employeeData;

    public function __construct(
        Context $context,
        EmployeeData $employeeData,
        array $data = []
    ) {
        $this->employeeData = $employeeData;
        parent::__construct($context, $data);
    }

    public function getEmployeeData()
    {
        $employeeId     = $this -> getRequest() -> getParam('id');
        $employeeData   = $this -> employeeData -> getEmployeeData($employeeId);

        return $employeeData;
    }
}
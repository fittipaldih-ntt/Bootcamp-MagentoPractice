<?php

namespace Nttdata\Company\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Employee extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('nttdata_company_employee', 'id');

    }
    
}

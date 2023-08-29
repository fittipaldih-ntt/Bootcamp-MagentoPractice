<?php

namespace Nttdata\Company\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nttdata\Company\Model\Employee as EmployeeModel;
use Nttdata\Company\Model\ResourceModel\Employee as EmployeeResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(EmployeeModel::class, EmployeeResourceModel::class);
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['sector' => $this->getTable('nttdata_company_sector_employee')],
            'main_table.idsector = sector.id',
            ['sectordescription' => 'description'] 
        );

        $this->getSelect()->joinLeft(
            ['type' => $this->getTable('nttdata_company_type_employee')],
            'main_table.idtype = type.id',
            ['typedescription' => 'description']
        );

        $this->getSelect()->joinLeft(
            ['socialwork' => $this->getTable('nttdata_company_socialwork_employee')],
            'main_table.idsocialwork = socialwork.id',
            ['socialworkdescription' => 'description',
            'socialworkplan' => 'plan' ]
        );

        $this->addFilterToMap('id', 'main_table.id');
        $this->addFilterToMap('sectordescription', 'sector.description');
        $this->addFilterToMap('typedescription', 'type.description');
        $this->addFilterToMap('socialworkdescription', 'socialwork.description');
        $this->addFilterToMap('socialworkplan', 'socialwork.plan');
    }
    
}

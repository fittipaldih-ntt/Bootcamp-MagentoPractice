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
            'main_table.id_sectorEmployee = sector.id',
            ['sector_description' => 'description'] 
        );

        $this->getSelect()->joinLeft(
            ['type' => $this->getTable('nttdata_company_type_employee')],
            'main_table.id_typeEmployee = type.id',
            ['type_description' => 'description']
        );
        $this->addFilterToMap('id', 'main_table.id');
        $this->addFilterToMap('sector_description', 'sector.description');
        $this->addFilterToMap('type_description', 'type.description');
    }
    
}

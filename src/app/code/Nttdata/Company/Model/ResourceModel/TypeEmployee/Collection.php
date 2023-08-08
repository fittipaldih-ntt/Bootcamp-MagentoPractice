<?php

namespace Nttdata\Company\Model\ResourceModel\TypeEmployee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nttdata\Company\Model\ResourceModel\TypeEmployee as TypeEmployeeResourceModel;
use Nttdata\Company\Model\TypeEmployee as TypeEmployeeModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'nttdata_company_sectoremployee_collection';
    protected $_eventObject = 'typeemployee_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TypeEmployeeModel::class, TypeEmployeeResourceModel::class);
    }
}

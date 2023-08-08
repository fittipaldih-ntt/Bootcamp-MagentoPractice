<?php

namespace Nttdata\Company\Model\ResourceModel\SectorEmployee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nttdata\Company\Model\ResourceModel\SectorEmployee as SectorEmployeeResourceModel;
use Nttdata\Company\Model\SectorEmployee as SectorEmployeeModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'nttdata_company_sectoremployee_collection';
    protected $_eventObject = 'sectoremployee_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SectorEmployeeModel::class, SectorEmployeeResourceModel::class);
    }
}

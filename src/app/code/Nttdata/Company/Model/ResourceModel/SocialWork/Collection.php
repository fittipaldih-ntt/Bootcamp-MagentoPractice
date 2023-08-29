<?php

namespace Nttdata\Company\Model\ResourceModel\SocialWork;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nttdata\Company\Model\ResourceModel\SocialWork as ResourceModel;
use Nttdata\Company\Model\SocialWork as Model;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'nttdata_company_socialwork_collection';
    protected $_eventObject = 'socialwork_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

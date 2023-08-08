<?php
namespace Nttdata\Company\Model;

use Magento\Framework\Model\AbstractModel;

class SectorEmployee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Nttdata\Company\Model\ResourceModel\SectorEmployee::class);
    }
}

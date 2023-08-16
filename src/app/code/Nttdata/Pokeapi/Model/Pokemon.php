<?php

namespace Nttdata\Pokeapi\Model;

use Magento\Framework\Model\AbstractModel;
use Nttdata\Pokeapi\Model\ResourceModel\Pokemon as ResourceModel;

class Pokemon extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}

<?php

namespace Nttdata\Pokeapi\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pokemon extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('nttdata_pokeapi_pokemon', 'id');

    }
    
}

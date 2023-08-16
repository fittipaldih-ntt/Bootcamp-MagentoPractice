<?php

namespace Nttdata\Pokeapi\Model\ResourceModel\Pokemon;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Nttdata\Pokeapi\Model\Pokemon as Model;
use Nttdata\Pokeapi\Model\ResourceModel\Pokemon as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Model::class,
            ResourceModel::class
        );
    } 
}
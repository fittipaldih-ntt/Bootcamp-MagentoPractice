<?php

namespace Nttdata\Practice\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    private Data $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }
    public function newFunction()
    {
        $this->helper->getStoreConfig();
    }
    public function getStoreConfig()
    {
        return true;
    }
}

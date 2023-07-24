<?php

namespace Nttdata\Practice\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    const ROUTE_SYSTEM = 'nttdata_practice/params/';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue($config_path);
    }

    public function getEnabled()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'enabled');
    }
    public function getLimit()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'limit');
    }

    public function getOrderField()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'order_field');
    }

    public function getOrderDirection()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'order_direction');
    }

    public function getTranslateStringAndTime()
    {
        return __("Now being the %1, I am learning translations", $this->getCurrentTime());
    }

    private function getCurrentTime()
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hour = date('H:i:s');
        return $hour;
    }
}

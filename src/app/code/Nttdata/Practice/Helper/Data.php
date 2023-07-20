<?php

namespace Nttdata\Practice\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);
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

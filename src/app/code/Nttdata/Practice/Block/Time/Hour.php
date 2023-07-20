<?php
namespace Nttdata\Practice\Block\Time;

use Magento\Framework\View\Element\Template;

class Hour extends Template
{
    private \Nttdata\Practice\Helper\Data $helper;
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,  \Nttdata\Practice\Helper\Data $helper)
    {
        parent::__construct($context);
        $this->helper = $helper;
    }

    public function getTranslate(){
        return $this->helper->getTranslateStringAndTime();
    }

}


<?php
namespace Nttdata\Practice\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function welcome()
    {
        return '¡Bienvenido al Primer módulo (Practice) de NTT Data!';
    }
}

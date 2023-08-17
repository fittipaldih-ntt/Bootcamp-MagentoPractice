<?php

namespace Nttdata\Pokeapi\Controller\Pokemon;

class Pokemonlist extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct
    (
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;;
        parent::__construct($context);
    }

    public function execute()
    {
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set('Pokémon API');
        return $pageFactory;
    }
}
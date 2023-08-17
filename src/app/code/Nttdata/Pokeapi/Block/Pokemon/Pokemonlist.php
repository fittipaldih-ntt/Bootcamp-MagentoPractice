<?php

namespace Nttdata\Pokeapi\Block\Pokemon;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Nttdata\Pokeapi\Service\PokemonData;

class Pokemonlist extends Template
{
    protected $storeManager;
    protected $pokemonDataService;

    public function __construct(
        Context $context,
        PokemonData $pokemonDataService,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->pokemonDataService = $pokemonDataService;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function storeChecked(){
        if($this->getStoreCode() !== 'Pokemon'){
            return null;
        }
        else {
            return $this->getPokemonSelectedData(); 
        }
    }

    public function getPokemonSelectedData()
    {
        return $this->pokemonDataService->getPokemonSelectedData();
    }

    /**
     * Get Store code
     *
     * @return string
     */
    protected function getStoreCode()
    {
        return $this->storeManager->getStore()->getCode();
    }

    /**
     * Get store identifier
     *
     * @return  int
     */
    protected function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * Get website identifier
     *
     * @return string|int|null
     */
    protected function getWebsiteId()
    {
        return $this->storeManager->getStore()->getWebsiteId();
    }

    /**
     * Get Store name
     *
     * @return string
     */
    protected function getStoreName()
    {
        return $this->storeManager->getStore()->getName();
    }

    /**
     * Get current url for store
     *
     * @param bool|string $fromStore Include/Exclude from_store parameter from URL
     * @return string     
     */
    protected function getStoreUrl($fromStore = true)
    {
        return $this->storeManager->getStore()->getCurrentUrl($fromStore);
    }

    /**
     * Check if store is active
     *
     * @return boolean
     */
    protected function isStoreActive()
    {
        return $this->storeManager->getStore()->isActive();
    }
}

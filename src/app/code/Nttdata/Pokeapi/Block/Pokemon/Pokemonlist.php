<?php

namespace Nttdata\Pokeapi\Block\Pokemon;

use Nttdata\Pokeapi\Service\PokemonData;
use Magento\Framework\View\Element\Template;

class Pokemonlist extends Template
{
    protected $pokemonDataService;
    
    public function __construct(
        Template\Context $context,
        PokemonData $pokemonDataService,
        array $data = []
    ) {
        $this->pokemonDataService = $pokemonDataService;
        parent::__construct($context, $data);
    }

    public function getPokemonSelectedData()
    // Me trae la data seleccionada para la vista
    {
        return $this->pokemonDataService->getPokemonSelectedData();
    }
}

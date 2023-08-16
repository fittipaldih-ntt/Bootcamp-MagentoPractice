<?php

namespace Nttdata\Pokeapi\Cron;

use Nttdata\Pokeapi\Service\PokemonData;
use Nttdata\Pokeapi\Model\PokemonFactory;
use Nttdata\Pokeapi\Model\ResourceModel\Pokemon\Collection;
use Psr\Log\LoggerInterface;

class SavePokemon
{
    protected PokemonData $pokemonData;
    protected PokemonFactory $pokemonFactory;
    protected Collection $pokemonCollection;
    protected LoggerInterface $logger;

    public function __construct(
        PokemonData $pokemonData,
        PokemonFactory $pokemonFactory,
        Collection $pokemonCollection,
        LoggerInterface $logger
    ) {
        $this->pokemonData = $pokemonData;
        $this->pokemonFactory = $pokemonFactory;
        $this->pokemonCollection = $pokemonCollection;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            $limit = 50;
            $pokemonArray = $this->pokemonData->getPokemonSelectedData($limit);
            $firstTypes = $this->getFirstPokemonTypes($pokemonArray);

            foreach ($pokemonArray as $index => $pokemon) {

                $model = $this->pokemonFactory->create();
                $namesOfGenerations =  array_keys($pokemon['generations']);

                $model->setData('name', $pokemon['name']);
                $model->setData('image', $pokemon['image']);
                $model->setData('types', $firstTypes[$index]['name']);
                $model->setData('generations', end( $namesOfGenerations));
                $model->setData('regions', end($pokemon['regions']));

                $model->save();
            }
            $this->logger->info('Pokemon saved successfully.');
        } catch (\Exception $e) {
            $this->logger->error('Error saving pokemon: ' . $e->getMessage());
        }
    }

    protected function getFirstPokemonTypes($pokemonArray)
    {
        $types = [];

        foreach ($pokemonArray as $pokemon) {
            if (!empty($pokemon['types'][0])) {
                $types[] = $pokemon['types'][0];
            }
        }
        return $types;
    }

}

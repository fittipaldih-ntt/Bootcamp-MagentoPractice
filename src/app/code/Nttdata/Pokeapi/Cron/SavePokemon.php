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
            $pokemonArray = $this->pokemonData->getPokemonSelectedData();
            $firstTypes = $this->getFirstPokemonTypes($pokemonArray);
            $existingPokemonIds = $this->getExistingPokemonNames();
            $loadedCount = $this->processNewPokemon($pokemonArray, $firstTypes, $existingPokemonIds);

            $this->logger->info($loadedCount . ' Pokémon saved successfully.');
        } catch (\Exception $e) {
            $this->logger->error('Error saving Pokémon: ' . $e->getMessage());
        }
    }

    protected function processNewPokemon($pokemonArray, $firstTypes, $existingPokemonIds)
    {
        $loadedCount = 0;

        foreach ($pokemonArray as $index => $pokemon) {
            if ($loadedCount >= 50) {
                break;
            }

            if (!in_array($pokemon['id'], $existingPokemonIds)) {
                $this->savePokemon($pokemon, $firstTypes[$index]);
                $loadedCount++;
            }
        }

        return $loadedCount;
    }

    protected function savePokemon($pokemon, $type)
    {
        $model = $this->pokemonFactory->create();
        $namesOfGenerations = array_keys($pokemon['generations']);

        $model->setData('name', $pokemon['name']);
        $model->setData('image', $pokemon['image']);
        $model->setData('types', $type['name']);
        $model->setData('generations', end($namesOfGenerations));
        $model->setData('regions', end($pokemon['regions']));

        $model->save();
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

    protected function getExistingPokemonNames()
    {
        // Me fijo los pokemones ya cargados para evitar que se dupliquen en la BD
        return $this->pokemonCollection->getColumnValues('name');
    }
}

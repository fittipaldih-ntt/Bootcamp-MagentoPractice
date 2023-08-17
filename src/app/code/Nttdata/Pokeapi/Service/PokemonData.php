<?php

namespace Nttdata\Pokeapi\Service;

use Nttdata\Pokeapi\Helper\Data;
use Nttdata\Pokeapi\Service\ApiService;


class PokemonData{

    private $apiService;
    protected $helper;

    public function __construct(
        ApiService $apiService,
        Data $helper,
    ) {
        $this->apiService = $apiService;
        $this->helper = $helper;
    }

    public function getPokemonList($limit = 50): array
    // Me trae la lista de todos los pokemones, Name y URL con atributos
    // Le paso limit harcodeado para evitar que tarde tanto en cargar a todos
    {
        $url = $this->helper->getUrl();
        $endp = $this->helper->getEndpoint();
        $finallyUrl = $url . $endp . '/' . '?limit=' . $limit;
        $response = $this->apiService->doRequest($finallyUrl);
        $responseContent = $response->getBody()->getContents();
        return json_decode($responseContent, true);
    }

    public function getPokemonFullData(): array
    // Me trae la data completa de cada poke, 
    // incluyendo la información adicional, esto seria entrando a la URL del primer JSON
    {
        $pokemonUrls = $this->getPokemonUrls();
        $pokemonFullData = [];

        foreach ($pokemonUrls as $url) {
            $response = $this->apiService->doRequest($url);
            $responseContent = $response->getBody()->getContents();
            $pokemonInfo = json_decode($responseContent, true);
            $pokemonFullData[] = $pokemonInfo;
        }

        return $pokemonFullData;
    }

    public function getPokemonSelectedData()
    // Me trae toda la data que necesito de todos los pokemones (incluyendo el nombre que esta en el primer JSON)
    // OJO que antes de devolverlo los filtra por los seleccionados
    {
        $names = $this->getPokemonName();
        $data = $this->getPokemonFullData();
        $images = $this->getPokemonImages($data);
        $types = $this->getPokemonTypes($data);
        $generations = $this->getPokemonGenerations($data);
        $regions = $this->getPokemonRegions($data);

        return $this->getFilteredPokemonData($names, $data, $images, $types, $generations, $regions);
    }

    public function getFilteredPokemonData($names, $data, $images, $types, $generations, $regions)
    {
        // filtra por el rango seleccionado en el panel admin, traigo esa info del helper
        $pokemon = [];
        $rangeFrom = $this->helper->getRangeFrom();
        $rangeTo = $this->helper->getRangeTo();
        
        foreach ($names as $i => $name) {
            $id = $data[$i]['id'];

            if ($id >= $rangeFrom && $id <= $rangeTo) {
                $pokemon[] = [
                    'name' => $name,
                    'image' => $images[$i],
                    'id' => $id,
                    'types' => $types[$i],
                    'generations' => $generations[$i],
                    'regions' => $regions[$i],
                ];
            }
        }
        return $pokemon;
    }

    public function getPokemonName(): array
    // Me trae del primer API, solo NOMBRES
    {
        $pokemonList = $this->getPokemonList();

        $pokemonName = [];
        foreach ($pokemonList['results'] as $pokemon) {
            $pokemonName[] = $pokemon['name'];
        }
        return $pokemonName;
    }

    public function getPokemonUrls(): array
    // Me trae del primer API, solo URL con atributos
    {
        $pokemonList = $this->getPokemonList();
        $pokemonUrls = [];

        foreach ($pokemonList['results'] as $pokemon) {
            $pokemonUrls[] = $pokemon['url'];
        }
        return $pokemonUrls;
    }

    public function getPokemonImages($data)
    {
        $images = [];

        foreach ($data as $item) {
            $images[] = $item['sprites']['other']['official-artwork']['front_default'];
        }
        return $images;
    }

    public function getPokemonIds($data)
    {
        $ids = [];

        foreach ($data as $item) {
            $ids[] = $item['id'];
        }
        return $ids;
    }

    public function getPokemonTypes($data)
    {
        $types = [];

        foreach ($data as $item) {
            $types[] = array_column($item['types'], 'type');
        }

        return $types;
    }

    public function getPokemonGenerations($data)
    {
        $generations = [];

        foreach ($data as $item) {
            $generations[] = $item['sprites']['versions'];
        }
        return $generations;
    }

    public function getPokemonRegions($data)
    {
        $regionsList = [];

        foreach ($data as $item) {
            $regions = [];
            $encountersUrl = $item['location_area_encounters'];

            if ($encountersUrl) {
                $encountersData = $this->helper->fetchDataFromUrl($encountersUrl);
                foreach ($encountersData as $encounter) {
                    $regions[] = $encounter['location_area']['name'];
                }
            }
            $regionsList[] = $regions;
        }
        return $regionsList;
    }
}
<?php

namespace Nttdata\Pokeapi\Block\Pokemon;

use Nttdata\Pokeapi\Service\ApiService;
use Nttdata\Pokeapi\Helper\Data;
use Magento\Framework\View\Element\Template;

class Pokemonlist extends Template
{
    private $apiService;
    protected $helper;
    protected $urlApi;

    public function __construct(
        Template\Context $context,
        ApiService $apiService,
        Data $helper,
        array $data = []
    ) {
        $this->apiService = $apiService;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    public function getPokemonList(): array
    // Me trae la lista de todos los pokemones, Name y URL con atributos
    {
        $url = $this->helper->getUrl();
        $endp = $this->helper->getEndpoint();
        // esto era para limitar los pokes y verificar limit
        // $limit = $this->helper->getLimit();
        // $this->verifyLimitParameter($url . $endp , $limit);
        $limit = '?limit=151';
        $response = $this->apiService->doRequest($url . $endp . $limit);
        $responseContent = $response->getBody()->getContents();
        return json_decode($responseContent, true);
    }
    /*
    private function verifyLimitParameter(string $url, int $limit): string
    // Verificamos si la URL ya contiene el LIMIT
    {
        if (strpos($url, 'limit=') === false) {
            return $this->addLimitParameter($url, $limit);
        } else {
            return $this->replaceLimitParameter($url, $limit);
        }
    }

    private function addLimitParameter(string $url, int $limit): string
    // Si no lo contiene, se lo agregamos 
    {
        return (strpos($url, '?') !== false) ? $url . '&' . 'limit=' . $limit : $url . '?' . 'limit=' . $limit;
    }

    private function replaceLimitParameter(string $url, int $limit): string
    // Si ya lo contiene, lo reemplazamos por el elegido en la configuracion
    {
        return preg_replace('/limit=\d+/', 'limit=' . $limit, $url);
    }
    */
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
        $selectedData = [];
        $rangeFrom = $this->helper->getRangeFrom();
        $rangeTo = $this->helper->getRangeTo();

        foreach ($names as $i => $name) {
            $id = $data[$i]['id'];

            if ($id >= $rangeFrom && $id <= $rangeTo) {
                $selectedData[] = [
                    'name' => $name,
                    'image' => $images[$i],
                    'id' => $id,
                    'types' => $types[$i],
                    'generations' => $generations[$i],
                    'regions' => $regions[$i],
                ];
            }
        }

        return $selectedData;
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

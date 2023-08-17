<?php

declare(strict_types=1);

namespace Nttdata\Pokeapi\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;

class ApiService
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    private $clientFactory;

    /**
     * ApiService constructor
     *
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Generic API request
     *
     * @param string $requestUri
     * @param string $requestMethod
     * @param array $params
     *
     * @return Response
     */
    public function doRequest(
        string $requestUri,
        string $requestMethod = Request::HTTP_METHOD_GET,
        array $params = []
    ): Response {
        /** @var Client $client */
        $client = $this->clientFactory->create();

        try {
            $response = $client->request(
                $requestMethod,
                $requestUri,
                $params
            );
        } catch (GuzzleException $exception) {
            /** @var Response $response */
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }
        return $response;
    }
}

<?php

namespace Nttdata\Pokeapi\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;
use Magento\Framework\HTTP\Client\Curl;

class Data extends AbstractHelper
{

    const ROUTE_SYSTEM = 'nttdata_pokemon/paramers/';
    protected $curl;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        ScopeConfigInterface $scopeConfig,
        Curl $curl
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->curl = $curl;
        parent::__construct($context);
    }

    public function getConfig($path)
    {
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getRangeFrom()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'range_from');
    }

    public function getRangeTo()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'range_to');
    }

    public function getUrl()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'url');
    }

    public function getLimit()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'limits');
    }

    public function getEndpoint()
    {
        return $this->getConfig(self::ROUTE_SYSTEM . 'endpoint');
    }

    public function fetchDataFromUrl($url)
    {
        $this->curl->get($url);
        $response = $this->curl->getBody();

        return json_decode($response, true);
    }
}

<?php

namespace Nttdata\Pokeapi\Service;

class CreateTesting
{

    protected $_logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }
    public function execute()
    {
        $this->_logger->info('Testing primer cron');
        var_dump('HELLO WORLD?');
        return $this;
    }
    
}

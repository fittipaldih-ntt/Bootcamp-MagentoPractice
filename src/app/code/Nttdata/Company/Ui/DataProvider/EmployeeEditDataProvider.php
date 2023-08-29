<?php

namespace Nttdata\Company\Ui\DataProvider;

use Nttdata\Company\Model\ResourceModel\Employee\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;

class EmployeeEditDataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     * 
     * @return array
     */
    public function getData()
    {
        $items = $this->collection->getItems();
        $data = [];
        foreach ($items as $employee) {
            $data[$employee->getId()] = $employee->getData();
        }
        return $data;
    }
}

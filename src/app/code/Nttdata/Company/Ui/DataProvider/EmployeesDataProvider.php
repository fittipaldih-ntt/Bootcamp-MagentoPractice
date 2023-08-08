<?php

namespace Nttdata\Company\Ui\DataProvider;

use Nttdata\Company\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Backend\App\Action\Context as ActionContext;

class EmployeesDataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     * @var FilterApplierInterface
     * @var ActionContext
     */
    protected $collectionFactory;
    protected $fulltextFilter;
    protected $averageAge;
    protected $actionContext;

    /**
     * EmployeesDataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param ActionContext $actionContext
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        ActionContext $actionContext,
        array $meta = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->averageAge = 0;
        $this->actionContext = $actionContext;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $this->getCollection()->load();

        $data = $this->getCollection()->toArray();

        foreach ($data['items'] as &$item) {
            $employeeModel = $this->collectionFactory->create()->getItemById($item['id']);
            if ($employeeModel) {
                $item['age'] = $employeeModel->calculateAge();
            }
        }

        $totalAge = array_sum(array_column($data['items'], 'age'));
        $totalEmployees = $this->getCollection()->getSize();
        $averageAge = ($totalEmployees > 0) ? $totalAge / $totalEmployees : 0;
        $this->actionContext->getSession()->setData('averageAge', (int)$averageAge);

        return $data;
    }

    /**
     * Get collection
     *
     * @return \Nttdata\Company\Model\ResourceModel\Employee\Collection
     */
    public function getCollection()
    {

        $this->collection = $this->collectionFactory->create();

        return $this->collection;
    }

}
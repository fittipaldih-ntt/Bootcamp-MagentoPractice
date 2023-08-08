<?php
namespace Nttdata\Company\Ui\Component\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class IdEmployee extends Column
{
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        // Obtén el filtro de texto de $dataSource
        $filterText = $this->getFilter('text');

        // Verifica si hay un filtro en la columna "ID"
        if ($filterText !== null && isset($dataSource['data']['items'])) {
            $collection = $this->getContext()->getDataProvider()->getCollection();
            $value = $filterText['value'];

            // Aplica el filtro a tu colección
            $collection->addFieldToFilter('id', ['like' => '%' . $value . '%']);
        }

        return $dataSource;
    }
}

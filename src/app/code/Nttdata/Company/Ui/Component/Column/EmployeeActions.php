<?php

namespace Nttdata\Company\Ui\Component\Column;

use Magento\Ui\Component\Listing\Columns\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class EmployeeActions extends Column
{
    const URL_PATH_EDIT = 'company/management/editemployee';
    const URL_PATH_DELETE = 'company/management/deleteemployee';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data =[]
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->getContext()->getUrl(self::URL_PATH_EDIT, ['id' => $item['id']]),
                        'label' => __('Edit'),
                        'hidden' => false,
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->getContext()->getUrl(self::URL_PATH_DELETE, ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'hidden' => false,
                        'confirm' => [
                            'title' => __('Delete'),
                            'message' => __('Delete the employee?'),
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}
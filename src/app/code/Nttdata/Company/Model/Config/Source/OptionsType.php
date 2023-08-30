<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsType implements OptionSourceInterface
{

    protected $collection;

    public function __construct(\Nttdata\Company\Model\ResourceModel\TypeEmployee\CollectionFactory $collection){
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => '',
                'label' => __('Please select')
            ]
        ];

        $items = $this->collection->create();

        foreach ($items as $i) {
            $options[] = [
                'value' => $i->getId(),
                'label' => __($i->getDescription())
            ];
        }

        return $options;
    }

}

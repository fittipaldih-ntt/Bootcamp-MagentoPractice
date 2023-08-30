<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsFamilyGroup implements OptionSourceInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => '',
                'label' => __('Please select')
            ],
            [
                'value' => 'Single',
                'label' => __('Single')
            ],
            [
                'value' => 'Married',
                'label' => __('Married')
            ],
        ];

        return $options;
    }

}

<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsSeniority implements OptionSourceInterface
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
                'value' => 'Trainee',
                'label' => __('Trainee')
            ],
            [
                'value' => 'Junior',
                'label' => __('Junior')
            ],
            [
                'value' => 'Semisenior',
                'label' => __('Semi-senior')
            ],
            [
                'value' => 'Senior',
                'label' => __('Senior')
            ],
        ];

        return $options;
    }

}

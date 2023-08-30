<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsStudies implements OptionSourceInterface
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
                'value' => 'Secondary',
                'label' => __('Secondary')
            ],
            [
                'value' => 'Tertiary',
                'label' => __('Tertiary')
            ],
            [
                'value' => 'Academic',
                'label' => __('Academic')
            ],
            [
                'value' => 'Autodidact',
                'label' => __('Autodidact')
            ],
        ];

        return $options;
    }

}

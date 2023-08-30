<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsWorkTime implements OptionSourceInterface
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
                'value' => 'Parttime',
                'label' => __('Parttime')
            ],
            [
                'value' => 'Fulltime',
                'label' => __('Fulltime')
            ],
            [
                'value' => 'Freelance',
                'label' => __('Freelance')
            ],
        ];

        return $options;
    }

}

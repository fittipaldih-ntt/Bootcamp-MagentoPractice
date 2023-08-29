<?php

namespace Nttdata\Company\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Generic implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init'  => [
                    'buttonAdapter' => [
                        'actions'   => [
                            [
                                'targetName' => 'company_management_createemployee_form.company_management_createemployee_form',
                                'actionName' => 'save',
                                'params'     => [
                                    false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
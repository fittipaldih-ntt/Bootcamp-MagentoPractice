<?php

namespace Nttdata\Practice\Model\Config\Source;

use Magento\Framework\App\Config\Value;
use Magento\Framework\Exception\ValidatorException;

class Limit extends Value
{
    public function beforeSave()
    {
        $label = $this->getData('field_config/label');
        $val = $this->getValue();
        if (!is_numeric($val)) {
            throw new ValidatorException(__('El valor de %1 debe ser un número.', $label));
        } else if ($val < 1 || $val > 100) {
            throw new ValidatorException(__('El valor de %1 debe ser un número entero entre 1 y 100.', $label));
        }

        $this->setValue(intval($val));
        parent::beforeSave();
    }
}

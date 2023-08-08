<?php
namespace Nttdata\Company\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Nttdata\Company\Model\ResourceModel\Employee::class);
    }

    public function getId()
    {
        return $this->_getData($this->_idFieldName);
    }
    
    public function save()
    {
        $this->_getResource()->save($this);
        return $this;
    }

    /**
     * Calculate age based on birth date
     *
     * @return int|null
     */
    public function calculateAge()
    {
        $birthDate = $this->getData('birthDate');
        if (empty($birthDate)) {
            return null;
        }

        $birthDateTimestamp = strtotime($birthDate);
        $currentTimestamp = time();
        $ageInSeconds = $currentTimestamp - $birthDateTimestamp;
        $age = floor($ageInSeconds / (365 * 24 * 60 * 60));

        return $age;
    }
}

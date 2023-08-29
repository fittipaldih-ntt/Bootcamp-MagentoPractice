<?php

namespace Nttdata\Company\Cron;

use Nttdata\Company\Service\EmployeeData;
use Nttdata\Company\Model\EmployeeFactory;
use Nttdata\Company\Model\ResourceModel\Employee\Collection;
use Psr\Log\LoggerInterface;

class HolidaysCalculate
{
    protected $employeeData;
    protected $employeeFactory;
    protected Collection $employeeCollection;
    protected LoggerInterface $logger;

    public function __construct(
        EmployeeData $employeeData,
        EmployeeFactory $employeeFactory,
        Collection $employeeCollection,
        LoggerInterface $logger,
    ) {
        $this->employeeData = $employeeData;
        $this->employeeFactory = $employeeFactory;
        $this->employeeCollection = $employeeCollection;
        $this->logger = $logger;
    }

    public function execute()
    {
        $employees = $this->employeeFactory->create()->getCollection();

        foreach ($employees as $employee) {
            $employeeModel = $this->employeeFactory->create()->load($employee->getId());

            $holidays = $this->calculateHolidays($employeeModel);
            $employeeModel->setHolidays($holidays);
            $employeeModel->save();
        }
        return $this;
    }

    protected function calculateHolidays(\Nttdata\Company\Model\Employee $employee)
    {
        $admission = $employee->getAdmissiondate();
        if (empty($admission)) {
            return null;
        }
        $admissionDate = strtotime($admission);
        $currentDate = time();

        // Calcula diferencia entre las fechas en segundos
        $dateInterval = $currentDate - $admissionDate;
        // Convierte la diferencia de segundos a dias
        $days = floor($dateInterval / (60 * 60 * 24));
        // Calcula meses
        $months = floor($days / 30);
        // Calcula años
        $years = floor($months / 12);
        switch (true) {
            case $days <= 30:
                return 0;
            case $months < 6:
                return $months;
            case $years < 5:
                return 14;
            case $years < 10:
                return 21;
            case $years < 20:
                return 28;
            case $years > 20:
                    return 35;
            default:
                return -1;
        }
    }
}

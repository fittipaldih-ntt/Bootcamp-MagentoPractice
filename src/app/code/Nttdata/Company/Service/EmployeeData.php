<?php

namespace Nttdata\Company\Service;

use Nttdata\Company\Helper\Data;
use Nttdata\Company\Model\EmployeeFactory;
use Nttdata\Company\Model\SectorEmployeeFactory;
use Nttdata\Company\Model\TypeEmployeeFactory;
use Nttdata\Company\Model\SocialWorkFactory;

class EmployeeData
{

    protected $helper;
    protected $employeeFactory;
    protected $sectorEmployeeFactory;
    protected $typeEmployeeFactory;
    protected $socialWorkFactory;

    public function __construct(
        Data                    $helper,
        EmployeeFactory         $employeeFactory,
        SectorEmployeeFactory   $sectorEmployeeFactory,
        TypeEmployeeFactory     $typeEmployeeFactory,
        SocialWorkFactory       $socialWorkFactory,
    ) {
        $this -> helper                 = $helper;
        $this -> employeeFactory        = $employeeFactory;
        $this -> sectorEmployeeFactory  = $sectorEmployeeFactory;
        $this -> typeEmployeeFactory    = $typeEmployeeFactory;
        $this -> socialWorkFactory      = $socialWorkFactory;
    }

    public function getEmployeeData($employeeId)
    {

        $employee       = $this -> employeeFactory       -> create() -> load ($employeeId);
        $sectorEmployee = $this -> sectorEmployeeFactory -> create() -> load ($employee->getIdsector());
        $typeEmployee   = $this -> typeEmployeeFactory   -> create() -> load ($employee->getIdtype());
        $socialWork     = $this -> socialWorkFactory     -> create() -> load ($employee->getIdsocialwork());

        $employeeData = [
            'id'             => $employeeId,
            'name'           => $employee->getName(),
            'lastname'       => $employee->getLastname(),
            'age'            => $employee->calculateAge(),
            'birthdate'      => $employee->getBirthdate(),
            'phone'          => $employee->getPhone(),
            'home'           => $employee->getHome(),
            'family'         => $employee->getFamily(),
            'studies'        => $employee->getStudies(),
          
            'admission'      => $employee->getAdmissiondate(),
            'discharge'      => $employee->getDischargedate(),
            'worktime'       => $employee->getWorktime(),
            'seniority'      => $employee->getSeniority(),
            'contract'       => $employee->getTypecontract(),
            'type'           => $typeEmployee->getDescription(),
            'sector'         => $sectorEmployee->getDescription(),
            'socialwork'     => $socialWork->getDescription(),
            'socialworkplan' => $socialWork->getPlan(),
            'holidays'       => $employee->getHolidays(),
        ];
        
        return $employeeData;
    }
}

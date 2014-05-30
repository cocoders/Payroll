<?php
namespace Entity\Employee\PaymentClassification\Salaried;

use Entity\Employee\PaymentClassification;

abstract class SalariedClassification implements PaymentClassification
{
    private $salary;

    public function __construct($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }
}

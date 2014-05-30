<?php
namespace Entity\Employee\PaymentClassification\Hourly;

use Entity\Employee\PaymentClassification;

abstract class HourlyClassification implements PaymentClassification
{
    private $hourlyRate;

    public function __construct($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;
    }

    /**
     * @return int
     */
    public function getHourlyRate()
    {
        return $this->hourlyRate;
    }
}

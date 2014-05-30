<?php

namespace InMemoryData;


use Entity\Employee\PaymentClassificationFactory as BaseFactory;

class PaymentClassificationFactory implements BaseFactory
{
    public function make($classification, $arguments)
    {
        switch ($classification) {
            case 'commissioned':
                return new CommissionedClassification();
            case 'salaried':
                return new SalariedClassification($arguments[0]);
            case 'hourly':
                return new HourlyClassification($arguments[0]);
        }
    }
}

<?php

namespace Entity\Employee;

abstract class Employee
{
    private $id;
    private $name;
    private $address;
    private $paymentMethod;
    private $paymentClassification;
    private $paymentSchedule;

    public function __construct($id, $name, $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentClassification $paymentClassification
     */
    public function setPaymentClassification(PaymentClassification $paymentClassification)
    {
        $this->paymentClassification = $paymentClassification;
    }

    /**
     * @return PaymentClassification
     */
    public function getPaymentClassification()
    {
        return $this->paymentClassification;
    }

    /**
     * @param PaymentMethod $paymentMethod
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return PaymentSchedule
     */
    public function getPaymentSchedule()
    {
        return $this->paymentSchedule;
    }

    /**
     * @param PaymentSchedule $paymentSchedule
     */
    public function setPaymentSchedule(PaymentSchedule $paymentSchedule)
    {
        $this->paymentSchedule = $paymentSchedule;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}

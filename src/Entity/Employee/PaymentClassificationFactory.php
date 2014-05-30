<?php
/**
 * Created by PhpStorm.
 * User: skowi
 * Date: 30.04.14
 * Time: 22:22
 */

namespace Entity\Employee;


interface PaymentClassificationFactory
{
    public function make($classification, $arguments);
}

<?php

namespace UseCase\AddEmployee;

class AddCommissionedEmployeeRequest extends AddEmployeeRequest
{
    public $salary;
    public $commissionedRate;
}

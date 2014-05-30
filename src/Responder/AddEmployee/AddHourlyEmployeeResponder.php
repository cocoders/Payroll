<?php

namespace Responder\AddEmployee;

interface AddHourlyEmployeeResponder extends AddEmployeeResponder
{
    public function success(AddEmployeeResponse $addEmployeeResponse);
}

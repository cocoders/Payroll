<?php

namespace Responder\AddEmployee;

interface AddSalariedEmployeeResponder extends AddEmployeeResponder
{
    public function success(AddEmployeeResponse $addEmployeeResponse);
}

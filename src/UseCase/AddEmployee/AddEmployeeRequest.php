<?php

namespace UseCase\AddEmployee;

use Requestor\Request;

abstract class AddEmployeeRequest implements Request
{
    public $id;
    public $name;
    public $address;
}

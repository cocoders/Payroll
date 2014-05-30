<?php

namespace InMemoryData;

use Entity\Employee\EmployeeFactory as BaseFactory;

class EmployeeFactory implements BaseFactory
{
    public function create($id, $name, $address)
    {
        return new Employee($id, $name, $address);
    }
}

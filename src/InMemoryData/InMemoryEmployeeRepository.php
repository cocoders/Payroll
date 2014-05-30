<?php

namespace InMemoryData;

use Entity\Employee\Employee;
use Repositories\EmployeeRepository;

class InMemoryEmployeeRepository implements EmployeeRepository
{
    private $collection = [];

    public function add(Employee $employee)
    {
        $this->collection[$employee->getId()] = $employee;
    }

    /**
     * @param $id
     * @return Employee
     */
    public function find($id)
    {
        return $this->collection[$id];
    }
}

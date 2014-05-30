<?php

namespace Repositories;

use Entity\Employee\Employee;

interface EmployeeRepository
{
    public function add(Employee $employee);

    /**
     * @param $id
     * @return Employee
     */
    public function find($id);
}

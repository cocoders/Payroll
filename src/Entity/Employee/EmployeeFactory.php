<?php

namespace Entity\Employee;

interface EmployeeFactory
{
    /**
     * @param $id
     * @param $name
     * @param $address
     * @return Employee
     */
    public function create($id, $name, $address);
}

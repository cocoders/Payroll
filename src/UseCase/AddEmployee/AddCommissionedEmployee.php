<?php

namespace UseCase\AddEmployee;

use Entity\Employee\Employee;

class AddCommissionedEmployee extends AddEmployee
{
    protected function createResponse(Employee $employee)
    {
        $response = new AddHourlyEmployeeResponseDTO();
        $response->id = $employee->getId();

        return $response;
    }

    protected function makePaymentSchedule()
    {
        return $this->scheduleFactory->make('biweekly');
    }

    protected function makePaymentClassification(AddEmployeeRequest $request)
    {
        /**
         * @var AddCommissionedEmployeeRequest $request
         */
        return $this->classificationFactory->make('commissioned', $request->salary);
    }
}

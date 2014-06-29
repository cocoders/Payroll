<?php

namespace UseCase\AddEmployee;

use Entity\Employee\Employee;

class AddSalariedEmployee extends AddEmployee
{
    protected function createResponse(Employee $employee)
    {
        $response = new AddHourlyEmployeeResponseDTO();
        $response->id = $employee->getId();

        return $response;
    }

    protected function makePaymentSchedule()
    {
        return $this->scheduleFactory->make('monthly');
    }

    protected function makePaymentClassification(AddEmployeeRequest $request)
    {
        /**
         * @var AddSalariedEmployeeRequest $request
         */
        return $this->classificationFactory->make('salaried', $request->salary);
    }
}

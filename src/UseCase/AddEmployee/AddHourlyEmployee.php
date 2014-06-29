<?php

namespace UseCase\AddEmployee;

use Entity\Employee\Employee;

class AddHourlyEmployee extends AddEmployee
{
    protected function createResponse(Employee $employee)
    {
        $response = new AddHourlyEmployeeResponseDTO();
        $response->id = $employee->getId();

        return $response;
    }

    protected function makePaymentSchedule()
    {
        return $this->scheduleFactory->make('weekly');
    }

    protected function makePaymentClassification(AddEmployeeRequest $request)
    {
        /**
         * @var AddHourlyEmployeeRequest $request
         */
        return $this->classificationFactory->make('hourly', $request->hourlyRate);
    }
}

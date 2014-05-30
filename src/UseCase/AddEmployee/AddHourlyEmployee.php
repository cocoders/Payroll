<?php

namespace UseCase\AddEmployee;

class AddHourlyEmployee extends AddEmployee
{
    protected function createResponse(AddEmployeeRequest $request)
    {
        $response = new AddHourlyEmployeeResponseDTO();
        $response->id = $request->id;

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

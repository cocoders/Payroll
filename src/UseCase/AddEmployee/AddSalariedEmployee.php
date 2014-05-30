<?php

namespace UseCase\AddEmployee;

class AddSalariedEmployee extends AddEmployee
{
    protected function createResponse(AddEmployeeRequest $request)
    {
        $response = new AddSalariedEmployeeResponseDTO();
        $response->id = $request->id;

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

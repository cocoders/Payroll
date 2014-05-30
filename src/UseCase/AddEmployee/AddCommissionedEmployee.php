<?php

namespace UseCase\AddEmployee;

class AddCommissionedEmployee extends AddEmployee
{
    protected function createResponse(AddEmployeeRequest $request)
    {
        $response = new AddCommissionedEmployeeResponseDTO();
        $response->id = $request->id;

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

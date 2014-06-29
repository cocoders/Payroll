<?php

namespace UseCase\AddEmployee;

use Entity\Employee\Employee;
use Entity\Employee\EmployeeFactory;
use Entity\Employee\PaymentClassificationFactory;
use Entity\Employee\PaymentScheduleFactory;
use Repositories\EmployeeRepository;
use Requestor\Request;
use Requestor\UseCase;
use Responder\AddEmployee\AddEmployeeResponder;

abstract class AddEmployee extends UseCase
{
    /**
     * @var EmployeeFactory
     */
    private $employeeFactory;

    /**
     * @var \Repositories\EmployeeRepository
     */
    private $employeeRepository;

    /**
     * @var AddEmployeeResponder
     */
    private $addEmployeeResponder;
    /**
     * @var \Entity\Employee\PaymentClassificationFactory
     */
    protected $classificationFactory;
    /**
     * @var \Entity\Employee\PaymentScheduleFactory
     */
    protected $scheduleFactory;

    abstract protected function makePaymentSchedule();

    abstract protected function makePaymentClassification(AddEmployeeRequest $request);

    abstract protected function createResponse(Employee $employee);

    public function __construct(
        EmployeeFactory $employeeFactory,
        EmployeeRepository $employeeRepository,
        PaymentClassificationFactory $classificationFactory,
        PaymentScheduleFactory $scheduleFactory

    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeRepository = $employeeRepository;
        $this->classificationFactory = $classificationFactory;
        $this->scheduleFactory = $scheduleFactory;
    }

    public function addResponder($addEmployeeResponder)
    {
        $this->addEmployeeResponder = $addEmployeeResponder;
    }

    public function execute(Request $request)
    {
        if (!$this->addEmployeeResponder) {
            throw new \InvalidArgumentException();
        }

        if (!$request instanceof AddEmployeeRequest) {
            throw new \InvalidArgumentException();
        }

        $employee = $this->employeeFactory->create($request->id, $request->name, $request->address);

        $employee->setPaymentSchedule($this->makePaymentSchedule());
        $employee->setPaymentClassification($this->makePaymentClassification($request));

        $this->employeeRepository->add($employee);

        return $this->addEmployeeResponder->success($this->createResponse($employee));
    }
}

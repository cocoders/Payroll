<?php

use Entity\Employee\PaymentClassification\Commissioned\CommissionedClassification;
use Entity\Employee\PaymentClassification\Hourly\HourlyClassification;
use InMemoryData\EmployeeFactory;
use InMemoryData\PaymentClassificationFactory;
use InMemoryData\PaymentScheduleFactory;
use Responder\AddEmployee\AddEmployeeResponder;
use Responder\AddEmployee\AddEmployeeResponse;
use UseCase\AddEmployee\AddCommissionedEmployee;
use UseCase\AddEmployee\AddCommissionedEmployeeRequest;
use UseCase\AddEmployee\AddHourlyEmployee;
use UseCase\AddEmployee\AddHourlyEmployeeRequest;
use UseCase\AddEmployee\AddSalariedEmployeeRequest;
use InMemoryData\InMemoryEmployeeRepository;
use Requestor\UseCaseFactory;
use Requestor\RequestBuilder;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use UseCase\AddEmployee\AddSalariedEmployee;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext, AddEmployeeResponder
{

    private $employeeRepository;
    private $employeeFactory;
    private $useCaseFactory;
    private $requestBuilder;
    private $paymentClassificationFactory;
    private $paymentScheduleFactory;
    private $response;

    public function __construct()
    {
        $this->employeeRepository = new InMemoryEmployeeRepository();
        $this->employeeFactory = new EmployeeFactory();
        $this->useCaseFactory = new UseCaseFactory();
        $this->requestBuilder = new RequestBuilder();
        $this->paymentClassificationFactory = new PaymentClassificationFactory();
        $this->paymentScheduleFactory = new PaymentScheduleFactory();


        $this->requestBuilder->addRequest('addHourlyEmployee', function ($data) {
                $hourlyRequest = new AddHourlyEmployeeRequest();
                $hourlyRequest->id = $data['id'];
                $hourlyRequest->name = $data['name'];
                $hourlyRequest->address = $data['address'];
                $hourlyRequest->hourlyRate = $data['hourly_rate'];

                return $hourlyRequest;
            }
        );

        $this->requestBuilder->addRequest('addSalariedEmployee', function ($data) {
                $salariedRequest = new AddSalariedEmployeeRequest();
                $salariedRequest->id = $data['id'];
                $salariedRequest->name = $data['name'];
                $salariedRequest->address = $data['address'];
                $salariedRequest->salary = $data['salary'];

                return $salariedRequest;
            }
        );

        $this->requestBuilder->addRequest('addCommissionedEmployee', function ($data) {
                $commissionedRequest = new AddCommissionedEmployeeRequest();
                $commissionedRequest->id = $data['id'];
                $commissionedRequest->name = $data['name'];
                $commissionedRequest->address = $data['address'];
                $commissionedRequest->salary = $data['salary'];

                return $commissionedRequest;
            }
        );

        $this->useCaseFactory->addUseCase('addSalariedEmployee', new AddSalariedEmployee($this->employeeFactory, $this->employeeRepository, $this->paymentClassificationFactory, $this->paymentScheduleFactory));
        $this->useCaseFactory->addUseCase('addHourlyEmployee', new AddHourlyEmployee($this->employeeFactory, $this->employeeRepository, $this->paymentClassificationFactory, $this->paymentScheduleFactory));
        $this->useCaseFactory->addUseCase('addCommissionedEmployee', new AddCommissionedEmployee($this->employeeFactory, $this->employeeRepository, $this->paymentClassificationFactory, $this->paymentScheduleFactory));
    }

    /**
     * @When I added new salary employee:
     */
    public function iAddedNewSalaryEmployee(TableNode $table)
    {
        $this->makeUseCase($table, 'addSalariedEmployee');
    }

    /**
     * @Then I must have salary employee with id :id
     */
    public function iMustHaveSalaryEmployeeWithId($id)
    {
        PHPUnit_Framework_Assert::assertEquals($id, $this->response->id);
    }

    public function success(AddEmployeeResponse $addEmployeeResponse)
    {
        $this->response = $addEmployeeResponse;
    }

    /**
     * @When I added new hourly employee:
     */
    public function iAddedNewHourlyEmployee(TableNode $table)
    {
        $this->makeUseCase($table, 'addHourlyEmployee');
    }

    /**
     * @Then I must have hourly employee with id :arg1
     */
    public function iMustHaveHourlyEmployeeWithId($id)
    {
        PHPUnit_Framework_Assert::assertEquals($id, $this->response->id);
        PHPUnit_Framework_Assert::assertEquals(0, $this->response->hourlyRate);
        $employee = $this->employeeRepository->find($id);
        PHPUnit_Framework_Assert::assertTrue($employee->getPaymentClassification() instanceof HourlyClassification);
    }

    private function makeUseCase(TableNode $table, $useCaseName)
    {
        $hash = $table->getHash();
        $request = $this->requestBuilder->build($useCaseName, $hash[0]);
        $useCase = $this->useCaseFactory->create($useCaseName);
        $useCase->addResponder($this);

        return $useCase->execute($request);
    }

    /**
     * @When I added new commissioned employee:
     */
    public function iAddedNewCommissionedEmployee(TableNode $table)
    {
        $this->makeUseCase($table, 'addCommissionedEmployee');
    }

    /**
     * @Then I must have commissioned employee with id :arg1
     */
    public function iMustHaveCommissionedEmployeeWithId($id)
    {
        PHPUnit_Framework_Assert::assertEquals($id, $this->response->id);
        $employee = $this->employeeRepository->find($id);
        PHPUnit_Framework_Assert::assertTrue($employee->getPaymentClassification() instanceof CommissionedClassification);
    }
}

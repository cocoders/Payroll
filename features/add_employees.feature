Feature: Adding employees
  In order to pay salaries
  As a boss
  I need to add new employee

  Scenario: Adding Salary Employee
    When I added new salary employee:
    |id | name   | address | salary |
    |1  | Szymon | Gdańsk  | 1 000  |
    Then I must have salary employee with id "1"

  Scenario: Adding Hourly Employee
    When I added new hourly employee:
      |id | name   | address | hourly_rate |
      |1  | Szymon | Gdańsk  | 1 000       |
    Then I must have hourly employee with id "1"

  Scenario: Adding Commissioned Employee
    When I added new commissioned employee:
      |id | name   | address | salary      |
      |1  | Szymon | Gdańsk  | 1 000       |
    Then I must have commissioned employee with id "1"

<?php

//Encapsulation

class CommissionEmployee {
    private $firstName;
    private $lastName;
    private $socialSecurityNumber;
    private $grossSales;
    private $commissionRate;

    function __construct($firstName, $lastName, $socialSecurityNumber, $grossSales, $commissionRate) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->socialSecurityNumber = $socialSecurityNumber;
        $this->grossSales = $grossSales;
        $this->commissionRate = $commissionRate;
    }

    // getters and setters

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getSocialSecurityNumber() {
        return $this->socialSecurityNumber;
    }

    public function setSocialSecurityNumber($socialSecurityNumber) {
        $this->socialSecurityNumber = $socialSecurityNumber;
    }

    public function getGrossSales() {
        return $this->grossSales;
    }

    public function setGrossSales($grossSales) {
        if ($grossSales < 0.0) {
            throw new Exception("Gross sales must be >= 0.0");
        }
        $this->grossSales = $grossSales;
    }

    public function getCommissionRate() {
        return $this->commissionRate;
    }

    public function setCommissionRate($commissionRate) {
        if ($commissionRate <= 0.0 || $commissionRate >= 1.0) {
            throw new Exception("Commission rate must be > 0.0 and < 1.0");
        } else {
            $this->commissionRate = $commissionRate;
        }
    }

    // Other methods
    public function earnings() {
        return $this->commissionRate * $this->grossSales;
    }
}

// Instance 
$commissionEmployee1 = new CommissionEmployee("Amos", "Gyasi", "222-45-2222", 10000, .06);

echo "Commission Employee Instance earnings: \n";
$CommissionEmployee1Earning = $commissionEmployee1->earnings();
echo "Earnings: $CommissionEmployee1Earning\n";

// Inheritance 
class BasePlusCommissionEmployee extends CommissionEmployee {
    private $baseSalary;

    function __construct($firstName, $lastName, $socialSecurityNumber, $grossSales, $commissionRate, $baseSalary) {
        parent::__construct($firstName, $lastName, $socialSecurityNumber, $grossSales, $commissionRate);
        $this->baseSalary = $baseSalary;
    }

    // getters and setters
    public function getBaseSalary() {
        return $this->baseSalary;
    }

    public function setBaseSalary($baseSalary) {
        if ($baseSalary < 0.0) {
            throw new Exception("Base salary must be >= 0.0");
        }
        $this->baseSalary = $baseSalary;
    }

    // Other methods
    public function earnings() {
        return $this->baseSalary + parent::earnings();
    }

    public function display() {
        echo "Base Salary: " . $this->getBaseSalary() . "\n";
        echo "First Name: " . $this->getFirstName() . "\n";
        echo "Last Name: " . $this->getLastName() . "\n";
        echo "Social Security Number: " . $this->getSocialSecurityNumber() . "\n";
        echo "Gross Sales: " . $this->getGrossSales() . "\n";
        echo "Commission Rate: " . $this->getCommissionRate() . "\n";
    }
}

// Instance of the commission-only employee
$commissionEmployee2 = new CommissionEmployee("Nana", "Kwadwo", "222-45-2234", 20500, .045);

// Instance of the base salary plus commission employee
$basePlusCommissionEmployee1 = new BasePlusCommissionEmployee("Kwame", "Fenni", "453-45-1176", 3360, .045, 5000);

echo "UPdated earnings for the base salary plus commission employee: \n";
$basePlusCommissionEmployee1Earning = $basePlusCommissionEmployee1->earnings();
echo "Earnings: $basePlusCommissionEmployee1Earning\n";

// Polymorphism

abstract class Vehicle {
    protected string $vehicleId;
    protected string $model;
    protected float $fuelLevel;

    public function __construct(string $vehicleId, string $model, float $fuelLevel) {
        $this->vehicleId = $vehicleId;
        $this->model = $model;
        $this->fuelLevel = $fuelLevel;
    }
    
    public function refuel(float $liters): void {
        $this->fuelLevel += $liters;
        echo "{$this->model} refueled. New fuel level: {$this->fuelLevel} liters.\n";
    }
    
    abstract public function calculateRange(): float;
}

// Derived Class: Car
class Car extends Vehicle {
    private float $fuelEfficiency; 

    public function __construct(string $vehicleId, string $model, float $fuelLevel, float $fuelEfficiency) {
        parent::__construct($vehicleId, $model, $fuelLevel);
        $this->fuelEfficiency = $fuelEfficiency;
    }
    
    // Overriding calculateRange()
    public function calculateRange(): float {
        return $this->fuelLevel * $this->fuelEfficiency;
    }
}

// Independent Class: TransportationManager
class TransportationManager {
   
    public function operateVehicle(Vehicle $vehicle): void {
        echo "Operating Vehicle: {$vehicle->calculateRange()} km range\n";
    }
}

// Instance of the Car class
$car = new Car("C001", "Sedan", 50, 15);
$car->refuel(20); // Refuel the sedan

// Instance of the TransportationManager class

$manager = new TransportationManager();
$manager->operateVehicle($car);

//Abstraction
abstract class Employee {
    protected string $name;
    protected string $employeeId;

    public function __construct(string $name, string $employeeId) {
        $this->name = $name;
        $this->employeeId = $employeeId;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getEmployeeId(): string {
        return $this->employeeId;
    }
    
    abstract public function calculatePay(): string;
}

// Derived Class: FullTimeEmployee
class FullTimeEmployee extends Employee {
    private float $salary;

    public function __construct(string $name, string $employeeId, float $salary) {
        parent::__construct($name, $employeeId);
        $this->salary = $salary;
    }
    
    public function getSalary(): float {
        return $this->salary;
    }
    
    public function calculatePay(): string {
        return "FullTimeEmployee Pay: " . $this->salary;
    }
}

// Implementation
$employee = new FullTimeEmployee("John Doe", "E12345", 5000.00);

echo "Employee Name: " . $employee->getName() . "\n";
echo "Employee ID: " . $employee->getEmployeeId() . "\n";
echo "Salary: " . $employee->getSalary() . "\n";
echo $employee->calculatePay() . "\n";

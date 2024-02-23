<?php

use App\ClassesValidation\AdherentFormValidation;
use PHPUnit\Framework\TestCase;

class AdherentFormValidationTest extends TestCase
{
    public function testNameValidation()
    {
        $validName = 'Redwann Melsa';
        $invalidName = '123 Red';
        $this->assertTrue(AdherentFormValidation::checkName($validName));
        $this->assertFalse(AdherentFormValidation::checkName($invalidName));
    }

    public function testDateValidation()
    {
        $validDate = '2022-01-01';
        $invalidDate = 'zefiznefnzeug';
        $this->assertTrue(AdherentFormValidation::checkDate($validDate));
        $this->assertFalse(AdherentFormValidation::checkDate($invalidDate));
    }
}

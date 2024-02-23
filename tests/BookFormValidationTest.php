<?php

use App\ClassesValidation\BookFormValidation;
use PHPUnit\Framework\TestCase;

class BookFormValidationTest extends TestCase
{
    public function testAuthorValidation()
    {
        $validAuthor = 'John Doe';
        $this->assertTrue(BookFormValidation::checkAuthor($validAuthor));
        $invalidAuthor = '123 John';
        $this->assertFalse(BookFormValidation::checkAuthor($invalidAuthor));
    }


    public function testISBNValidationWith()
    {
        $validISBN = '978-3-16-148410-0';
        $this->assertTrue(BookFormValidation::checkISBN($validISBN));
        $invalidISBN = 'ojefapvbiaebv';
        $this->assertFalse(BookFormValidation::checkISBN($invalidISBN));
    }

    public function testNbPageValidation()
    {
        $validNbPage = 500;
        $this->assertTrue(BookFormValidation::checkNbPage($validNbPage));
        $invalidNbPage = 'abc';
        $this->assertFalse(BookFormValidation::checkNbPage($invalidNbPage));
        $outOfRangeNbPage = 15000;
        $this->assertFalse(BookFormValidation::checkNbPage($outOfRangeNbPage));
    }
}
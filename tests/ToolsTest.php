<?php

namespace INGApi\Tests;

use INGApi\RandomValuesOperation;
use INGApi\TestTools as Tool;


class ToolsTest extends Base
{


    public function testToolTestDate(): void
    {
        $formula = '[MACRO]date(Y-m-d H:i:s)[#MACRO]';
        $result  = Tool::getFormulaFunctions($formula);

        $this->assertIsString($result);
        $this->assertSame(date('Y-m-d H:i:s'), $result);

    }//end testToolTestDate()


    public function testToolTestDivision(): void
    {
        $formula = '[MACRO]division(42|2|3)[#MACRO]';
        $result  = Tool::getFormulaFunctions($formula);

        $this->assertIsFloat($result);
        $this->assertSame(7.0, $result);

    }//end testToolTestDivision()


    public function testToolTestMultiply(): void
    {
        $formula = '[MACRO]multiply(1000.817232|5|100)[#MACRO]';
        $result  = Tool::getFormulaFunctions($formula);

        $this->assertIsFloat($result);
        $this->assertSame(500408.616, $result);

    }//end testToolTestMultiply()


    public function testToolTestNumberFormat(): void
    {
        $formula = '[MACRO]number_format(500408.616|2|,|.)[#MACRO]';
        $result  = Tool::getFormulaFunctions($formula);

        $this->assertIsString($result);
        $this->assertSame('500.408,62', $result);

    }//end testToolTestNumberFormat()


    public function testToolTestNested(): void
    {
        $formula = '[MACRO]number_format([MACRO]multiply(1000.817232|5|100)[#MACRO]|2|,|.)[#MACRO]';
        $result  = Tool::getFormulaFunctions($formula);

        $this->assertIsString($result);
        $this->assertSame('500.408,62', $result);

    }//end testToolTestNested()


    public function testGenerateRandomValuesList(): void
    {
        $result = Tool::generateRandomValues(RandomValuesOperation::List->value, 9, 'red#sun');
        $this->assertIsString($result);
        $this->assertStringContainsString('red', $result);

        $result = Tool::generateRandomValues(RandomValuesOperation::List->value, 4, '-red#-blue#-green#-');
        $this->assertIsString($result);

    }//end testGenerateRandomValuesList()


    public function testGenerateRandomValuesLower(): void
    {
        $max = 15;

        $result = Tool::generateRandomValues(RandomValuesOperation::Lowercase->value, $max);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));

        $this->generateRandomHelper($result, $max, RANDOM_LOWERCASE);

    }//end testGenerateRandomValuesLower()


    public function testGenerateRandomValuesUpper(): void
    {
        $max = 15;

        $result = Tool::generateRandomValues(RandomValuesOperation::Uppercase->value, $max);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));

        $this->generateRandomHelper($result, $max, RANDOM_UPPERCASE);

    }//end testGenerateRandomValuesUpper()


    public function testGenerateRandomValuesNumber(): void
    {
        $max = 15;

        $result = Tool::generateRandomValues(RandomValuesOperation::Numbers->value, $max);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));

        $this->generateRandomHelper($result, $max, RANDOM_NUMBER);

    }//end testGenerateRandomValuesNumber()


    public function testGenerateRandomValuesSymbol(): void
    {
        $max = 15;

        $result = Tool::generateRandomValues(RandomValuesOperation::Symbol->value, $max);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));

        $this->generateRandomHelper($result, $max, RANDOM_SYMBOL);

    }//end testGenerateRandomValuesSymbol()


    public function testGenerateRandomValuesCustom(): void
    {
        $max     = 10;
        $charSet = 'abc';

        $result = Tool::generateRandomValues(RandomValuesOperation::Custom->value, $max, $charSet);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));

        $this->generateRandomHelper($result, $max, $charSet);

        $result = Tool::generateRandomValues(RandomValuesOperation::Custom->value, $max);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));
        $this->generateRandomHelper($result, $max, RANDOM_VALUE_CHARSET);

    }//end testGenerateRandomValuesCustom()


    public function testGenerateRandomValuesAll(): void
    {
        $max = 5;

        $result = Tool::generateRandomValues(RandomValuesOperation::All->value, $max);

        $this->assertIsString($result);

        $this->assertSame($max, strlen($result));

    }//end testGenerateRandomValuesAll()


    private function generateRandomHelper(string $value, int $max, string $charSet):void
    {
        for ($i = 0; $i < $max; ++$i) {
            $char = $value[$i];

            $this->assertTrue(str_contains($charSet, $char));
        }

    }//end generateRandomHelper()


}//end class

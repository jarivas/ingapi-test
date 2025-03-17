<?php

namespace INGApi\Tests;

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


}//end class

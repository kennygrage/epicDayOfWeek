<?php
    require_once "src/DayCalc.php";

    class ScrabbleCalcTest extends PHPUnit_Framework_TestCase {

        function test_DayCalc_todayReturnsThursday() {
            //Arrange
            $test_DayCalc = new DayCalc;
            $input = '08/13/2015';

            //Act
            $result = $test_DayCalc->calcDay($input);

            //Assert
            $this->assertEquals(array(8, 13, 2015), $result);
        }
    }

?>
